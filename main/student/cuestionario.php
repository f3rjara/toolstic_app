<?php
    include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
    include (ROOT_INCLUDE."/connect.php");  
    include_once (ROOT_INCLUDE.'/fetch_array.php'); 
    include_once (ROOT_MAIN.'/views/sesion_student.php'); 
    // SI EL USUARIO NO ESTA LOGUEADO Y QUIERE ACCEDER
    if( !isset($_SESSION['error_user']) || ($_SESSION['error_user'] != FALSE && $_SESSION['user_student'] === NULL))   
    { header('Location: '.ROOT_MEDIA_USER.'/');  }   
    // COMPROBACION DEL ESTUDIANTE SI INTERACTUA CON LOS BOTONES 
    if( isset($_SESSION['btnPresentaPrueba'] ) && $_SESSION['btnPresentaPrueba'] == TRUE ) {        
        if(isset($_SESSION['UserInteraction']) && $_SESSION['UserInteraction'] === TRUE) {
            echo "<br> btnPresentaPrueba variable es TRUE y esta habilitado a presentar la prueba ";
            echo "<br> El usuario SI interactuo";
        }
        else {
            // EL USUARIO NO REALIZA INTERACION CON EL BOTON DEL CUESTIONARIO
            $_SESSION['UserInteraction'] = FALSE;
            header('Location: '.ROOT_MEDIA_USER.'/');
        }
    } else {
        // EL USUARIO NO TIENE EL BOTON HABILITADO
        header('Location: '.ROOT_MEDIA_USER.'/');
    }

?>