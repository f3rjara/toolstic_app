<?php

session_start();
    if(isset($_SESSION['user_docente'])){ $userlog = $_SESSION['user_docente']; }
    else{ header('Location: ../../'); }

    require "./../../conex.php";  
    include "./fetch_record.php";

    $id_grupo = $_POST['id_grupo'];  
    
    $SqlDeleteGrupo = "UPDATE grupo SET id_estado_grupo = '4' WHERE id_grupo = '".$id_grupo."'";

    
    $ResultSql = $conex->query($SqlDeleteGrupo); 
    
    if($ResultSql == true){ 
        $restext = "El grupo fue archivado exitosamente.!";
        $respuesta = true; 
    }
    else{
        $restext = "Hubo un problema al archivar el grupo";
        $respuesta = false; 
    }
       
        $conex->close();
    
    echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 

?>