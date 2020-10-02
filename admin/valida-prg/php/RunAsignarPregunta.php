<?php
    session_start();
    if(isset($_SESSION['user_docente'])){ $userlog = $_SESSION['user_docente']; }
    else{ header('Location: ../../'); }

    require "../../conex.php";
    include "fetch_records.php";
   
    $Id_pregunta= $_POST['Id_pregunta'];
    $id_docente= $_POST['id_docente'];
    
        
    $sqlAsignarPrg = "UPDATE pregunta SET validador_pregunta = '".$id_docente."', id_estado_pregunta = '7', pregunta_asignada = '1' WHERE pregunta.id_pregunta = '".$Id_pregunta."'";
        
    $ResultSql = $conex->query($sqlAsignarPrg);        
        if($ResultSql == true){             
            $restext = "La pregunta fue asignada correctamente";           
            $respuesta = true;
        }
        else{  
            $restext = "Hubo un problema al asignar la pregunta";
            $respuesta = false; 
        }//fin del else inscripcion


    echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 


?>