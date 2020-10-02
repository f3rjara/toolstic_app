<?php

    session_start();
    if(isset($_SESSION['user_docente'])){ $userlog = $_SESSION['user_docente']; }
    else{ header('Location: ../../'); }

    require "./../../conex.php";  
    include "./fetch_record.php";

    $cod_estu = $_POST['cod_estu'];  

    $SqlDeleteRespuestas = "DELETE FROM rta_enviada_estudiante WHERE cod_estudiante = '".$cod_estu."'";
    $Result1 = $conex->query($SqlDeleteRespuestas); 
    if( $Result1 ){ 
        $SqlDeleteResultados = "DELETE FROM resultado_cuestionario WHERE cod_estudiante = '".$cod_estu."'";
        $Result2 = $conex->query($SqlDeleteResultados); 
        if( $Result2 ){ 
            $SqlDeleteCuestionario = "DELETE FROM cuestionario WHERE cod_estudiante = '".$cod_estu."'";
            $Result3 = $conex->query($SqlDeleteCuestionario); 
            if ( $Result3 ) {
                $actualizarStudnt = "UPDATE estudiante SET realizo_prueba = '0', estudiante_habilitado = '1' WHERE estudiante.cod_estudiante = '".$cod_estu."'";
                $Result4 = $conex->query($actualizarStudnt); 
                if ( $Result4 ) {
                    $restext = "El estudiante esta habilitado para presentar la prueba!";
                    $respuesta = true; 
                }
                else {
                    $restext = "Hubo un problema al actualizar al estudiante";
                    $respuesta = false; 
                }
            }
            else {
                $restext = "Hubo un problema al eliminar los cuestionarios del estudiante";
                $respuesta = false; 
            }
        }
        else {
            $restext = "Hubo un problema al eliminar los resultados del estudiante";
            $respuesta = false; 
        }
    }
    else{
        $restext = "Hubo un problema al eliminar las respuestas del estudiante";
        $respuesta = false; 
    }
        
        $conex->close();

    echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 

?>