<?php
    include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
    session_start();

    if(isset($_SESSION['error_user'])){
        $_SESSION['error_user'] = TRUE;
    }

    session_destroy();     
    header('Location: '.ROOT_MEDIA);

?>