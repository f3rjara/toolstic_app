<?php
    session_start();
    if(isset($_SESSION['user_docente'])){ $userlog = $_SESSION['user_docente']; }
    else{ header('Location: ../../'); }

    require "./../../conex.php";  
    include "./fetch_record.php";

    $FNP_year = $_POST['FNP_year'];
    $FNP_periodo = $_POST['FNP_periodo'];
    $FNP_estado_periodo = $_POST['FNP_estado_periodo'];

    $SqlNewPeriodo = "INSERT INTO periodo (periodo, year_periodo, id_estado_periodo) VALUES ('".$FNP_periodo."', '".$FNP_year."', '".$FNP_estado_periodo."')"; 
    
    $ResultSQl = $conex->query($SqlNewPeriodo);  

    if($ResultSQl == true){             
        $restext = "La periodo se creo correctamente";           
        $respuesta = true;
    }
    else{  
        $restext = "Hubo un problema al crear el periodo";
        $respuesta = false; 
    }//fin del else inscripcion
       

    echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 


?>