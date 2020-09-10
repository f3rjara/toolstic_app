<?php
    include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
    include (ROOT_INCLUDE."/connect.php");      
    include_once (ROOT_MAIN.'/views/sesion_student.php'); 
    if ( !isset($_SESSION['user_student']) || ( $_SESSION['error_user'] != FALSE && $_SESSION['user_student'] == NULL)) { header('Location: '.ROOT_MEDIA_USER.'/') ;   }   

    $dataReport = $_POST['dataReport'];
    $_SESSION['dataReport'] = FALSE;

    if($dataReport)
    {
        $error = FALSE;
        $_SESSION['dataReport'] = TRUE;
        $restext =  "DATOS RECIBIDOS";
        $getReport = str_replace("'",  '"', $dataReport); 
        $_SESSION['ReportData'] = json_encode($getReport);
    }
    else{
        $error = TRUE;
        $restext =  "No se han recibido los datos para el reporte.";
        $_SESSION['dataReport'] = FALSE;
    }
               
    echo json_encode(array('error' => $error, 'restext' => $restext , 'dataReport' => $dataReport));   



?>