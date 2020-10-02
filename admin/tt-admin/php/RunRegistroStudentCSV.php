<?php

    session_start();
    if(isset($_SESSION['user_docente'])){ $userlog = $_SESSION['user_docente']; }
    else{ header('Location: ../../'); }

    require "./../../conex.php";  
    include "./fetch_record.php";

    $ArchivoCSV = $_FILES["FRE_ArchivoCSV"];     
    $explode_name = explode('.',$ArchivoCSV['name']);
    $archivotmp = $_FILES['FRE_ArchivoCSV']['tmp_name'];
 
//cargamos el archivo
    if($explode_name[1] == 'csv'){        
        $lineas = file($archivotmp);
        $encabezados = 0;
        foreach ($lineas as $linea_num => $linea)
        {  
            
            $datos = explode(",",$linea);
            if(count($datos)-1 == 6)
            {   
                if($encabezados != 0) 
                { 
                    $cod_estudiante = $datos[0]; 
                    $num_identificacion = $datos[1];
                    $nombres_estudiante = utf8_decode($datos[2]);
                    $apellidos_estudiante = utf8_decode($datos[3]);
                    $correo_estudiante = $datos[4];                     
                    $semestre_estudiante = $datos[5]; 

                    $buscar=array(chr(13).chr(10), "\r\n", "\n", "\r");
                    $reemplazar=array("", "", "", "");

                    $id_programa=str_ireplace($buscar,$reemplazar,$datos[6]);   
                    
                    $pwEs = md5($datos[0]);
                    
                    $SqlRegisto =  "INSERT INTO estudiante(cod_estudiante,num_documento,nombres_estudiante,apellidos_estudiante,password_estudiante,correo_estudiante,semestre_estudiante,id_programa,realizo_prueba,estudiante_habilitado) VALUES('".$cod_estudiante."', '".$num_identificacion."','".$nombres_estudiante."','".$apellidos_estudiante."','".$pwEs."','".$correo_estudiante."','".$semestre_estudiante."','".$id_programa."','0','1')";

                    $ResultSQl = $conex->query($SqlRegisto);  
                    if($ResultSQl == true){             
                        $restext = "Se registraron los estudiantes conexito";
                        $respuesta = true; 
                    }
                    else{  
                        $restext = "Hubo un problema al registrar algunos estudiantes, ya se encuntran registrados en la plataforma";
                        $respuesta = false; 
                    }//fin del else registro
                    
                                    
                }
                else if ($encabezados == 0){
                    if($datos[0] == "cod_estudiante" && $datos[1] == "nombres_estudiante" && $datos[2] == "apellidos_estudiante" && $datos[3] == "correo_estudiante" &&  $datos[4] == "semestre_estudiante" && ($datos[5] == "id_programa" || $datos[5] == "id_programa\n" || $datos[5] == "id_programa\r\n" )){
                        $restext = "No hay datos por cargar";
                        $respuesta = false; 
                    }
                    else{
                        $restext = "El archivo no tiene los encabezados correctos";
                        $respuesta = false;
                    }                    
                }
                $encabezados++;  
            }//FIN DE IF QUE VERIFICA QUE SEAN 5 ENCABEZADOS
            else{
                $restext = "El archivo no tiene la estructura correspondiente";
                $respuesta = false; 
                break;
            }//FIN ELSE
            
        }//fin foreach        
    }
    else{           
        $restext = "El tipo del archivo no es valido";
        $respuesta = false;         
    } 

    echo json_encode(array("res"=>$respuesta,"restext"=>$restext,"encabezado"=>$encabezados)); 

    /*

    if($encabezados == 0){
                    //$datos = explode(",",$linea);
                    if($datos[0] != "cod_estudiante" && $datos[1] != "nombres_estudiante" && $datos[2] != "apellidos_estudiante" && $datos[3] != "correo_estudiante" &&  $datos[4] != "semestre_estudiante" && ($datos[5] != "id_programa" || $datos[5] != "id_programa\n" || $datos[5] != "id_programa\r\n" )){
                        $restext = "El archivo no tiene los encabezados correctos";
                        $respuesta = false;
                    }
                }
                else if($encabezados != 0){
                    //$datos = explode(",",$linea);
                    $restext = "Se cargaran los estudiantes";
                    $respuesta = true; 

                }   

    */
?>