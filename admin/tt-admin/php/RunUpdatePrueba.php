<?php
    session_start();
    if(isset($_SESSION['user_docente'])){ $userlog = $_SESSION['user_docente']; }
    else{ header('Location: ../../'); }

    require "./../../conex.php";  
    include "./fetch_record.php";

    $FPE_Id_prueba=$_POST['FPE_Id_prueba'];
    $FPE_prueba=$_POST['FPE_prueba'];
    $FPE_fecha_aplicacion=$_POST['FPE_fecha_aplicacion'];
    $FPE_fecha_inscripcion=$_POST['FPE_fecha_inscripcion'];
    $FPE_sede=$_POST['FPE_sede'];
    $FPE_periodo=$_POST['FPE_periodo'];
    $FPE_estado_prueba=$_POST['FPE_estado_prueba'];


    $SqlUpdatePrueba = "UPDATE prueba SET prueba = '".$FPE_prueba."', fecha_aplicacion_prueba = '".$FPE_fecha_aplicacion."', fecha_inscripcion_prueba = '".$FPE_fecha_inscripcion."', id_sede ='".$FPE_sede."', id_periodo = '".$FPE_periodo."', id_estado_prueba = '".$FPE_estado_prueba."' WHERE id_prueba = '".$FPE_Id_prueba."'"; 

    
    $ResultSQl = $conex->query($SqlUpdatePrueba);  

    if($ResultSQl == true){             
        $restext = "La prueba se actualizo correctamente";           
        $respuesta = true;
    }
    else{  
        $restext = "Hubo un problema al actualizar la prueba";
        $respuesta = false; 
    }//fin del else inscripcion
       

    echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 


?>