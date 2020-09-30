
<?php
    include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
    include (ROOT_INCLUDE."/connect.php");  
    include_once (ROOT_INCLUDE.'/fetch_array.php'); 
    include_once (ROOT_MAIN.'/views/sesion_student.php'); 
    if ( !isset($_SESSION['user_student']) || ( $_SESSION['error_user'] != FALSE && $_SESSION['user_student'] == NULL)) { header('Location: '.ROOT_MEDIA_USER.'/') ;   }  


    $id_cuestionario = $_POST['id_cuestionario'];
    $cod_estudiante = $_POST['cod_estudiante'];
    $id_opcion_respuesta = $_POST['id_opcion_respuesta'];
    $fecha_rta_enviada = $_POST['fecha_rta_enviada'];
    $ip_estudiante = $_POST['ip_estudiante'];
    $id_estado_rta_enviada = $_POST['id_estado_rta_enviada'];
    $id_pregunta = $_POST['id_pregunta'];
    
    $Daticos = Array($id_cuestionario,$cod_estudiante,$id_opcion_respuesta,$fecha_rta_enviada,$ip_estudiante,$id_estado_rta_enviada,$id_pregunta);
    
    //SE CONSULTA SI TIENE RESPUESTAS GUARDADAS
    $ResSalved = RecoveryRespuSave($conex, $id_cuestionario, $cod_estudiante);
  
    if(count($ResSalved) > 0){
        
        // SE VERIFICA SI ACTUALIZA LA RESPUESTA O LA CREA
        $sqlSaveRta = "SELECT id_rta_enviada_estudiante FROM rta_enviada_estudiante WHERE id_cuestionario = '".$id_cuestionario."' AND cod_estudiante = '".$cod_estudiante."' AND id_pregunta = '".$id_pregunta."'";        

        $ResultSql = $conex->query($sqlSaveRta); 
        if($ResultSql->num_rows > 0){   
            $datos = $ResultSql->fetch_assoc();         
            $sqlResponse_0 = "UPDATE rta_enviada_estudiante SET id_opcion_respuesta = '".$id_opcion_respuesta."', fecha_rta_enviada = '".$fecha_rta_enviada."', id_estado_rta_enviada = '".$id_estado_rta_enviada."' WHERE id_rta_enviada_estudiante = '".$datos['id_rta_enviada_estudiante']."' AND  cod_estudiante = '".$cod_estudiante."' AND id_pregunta = '".$id_pregunta."' ";
        
            $EjecutaInscripcion_0 = $conex->query($sqlResponse_0);   

            if($EjecutaInscripcion_0 == true){ 
                $restext = "Se guarda la respuesta correctamente";
                $respuesta = true; 
            }
            else{  
                $restext = "Hubo un problema al guardar la respuesta";
                $respuesta = false; 
            }//fin guardar pregunta
        }
        else{
            $sqlResponse_0 = "INSERT INTO rta_enviada_estudiante(id_cuestionario, cod_estudiante, id_pregunta, id_opcion_respuesta, fecha_rta_enviada, ip_estudiante, id_estado_rta_enviada) VALUES('".$id_cuestionario."','".$cod_estudiante."','".$id_pregunta."','".$id_opcion_respuesta."','".$fecha_rta_enviada."','".$ip_estudiante."','".$id_estado_rta_enviada."')";
        
            $EjecutaInscripcion_0 = $conex->query($sqlResponse_0);        
            if($EjecutaInscripcion_0 == true){ 
                $restext = "Se guarda la respuesta correctamente";
                $respuesta = true; 
            }
            else{  
                $restext = "Hubo un problema al guardar la respuesta";
                $respuesta = false; 
            }//fin guardar pregunta
        }
       

    } 
    else{
        $sqlResponse_0 = "INSERT INTO rta_enviada_estudiante(id_cuestionario, cod_estudiante, id_pregunta, id_opcion_respuesta, fecha_rta_enviada, ip_estudiante, id_estado_rta_enviada) VALUES('".$id_cuestionario."','".$cod_estudiante."','".$id_pregunta."','".$id_opcion_respuesta."','".$fecha_rta_enviada."','".$ip_estudiante."','".$id_estado_rta_enviada."')";
        
        $EjecutaInscripcion_0 = $conex->query($sqlResponse_0);        
        if($EjecutaInscripcion_0 == true){ 
            $restext = "Se guarda la respuesta correctamente";
            $respuesta = true; 
        }
        else{  
            $restext = "Hubo un problema al guardar la respuesta";
            $respuesta = false; 
        }//fin guardar pregunta

       
    }   
   

    $conex->close();
    
    echo json_encode(array("res"=>$respuesta,"restext"=>$restext, "datas"=> $Daticos)); 



?>