<?php

session_start();
    if(isset($_SESSION['user_docente'])){ $userlog = $_SESSION['user_docente']; }
    else{ header('Location: ../../'); }

    require "./../../conex.php";  
    include "./fetch_record.php";

    $id_periodo = $_POST['id_periodo'];  
    
    $SqlDeletePeriodo = "UPDATE periodo SET id_estado_periodo = '3'  WHERE id_periodo = '".$id_periodo."'";

    
    $ResultSql = $conex->query($SqlDeletePeriodo); 
    
    if($ResultSql == true){ 
        $restext = "El periodo fue archivado exitosamente.!";
        $respuesta = true; 
    }
    else{
        $restext = "Hubo un problema al archivar  el periodo";
        $respuesta = false; 
    }
       
        $conex->close();
    
    echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 

?>