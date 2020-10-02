<?php
    session_start();
    if(isset($_SESSION['user_docente'])){ $userlog = $_SESSION['user_docente']; }
    else{ header('Location: ../../'); }

    require "./../../conex.php";  
    include "./fetch_record.php";

    $FUP_id_periodo = $_POST['FUP_id_periodo'];
    $FUP_year = $_POST['FUP_year'];
    $FUP_periodo = $_POST['FUP_periodo'];
    $FUP_estado_periodo = $_POST['FUP_estado_periodo'];

    $SqlUpdatePeriodo = "UPDATE periodo SET periodo = '".$FUP_periodo."', year_periodo = '".$FUP_year."', id_estado_periodo = '".$FUP_estado_periodo."' WHERE id_periodo = '".$FUP_id_periodo."'"; 

    
    $ResultSQl = $conex->query($SqlUpdatePeriodo);  

    if($ResultSQl == true){             
        $restext = "La periodo se actualizo correctamente";           
        $respuesta = true;
    }
    else{  
        $restext = "Hubo un problema al actualizar el periodo";
        $respuesta = false; 
    }//fin del else inscripcion
       

    echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 


?>