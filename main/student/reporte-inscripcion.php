<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
include (ROOT_INCLUDE."/connect.php");  
include_once (ROOT_MAIN.'/views/sesion_student.php'); 

// SI EL USUARIO NO ESTA LOGUEADO Y QUIERE ACCEDER
if( !isset($_SESSION['error_user']) || ($_SESSION['error_user'] != FALSE && $_SESSION['user_student'] === NULL))   
{ header('Location: '.ROOT_MEDIA_USER.'/');  }   

// libreria MPDF
require_once(ROOT_PATH.'/vendor/autoload.php');

// COMPROBACION DEL ESTUDIANTE SI INTERACTUA CON LOS BOTONES 
if( isset( $_SESSION['dataReport'] ) && $_SESSION['dataReport'] == TRUE ) {         

    //Plantilla en html
    require_once(ROOT_MAIN.'/views/pl_reporte_inscripcion.php');

    //Estilos CSS
    $codigoCss = file_get_contents(ROOT_PUBLIC.'/css/reporte_inscripcion.css');

    // ENVIO DE DATOS Y LAYOUT DE REPORTE
    $datos_reporte = json_decode($_SESSION['ReportData']);
    $plantilla_Reporte = getReport($datos_reporte);

    // CONFIG DEL DOCUMENTO
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' =>'letter',
        'orientation' => 'P'
    ]);

    $mpdf->AddPage('P' ,'', '', '', '', 0, 0, 0, 0 );

    $mpdf->writeHTML($codigoCss, \Mpdf\HTMLParserMode::HEADER_CSS);

    $mpdf->writeHTML($plantilla_Reporte, \Mpdf\HTMLParserMode::HTML_BODY);

    $mpdf->Output();

} else {
    // EL USUARIO NO NTERACTUA CON EL BOTON
    header('Location: '.ROOT_MEDIA_USER.'/');
}



?>
