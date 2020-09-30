
<?php
    include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
    include (ROOT_INCLUDE."/connect.php");  
    include_once (ROOT_INCLUDE.'/fetch_array.php'); 
    include_once (ROOT_MAIN.'/views/sesion_student.php'); 
    if ( !isset($_SESSION['user_student']) || ( $_SESSION['error_user'] != FALSE && $_SESSION['user_student'] == NULL)) { header('Location: '.ROOT_MEDIA_USER.'/') ;   }  
    
    $ArrayOPCHK = $_POST['ArrayOPCHK'];
    $id_cuestionario = $_POST['id_cuestionario'];
    $cod_estudiante  = $_POST['cod_estu'];
       
    $ResSalved = RecoveryRespuSave($conex, $id_cuestionario, $cod_estudiante);

    $HoraSistema = ObtenerDateTime();
    $ip_estudiante = ObtenerIpConex();

    for($num = 0 ;$num < 50; $num++){
        //SE CONSULTA el id de la pregunta de la rta enviada
        
        $idPregunta=0;              
        $idPregunta = IdPreDeOPR($ArrayOPCHK[$num], $conex);
       
        
        $id_estado_rta_enviada = 1;

        if($ArrayOPCHK[$num]%5 != 0){
            $id_estado_rta_enviada = 2;
        }
        

        // SE VERIFICA SI ACTUALIZA LA RESPUESTA O LA CREA
        $sqlSaveRta = "SELECT id_rta_enviada_estudiante FROM rta_enviada_estudiante WHERE id_cuestionario = '".$id_cuestionario."' AND cod_estudiante = '".$cod_estudiante."' AND id_pregunta = '".$idPregunta."'";        

        $ResultSql = $conex->query($sqlSaveRta); 
        
        if($ResultSql->num_rows > 0){   
            $datos = $ResultSql->fetch_assoc();         
            $sqlResponse_0 = "UPDATE rta_enviada_estudiante SET id_opcion_respuesta = '".$ArrayOPCHK[$num]."', id_estado_rta_enviada = '".$id_estado_rta_enviada."' WHERE id_rta_enviada_estudiante = '".$datos['id_rta_enviada_estudiante']."' AND  cod_estudiante = '".$cod_estudiante."' AND id_pregunta = '".$idPregunta."' ";
        
            $EjecutaInscripcion_0 = $conex->query($sqlResponse_0);   

            if($EjecutaInscripcion_0 == true){ 
                $restext = "Se ACTUALIZA la respuesta correctamente";
                $respuesta = true; 
            }
            else{  
                $restext = "Hubo un problema al ACTUALIZAR la respuesta";
                $respuesta = false; 
            }//fin guardar pregunta
        }
        else{
            $sqlResponse_0 = "INSERT INTO rta_enviada_estudiante(id_cuestionario, cod_estudiante, id_pregunta, id_opcion_respuesta, fecha_rta_enviada, ip_estudiante, id_estado_rta_enviada) VALUES('".$id_cuestionario."','".$cod_estudiante."','".$idPregunta."','".$ArrayOPCHK[$num]."','".$HoraSistema['date']."','".$ip_estudiante."','".$id_estado_rta_enviada."')";
        
            $EjecutaInscripcion_0 = $conex->query($sqlResponse_0);  

            if($EjecutaInscripcion_0 == true){ 
                $restext = "Se GUARDA la respuesta correctamente";
                $respuesta = true; 
            }
            else{  
                $restext = "Hubo un problema al GUARDAR la respuesta";
                $respuesta = false; 
            }//fin guardar pregunta
        }
            
       

    } // FIN FOR
    
    if($respuesta == true){
        UpdateCuestion($id_cuestionario, 4, $cod_estudiante, $HoraSistema['date'], $conex);
        UpdateEstudianteFin($cod_estudiante, $conex);
        $ArrayResult = SaveResultCuestionario($cod_estudiante, $id_cuestionario, $conex);
        NewResultCues($ArrayResult, $cod_estudiante, $id_cuestionario, $conex);
    }    

    //$conex->close();

    echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 











    
    
   



?>