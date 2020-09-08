<?php

    
    include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
    include (ROOT_INCLUDE."/connect.php");  
    include_once (ROOT_INCLUDE.'/fetch_array.php'); 
    session_start();  

    
    $UsRe = $_POST['usuario_estudiante'];
    $PwRe = md5($_POST['pw_valida']);

    $estudiante = "SELECT * FROM estudiante WHERE cod_estudiante = '".$UsRe."' AND password_estudiante = '".$PwRe."'";

    $usuario = $conex->query($estudiante);

    if($usuario->num_rows > 0):
        $datos = $usuario->fetch_assoc();             
        $_SESSION['user_student'] = $datos;     
        $_SESSION['error_user'] = FALSE;
        echo json_encode(array('error' => false));       
    else:        
        $_SESSION['error_user'] = TRUE;
        echo json_encode(array('error' => true));
    endif;

    $conex->close();
  
?>

