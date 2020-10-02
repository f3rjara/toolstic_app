<?php

    include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
    include_once (ROOT_INCLUDE."/connect.php"); 
    include_once (ROOT_MAIN.'/views/sesion_student.php');     
    
    $userLogueado = $userlog['cod_estudiante'];
    
    if ( isset( $_SESSION['user_student'] ) ) {
        $login = "UPDATE estudiante SET is_logged = 0 WHERE estudiante.cod_estudiante = ' ".$userLogueado." ' ";
        $eject = $conex->query( $login );
        if ( $eject ) :            
            if(isset($_SESSION['error_user'])){
                $_SESSION['error_user'] = TRUE;
            }            
            session_destroy(); 
        endif;
    }
    session_destroy(); 
    header('Location: '.ROOT_MEDIA);

?>