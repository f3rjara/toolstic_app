
<?php
    session_start();   

    if(isset($_SESSION['user_docente'])){
        $userlog = $_SESSION['user_docente'];
    }
    else{
        header('Location: ../../');
    }
    
               
    require "./../../conex.php";


    $idpregunta = (int)$_POST['idpregunta'];
    $creador = $userlog['id_usuario'];
       
    
    $SqlDeletePrg = "UPDATE pregunta  SET id_estado_pregunta = 6 WHERE id_pregunta = '".$idpregunta."' AND creador_pregunta = '".$creador."'";

    
    $ResultSql = $conex->query($SqlDeletePrg); 
    
    if($ResultSql == true){ 
        $restext = "La pregunta fue archivada exitosamente.!";
        $respuesta = true; 
    }
    else{
        $restext = "Hubo un problema al archivar la pregunta";
        $respuesta = false; 
    }
       
        $conex->close();
    
    echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 



?>