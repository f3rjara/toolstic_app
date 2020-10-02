<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
include (ROOT_INCLUDE."/connect.php");  
include_once (ROOT_INCLUDE.'/fetch_array.php'); 


$data = ObtenerOpcionesRespuestasRandom(13, $conex) ;

?>