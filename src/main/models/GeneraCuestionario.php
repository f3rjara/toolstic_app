<?php
    include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
    include (ROOT_INCLUDE."/connect.php");  
    include_once (ROOT_INCLUDE.'/fetch_array.php'); 
    include_once (ROOT_MAIN.'/views/sesion_student.php'); 
    if ( !isset($_SESSION['user_student']) || ( $_SESSION['error_user'] != FALSE && $_SESSION['user_student'] == NULL)) { header('Location: '.ROOT_MEDIA_USER.'/') ;   }  
    
    $intento = $_POST['intento'];
    $id_inscripcion = $_POST['inscripcion'];
    $estudiante = $_POST['estudiante'];
    $fecha_id = $_POST['fecha_id'];
    $Ip_estudiante = strval($_POST['Ip_estudiante']);
    $Fecha0 = ObtenerDateTime(); 
    $FechaCreacCues = $Fecha0['date'];

    $id_cuest = $intento."_".$estudiante."_".$fecha_id;

    //si intento > 0 se verifica si esta habilitado el intento por el admin
    if($intento > 0){
        $SqlHabilita = "SELECT habilitar_intento FROM cuestionario WHERE cod_estudiante = '".$estudiante."'";
        $ResultHabilita = $conex->query($SqlHabilita);  
        $data1 = $ResultHabilita->fetch_assoc();
        
        if($data1['habilitar_intento'] == 1){

            $InsertCuestionario = "INSERT INTO cuestionario (id_cuestionario, id_inscripcion, cod_estudiante,fecha_creacion_cuestionario,id_estado_cuestionario,ip_estudiante_intento,habilitar_intento)
            VALUES ('".$id_cuest."', '".$id_inscripcion."', '".$estudiante."','".$FechaCreacCues."','3','".$Ip_estudiante."','0');";
            
            
            $ResultSql = $conex->query($InsertCuestionario);  

            if($ResultSql == true){             
                $restext = "Se genero un nuevo  cuestionario";           
                $respuesta = true;
            }
            else{  
                $restext = "Hubo un problema al generar el cuestionario";
                $respuesta = false; 
            }//fin del else inscripcion
        }
        else{
            $restext = "No esta habilitado para un nuevo intento";
            $respuesta = false; 
        }
    }
    else{
        $InsertCuestionario = "INSERT INTO cuestionario (id_cuestionario, id_inscripcion, cod_estudiante,fecha_creacion_cuestionario,id_estado_cuestionario,ip_estudiante_intento,habilitar_intento)
            VALUES ('".$id_cuest."', '".$id_inscripcion."', '".$estudiante."','".$FechaCreacCues."','3','".$Ip_estudiante."','0');";
            
            
            $ResultSql = $conex->query($InsertCuestionario);  

            if($ResultSql == true){             
                $restext = "Se genero un nuevo  cuestionario";           
                $respuesta = true;
            }
            else{  
                $restext = "Hubo un problema al generar el cuestionario";
                $respuesta = false; 
            }//fin del else inscripcion
    }
    


    echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 

