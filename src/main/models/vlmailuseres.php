<?php

include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
include (ROOT_INCLUDE."/connect.php");  
include_once (ROOT_INCLUDE.'/fetch_array.php'); 

$correo = $_POST['correo'];
$codigo = $_POST['codigo'];

 

$SqlUser = "SELECT * FROM estudiante WHERE correo_estudiante = '". $correo ."' AND cod_estudiante = '" . $codigo . "' ";


$ResultSql = $conex->query($SqlUser); 

if($ResultSql->num_rows > 0){ 
    $restext = "El correo esta registrado!";
    $respuesta = true; 
}
else{
    $restext = "El correo ingresado no corresponde al registrado en el sistema.";
    $respuesta = false; 
}
   
    $conex->close();

echo json_encode(array("res"=>$respuesta,"restext"=>$restext, "cod" => $codigo)); 



?>