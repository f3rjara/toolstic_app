<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
include_once (ROOT_INCLUDE."/connect.php");  
include_once (ROOT_INCLUDE.'/fetch_array.php'); 
include_once (ROOT_MAIN.'/views/sesion_student.php'); 
if( $_SESSION['error_user'] != FALSE && $_SESSION['user_student'] == NULL) { header('Location: '.ROOT_MEDIA_USER.'/');   }   

 $id_ins = $_POST['id_ins'];
 $estudiante = $_POST['estudiante'];
 $id_grupo = $_POST['id_grupo'];
 $inscritos = 0;

 $sqlElimina = "DELETE FROM inscripcion_prueba WHERE inscripcion_prueba.cod_estudiante = '".$estudiante."' AND inscripcion_prueba.id_inscripcion_prueba = '".$id_ins."'";

$EjecutaEliminacion = $conex->query($sqlElimina); 

if($EjecutaEliminacion == true){ 
    
    $CuposEnGrupo = "SELECT total_inscritos_grupo FROM grupo WHERE id_grupo='".$id_grupo."'";
    
    $resultSQL = $conex->query($CuposEnGrupo);
    if($resultSQL-> num_rows > 0){
        $datos = $resultSQL->fetch_assoc();   
        $inscritos = $datos['total_inscritos_grupo'];   
        $num = $inscritos-1;
               
        $SqlDisminuye = "UPDATE grupo SET total_inscritos_grupo='".$num."' WHERE id_grupo='".$id_grupo."'";
        $EjecutaDisminucion = $conex->query($SqlDisminuye); 

        $SqlActualizaEstadoGrupo = "UPDATE grupo SET id_estado_grupo='2' WHERE id_grupo='".$id_grupo."'";
        $EjecutaSql = $conex->query($SqlActualizaEstadoGrupo);


        $restext = "Se realizo la cancelación y su cupo está libre";
        $respuesta = true;
    }    
    
}
else{
    $restext = "No se pudo realizar la cancelación";
    $respuesta = false;
}

$conex->close();
echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 


?>