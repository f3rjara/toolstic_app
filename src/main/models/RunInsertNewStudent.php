<?php
    
include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
include (ROOT_INCLUDE."/connect.php");  
include_once (ROOT_INCLUDE.'/fetch_array.php'); 



$codEstudiante=$_POST['codEstudiante'];
$correoEstudiante=$_POST['correoEstudiante'];
$nameEstudiante=$_POST['nameEstudiante'];
$apellidoEstudiante=$_POST['apellidoEstudiante'];
$passEstudiante=md5($_POST['pass1Estudiante']);
$idprogramaEstudiante=$_POST['idprogramaEstudiante'];
$semestreEstudiante=  $_POST['semestreEstudiante'];
$tipoDoc  = $_POST['tipoDoc'];
$NumDocEstudiante  = $_POST['NumDocEstudiante'];  
$telefonoEstudiante =$_POST['telefonoEstudiante'];

$FechaServer = ObtenerDateTime();
$FechaHoy = $FechaServer['date'];


$SqlExisteUsuario = "SELECT COUNT(*) AS numUsuarios FROM estudiante WHERE estudiante.cod_estudiante = '".$codEstudiante."'";
$ExisteUsuario = $conex->query($SqlExisteUsuario);
$ResultExisteUsuario = $ExisteUsuario->fetch_assoc();  
$total_Usuarios = $ResultExisteUsuario['numUsuarios'];


$SqlExisteCorreo = "SELECT COUNT(*) AS numCorreo FROM estudiante WHERE estudiante.correo_estudiante = '".$correoEstudiante."'";
$ExisteCorreo = $conex->query($SqlExisteCorreo);
$ResultExisteCorreo = $ExisteCorreo->fetch_assoc();  
    $total_Correos = $ResultExisteCorreo['numCorreo'];


if($total_Usuarios > 0)
{
    $restext = "El Código ya está registrado";           
    $respuesta = false;
    echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 
}
else if($total_Correos > 0){
    $restext = "El Correo ya está registrado";           
    $respuesta = false;
    echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 
}
else if($total_Usuarios == 0 && $total_Correos == 0){
    $sqlNewStudent = "INSERT INTO estudiante (cod_estudiante, tipo_documento, num_documento, nombres_estudiante, apellidos_estudiante, password_estudiante, correo_estudiante, telefono_estudiante, semestre_estudiante, id_programa, realizo_prueba, estudiante_habilitado, is_logged , logined) VALUES ('".$codEstudiante."', '".$tipoDoc."', '".$NumDocEstudiante."', '".$nameEstudiante."', '".$apellidoEstudiante."', '".$passEstudiante."' , '".$correoEstudiante."' , '".$telefonoEstudiante."', '".$semestreEstudiante."' , '".$idprogramaEstudiante."','0','1','0', '".$FechaHoy."')";
        
    $EjecutaInsert = $conex->query($sqlNewStudent);        
    if($EjecutaInsert == true){             
        $restext = "El nuevo usuario se registro correctamente";           
        $respuesta = true;
        echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 
    }
    else{  
        $restext = "Hubo un problema al registrar el usuario";
        $respuesta = false; 
        echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 
    }//fin del else inscripcion
    

}






?>