<?php
    session_start();
    if(isset($_SESSION['user_docente'])){ $userlog = $_SESSION['user_docente']; }
    else{ header('Location: ../../'); }

    require "./../../conex.php";  
    include "./fetch_record.php";


    $FNU_id_user = $_POST['FNewUs_id_user'];
    $FNU_name = $_POST['FNewUs_name'];
    $FNU_apellido = $_POST['FNewUs_apellido'];
    $FNU_tipo_user = $_POST['FNewUs_tipo_user'];
    $FNU_correo = $_POST['FNewUs_correo'];

    $pwReser= '5309465306180a6a0de5def13b5347c7';

    $ExisteUsuario = (string)verificaExistenciaUser($FNU_id_user,$conex);
    
    if($ExisteUsuario === "false"){
        $sqlInsertUser = "INSERT INTO usuario (id_usuario, nombres_usuario, apellidos_usuario, password_usuario, correo_usuario,id_tipo_usuario) VALUES ('".$FNU_id_user."', '".$FNU_name."', '".$FNU_apellido."', '".$pwReser."', '".$FNU_correo."', '".$FNU_tipo_user."')"; 
        
        $ResultSQl = $conex->query($sqlInsertUser);  

        if($ResultSQl == true){             
            $restext = "La usuario se creo correctamente";           
            $respuesta = true;
        }
        else{  
            $restext = "Hubo un problema al crear el usuario";
            $respuesta = false; 
        }//fin del else inscripcion
    }
    else{
        $restext = "El usuario ya esta registrado en la plataforma";
        $respuesta = false; 
    }
    

    echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 


?>