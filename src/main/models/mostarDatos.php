<?php

    include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
    include (ROOT_INCLUDE."/connect.php");  
    include_once (ROOT_INCLUDE.'/fetch_array.php'); 
    include_once (ROOT_MAIN.'/views/sesion_student.php'); 
    if( $_SESSION['error_user'] != FALSE && $_SESSION['user_student'] == NULL) { header('Location: '.ROOT_MEDIA_USER.'/');   }   
   
    
    $userLogueado = $userlog['cod_estudiante'];
    $codSend = $_POST['codigo'];

    if($userLogueado == $codSend) {
        $LosDatos = DatosEstudianteFull($conex, $userLogueado); 
        echo json_encode(array("res"=>true, "datos" => $LosDatos));
    }
    else {
        echo json_encode(array("res"=>false));
    }
    $conex->close();

?>
