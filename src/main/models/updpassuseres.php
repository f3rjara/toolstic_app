<?php

include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
include (ROOT_INCLUDE."/connect.php");  
include_once (ROOT_INCLUDE.'/fetch_array.php'); 

$password = md5($_POST['password']);
$cod_estudiante = $_POST['cod_estudiante'];
 

$SqlUser = "UPDATE estudiante SET password_estudiante = '".$password."' WHERE  cod_estudiante = '" . $cod_estudiante . "' ";


$ResultSql = $conex->query($SqlUser); 

if($ResultSql == true){             
    $restext = "La contraseña se actualizó correctamente";           
    $respuesta = true;
}
else{  
    $restext = "Hubo un problema al actualizar la contraseña";
    $respuesta = false; 
}//fin del else inscripcion
   

echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 

$conex->close();


?>