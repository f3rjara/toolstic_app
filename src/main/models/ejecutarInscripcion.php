
<?php
     include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
     include_once (ROOT_INCLUDE."/connect.php");  
     include_once (ROOT_INCLUDE.'/fetch_array.php'); 
     include_once (ROOT_MAIN.'/views/sesion_student.php'); 
     if( $_SESSION['error_user'] != FALSE && $_SESSION['user_student'] == NULL) { header('Location: '.ROOT_MEDIA_USER.'/');   }   

    $idgrupo = $_POST['idgrupo'];
    $estudiante = $_POST['estudiante'];       
    
    $fechaServidor = ObtenerDateTime();

    $esrepr = "SELECT cod_estudiante FROM estudiante WHERE cod_estudiante = '".$estudiante."' AND realizo_prueba = 0";

    $esreprue = $conex->query($esrepr);

    if($esreprue->num_rows > 0){
        //SE COMPRUEBA SI HAY CUPOS
        $resultcupos = CuposGrupos($idgrupo,$conex);

        if($resultcupos){
            // SE REALIZA LA INSCRIPCIÓN, SE COMPRUEBA EN EL INDEX DE PRUEBAS SI EL ESTUDIANTE PUEDE O NO INSCRIBIRSE O  SI YA ESTA INSCRITO.
            $sqlInscripcion = "INSERT INTO inscripcion_prueba(id_grupo, cod_estudiante, fecha_inscripcion) VALUES('".$idgrupo."','".$estudiante."','".$fechaServidor['date']."')";
        
            $EjecutaInscripcion = $conex->query($sqlInscripcion);        
            if($EjecutaInscripcion == true){ 
                $restext = "La inscripción se realizó correctamente";           
                $respuesta = true;
            }
            else{  
                $restext = "Hubo un problema al realizar la inscripción";
                $respuesta = false; 
            }//fin del else inscripcion
        }
        else { 
            $restext = "No hay cupos disponibles";
            $respuesta = false; 
        }// fin else cupos
              

    } 
    else{
        $respuesta = false;
    }   
                
    $conex->close();
    
    echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 



?>