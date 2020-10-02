<?php
    session_start();
    if(isset($_SESSION['user_docente'])){ $userlog = $_SESSION['user_docente']; }
    else{ header('Location: ../../'); }

    require "../../conex.php";
    include "fetch_records.php";
    $arrayDate = ObtenerDateTime();
    
    
    $idTarea = $_POST['idTarea'];
    //$CodPregunta = GenerarCodPrg($idTarea, $conex);
    $TxEnunciado = $_POST['TxEnunciado'];  
    $FechaCreacion = $arrayDate['date'];
    $CreadorPrg = $userlog['id_usuario'];
    $IdPrguntaDelete = $_POST['IdPrguntaDelete'];

    

    $EstadoActual = ObtenerID_EstadoPrg($IdPrguntaDelete, $conex);
    $estadoFinal = '5';

    if($EstadoActual['id_estado_pregunta'] == '3'){
        $estadoFinal = '4';
    }

    $sqlActualizaPrg = "UPDATE pregunta SET id_tarea = '".$idTarea."', enunciado_pregunta = '".$TxEnunciado."', fecha_creacion_pregunta = '".$FechaCreacion."', id_estado_pregunta = '".$estadoFinal."' WHERE pregunta.id_pregunta = '".$IdPrguntaDelete."'";
        
    $ResultSql = $conex->query($sqlActualizaPrg);        
        if($ResultSql == true){             
            $restext = "La pregunta se actualizó correctamente";           
            $respuesta = true;
        }
        else{  
            $restext = "Hubo un problema al actualizar la pregunta";
            $respuesta = false; 
        }//fin del else inscripcion


    echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 


?>