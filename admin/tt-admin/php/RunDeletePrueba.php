<?php

session_start();
    if(isset($_SESSION['user_docente'])){ $userlog = $_SESSION['user_docente']; }
    else{ header('Location: ../../'); }

    require "./../../conex.php";  
    include "./fetch_record.php";

    $id_prueba = $_POST['id_prueba'];  
    
    $SqlDeletePruebas = "UPDATE prueba SET id_estado_prueba = '5' WHERE id_prueba = '".$id_prueba."'";
    
    $ResultSql = $conex->query($SqlDeletePruebas); 
    
    if($ResultSql == true){ 
        $restext = "La prueba fue eliminada exitosamente.!";
        $respuesta = true; 
    }
    else{
        $restext = "Hubo un problema al eliminar la prueba";
        $respuesta = false; 
    }
       
        $conex->close();
    
    echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 

?>