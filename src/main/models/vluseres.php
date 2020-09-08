<?php

include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
include (ROOT_INCLUDE."/connect.php");  
include_once (ROOT_INCLUDE.'/fetch_array.php'); 

$codigo = $_POST['codigo'];

 

$SqlUser = "SELECT * FROM estudiante WHERE cod_estudiante = '". $codigo ."' ";


$ResultSql = $conex->query($SqlUser); 

if($ResultSql->num_rows > 0){ 
    $restext = "Usuario valido!";
    $respuesta = true; 
}
else{
    $restext = "No es posible encontrar al usuario";
    $respuesta = false; 
}
   
    $conex->close();

echo json_encode(array("res"=>$respuesta,"restext"=>$restext, "cod" => $codigo)); 



?>