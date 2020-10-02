<?php

session_start();
    if(isset($_SESSION['user_docente'])){ $userlog = $_SESSION['user_docente']; }
    else{ header('Location: ../../'); }

    require "./../../conex.php";  
    include "./fetch_record.php";

    $id_usuario = $_POST['id_usuario'];  
    
    $SqlDeleteUser = "DELETE FROM usuario  WHERE id_usuario = '".$id_usuario."'";

    
    $ResultSql = $conex->query($SqlDeleteUser); 
    
    if($ResultSql == true){ 
        $restext = "El usuario fue eliminado exitosamente.!";
        $respuesta = true; 
    }
    else{
        $restext = "Hubo un problema al eliminar el usuario";
        $respuesta = false; 
    }
       
        $conex->close();
    
    echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 

?>