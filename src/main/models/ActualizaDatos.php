<?php
    include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
    include (ROOT_INCLUDE."/connect.php");  
    include_once (ROOT_INCLUDE.'/fetch_array.php'); 
    include_once (ROOT_MAIN.'/views/sesion_student.php'); 
    if( $_SESSION['error_user'] != FALSE && $_SESSION['user_student'] == NULL) { header('Location: '.ROOT_MEDIA_USER.'/');   }   
    
    $userLogueado = $userlog['cod_estudiante'];
    $PWuserLogueado = $userlog['password_estudiante'];   
    
    $GenerarNewPass = FALSE ;
    
    
    $CodigoUsuario =    $_POST['CodigoUsuario'];
    $NombreUsuario =    $_POST['NombreUsuario'];
    $ApellidoUsuario =  $_POST['ApellidoUsuario'];
    $CorreoUsuario =    $_POST['CorreoUsuario'];
    $TelUsuario =       $_POST['TelUsuario'];
    $PWUsuario =        md5($_POST['PWUsuario']);
    $NewPWUsuario =     md5($_POST['NewPWUsuario']);
    $RNewPWUsuario =    md5($_POST['RNewPWUsuario']);

    if($NewPWUsuario !== md5('false')) {
        $GenerarNewPass = TRUE ;
    }

    if($PWuserLogueado !== $PWUsuario) {
        echo json_encode(array('GenerarNewPass'=>$GenerarNewPass, 'res'=> false, "resText" => "Contraseña invalida", "Reinicio" => false));
    }
    else {        

        if($GenerarNewPass === TRUE){
            if($NewPWUsuario !== $RNewPWUsuario)  {
                echo json_encode(array('GenerarNewPass'=>$GenerarNewPass, 'res'=> false, "resText" => "Contraseañas no coiniciden", "Reinicio" => false));
            }
            else{

                $SqlUser = "UPDATE estudiante SET 
                        nombres_estudiante = '".$NombreUsuario."',
                        apellidos_estudiante = '".$ApellidoUsuario."',
                        correo_estudiante = '".$CorreoUsuario."',
                        telefono_estudiante = '".$TelUsuario."',  
                        password_estudiante = '".$NewPWUsuario."' WHERE  
                        cod_estudiante = '" . $CodigoUsuario . "' ";


                $ResultSql = $conex->query($SqlUser); 

                if($ResultSql == true){             
                    $restext = "Datos actualizados, debe iniciar sesión nuevamente";           
                    $respuesta = true;
                    $reincio = true;
                }
                else{  
                    $restext = "Hubo un problema al actualizar los datos";
                    $respuesta = false; 
                    $reincio = false;

                }//fin del else inscripcion
                
                echo json_encode(array('GenerarNewPass'=>$GenerarNewPass, 'res'=> $respuesta, "resText" => $restext, "Reinicio" => $reincio, "sql"=>$SqlUser));

            }
        }
        else{

            $SqlUser = "UPDATE estudiante SET 
                        nombres_estudiante = '".$NombreUsuario."',
                        apellidos_estudiante = '".$ApellidoUsuario."',
                        correo_estudiante = '".$CorreoUsuario."',
                        telefono_estudiante = '".$TelUsuario."' WHERE
                        cod_estudiante = '" . $CodigoUsuario . "' ";


                $ResultSql = $conex->query($SqlUser); 

                if($ResultSql == true){             
                    $restext = "Datos actualizados con exito";           
                    $respuesta = true;
                    $reincio = false;
                }
                else{  
                    $restext = "Hubo un problema al actualizar los datos";
                    $respuesta = false; 
                    $reincio = false;

                }//fin del else inscripcion
                
                echo json_encode(array('GenerarNewPass'=>$GenerarNewPass, 'res'=> $respuesta, "resText" => $restext, "Reinicio" => $reincio));

        }
        

    }

   $conex->close();
    
?>


