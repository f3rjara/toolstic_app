<?php
    session_start();
    if(isset($_SESSION['user_docente'])){ $userlog = $_SESSION['user_docente']; }
    else{ header('Location: ../../'); }

    require "./../../conex.php";  
    include "./fetch_record.php";

    $FPCN_Prueba = utf8_decode($_POST['FPCN_Prueba']);
    $FNPR_fecha_aplicacion = $_POST['FNPR_fecha_aplicacion'];
    $FNPR_fecha_inscripcion = $_POST['FNPR_fecha_inscripcion'];
    $FNPR_sede = $_POST['FNPR_sede'];
    $FNPR_periodo = $_POST['FNPR_periodo'];
    $FNPR_estado_prueba = $_POST['FNPR_estado_prueba'];

    
    $SqlNewPrueba = "INSERT INTO prueba (prueba, fecha_aplicacion_prueba, fecha_inscripcion_prueba, id_sede, id_periodo, id_estado_prueba) VALUES ('".$FPCN_Prueba."', '".$FNPR_fecha_aplicacion."', '".$FNPR_fecha_inscripcion."','".$FNPR_sede."','".$FNPR_periodo."','".$FNPR_estado_prueba."')"; 
    
    $ResultSQl = $conex->query($SqlNewPrueba);  

    if($ResultSQl == true){             
        $restext = "La prueba se creo correctamente";           
        $respuesta = true;
    }
    else{  
        $restext = "Hubo un problema al crear la prueba";
        $respuesta = false; 
    }//fin del else inscripcion
       

    echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 


?>