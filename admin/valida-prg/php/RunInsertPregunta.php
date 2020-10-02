<?php
    session_start();
    if(isset($_SESSION['user_docente'])){ $userlog = $_SESSION['user_docente']; }
    else{ header('Location: ../../'); }

    require "../../conex.php";
    include "fetch_records.php";
    $arrayDate = ObtenerDateTime();
    
    
    $idTarea = $_POST['idTarea'];
    $CodPregunta = GenerarCodPrg($idTarea, $conex);
    $TxEnunciado = $_POST['TxEnunciado'];  
    $FechaCreacion = $arrayDate['date'];
    $CreadorPrg = $userlog['id_usuario'];
    
    $sqlCrearPrg = "INSERT INTO pregunta(cod_pregunta, id_tarea, enunciado_pregunta, fecha_creacion_pregunta, creador_pregunta, validador_pregunta, id_estado_pregunta, pregunta_asignada) VALUES('".$CodPregunta."','".$idTarea."','".$TxEnunciado."','".$FechaCreacion."','".$CreadorPrg."',Null,'1','0')";
        
        $EjecutaInsert = $conex->query($sqlCrearPrg);        
        if($EjecutaInsert == true){ 
            $IdGenerado = ObtenerIdPrgCreada($FechaCreacion, $CreadorPrg, $conex);
            $restext = "La pregunta se guardo correctamente";           
            $respuesta = true;
        }
        else{  
            $restext = "Hubo un problema al guardar la pregunta";
            $respuesta = false; 
        }//fin del else inscripcion


    echo json_encode(array("res"=>$respuesta,"restext"=>$restext, "id_Prg"=>$IdGenerado)); 


?>