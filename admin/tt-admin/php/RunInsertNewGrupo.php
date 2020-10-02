<?php
    session_start();
    if(isset($_SESSION['user_docente'])){ $userlog = $_SESSION['user_docente']; }
    else{ header('Location: ../../'); }

    require "./../../conex.php";  
    include "./fetch_record.php";

    $FNewG_grupo = $_POST['FNewG_grupo'];
    $FNewG_prueba = $_POST['FNewG_prueba'];
    $FNewG_aula = $_POST['FNewG_aula'];
    $FNewG_horario = $_POST['FNewG_horario'];
    $FNewG_cupos_ofrecidos = $_POST['FNewG_cupos_ofrecidos'];
    $FNewG_estad_grupo = $_POST['FNewG_estad_grupo'];


    $SqlNewGrupo = "INSERT INTO grupo (grupo, id_prueba, aula_grupo, horario_grupo, cupos_ofrecidos_grupo, total_inscritos_grupo,id_estado_grupo) VALUES ('".$FNewG_grupo."', '".$FNewG_prueba."', '".$FNewG_aula."','".$FNewG_horario."','".$FNewG_cupos_ofrecidos."','0','".$FNewG_estad_grupo."')"; 
    
    $ResultSQl = $conex->query($SqlNewGrupo);  

    if($ResultSQl == true){             
        $restext = "El grupo se creo correctamente";           
        $respuesta = true;
    }
    else{  
        $restext = "Hubo un problema al crear el grupo";
        $respuesta = false; 
    }//fin del else inscripcion
       

    echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 


?>