<?php
    session_start();
    if(isset($_SESSION['user_docente'])){ $userlog = $_SESSION['user_docente']; }
    else{ header('Location: ../../'); }

    require "./../../conex.php";  
    include "./fetch_records.php";
    
    $id_prg = $_POST['id_prg'];
    $id_estado_prg = $_POST['id_estado_prg'];
    $retro_prg = $_POST['retro_prg'];

    $Fecha = ObtenerDateTime();
    $FechaHoy = $Fecha['date'];


    $SqlUpdatePregunta = "UPDATE pregunta SET id_estado_pregunta = '".$id_estado_prg."', observaciones_validacion = '".$retro_prg."', fecha_validacion = '".$FechaHoy."' WHERE id_pregunta = '".$id_prg."' "; 

    
    $ResultSQl = $conex->query($SqlUpdatePregunta);  

    if($ResultSQl == true){             
        $restext = "La validación de la pregunta se guardo correctamente";           
        $respuesta = true;
    }
    else{  
        $restext = "Hubo un problema al guardar la validación de la pregunta";
        $respuesta = false; 
    }//fin del else inscripcion
       

    echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 


?>