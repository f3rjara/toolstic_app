<?php
    include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
    include (ROOT_INCLUDE."/connect.php");  
    include_once (ROOT_INCLUDE.'/fetch_array.php'); 
    include_once (ROOT_MAIN.'/views/sesion_student.php'); 
    if ( !isset($_SESSION['user_student']) || ( $_SESSION['error_user'] != FALSE && $_SESSION['user_student'] == NULL)) { header('Location: '.ROOT_MEDIA_USER.'/') ;   }   

    $bandera_btn = $_POST['bandera'];
    $_SESSION['UserInteraction'] = FALSE;

    if($bandera_btn  == TRUE)
    {
        $error = FALSE;
        $restext =  "USUARIO INTERATION  = ".$bandera_btn;
        $_SESSION['UserInteraction'] = TRUE;
    }
    else{
        $error = TRUE;
        $restext =  "USUARIO INTERATION  = ".$bandera_btn;
        $_SESSION['UserInteraction'] = FALSE;
    }

               
    echo json_encode(array('error' => $error, 'restext' => $restext));   





?>