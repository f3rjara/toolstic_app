<?php
    session_start();
    if(isset($_SESSION['user_docente'])){ $userlog = $_SESSION['user_docente']; }
    else{ header('Location: ../../'); }

    require "./../../conex.php";  
    include "./fetch_record.php";

    $FPEG_Id_grupo = $_POST['FPEG_Id_grupo'];
    $FPEG_grupo = $_POST['FPEG_grupo'];
    $FPEG_prueba = $_POST['FPEG_prueba'];
    $FPEG_aula = $_POST['FPEG_aula'];
    $FPEG_horario = $_POST['FPEG_horario'];
    $FPEDG_cupos_ofrecidos = $_POST['FPEDG_cupos_ofrecidos'];
    $FPEG_estad_grupo = $_POST['FPEG_estad_grupo'];


    $SqlUpdateGrupo = "UPDATE grupo SET grupo = '".$FPEG_grupo."', id_prueba = '".$FPEG_prueba."', aula_grupo = '".$FPEG_aula."', horario_grupo = '".$FPEG_horario."', cupos_ofrecidos_grupo = '".$FPEDG_cupos_ofrecidos."', id_estado_grupo = '".$FPEG_estad_grupo."' WHERE id_grupo = '".$FPEG_Id_grupo."'"; 

    
    $ResultSQl = $conex->query($SqlUpdateGrupo);  

    if($ResultSQl == true){             
        $restext = "La grupo se actualizo correctamente";           
        $respuesta = true;
    }
    else{  
        $restext = "Hubo un problema al actualizar el grupo";
        $respuesta = false; 
    }//fin del else inscripcion
       

    echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 


?>