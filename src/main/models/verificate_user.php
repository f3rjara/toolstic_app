<?php

    include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
    include (ROOT_INCLUDE."/connect.php");  
    include_once (ROOT_INCLUDE.'/fetch_array.php'); 

    
    $codEstudiante = $_POST['codEstudiante'];

   
    $estudiante = "SELECT * FROM estudiante WHERE cod_estudiante = '".$codEstudiante."'";

    $Respuesta = $conex->query($estudiante);

    if($Respuesta->num_rows > 0):             
        echo json_encode(array('error' => true, 'restext' => 'El usuario ya se encuentra registrado'));       
    else:        
        echo json_encode(array('error' => false));
    endif;

    $conex->close();  
?>

