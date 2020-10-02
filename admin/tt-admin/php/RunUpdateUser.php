<?php
    session_start();
    if(isset($_SESSION['user_docente'])){ $userlog = $_SESSION['user_docente']; }
    else{ header('Location: ../../'); }

    require "./../../conex.php";    


    $FUU_id_user = $_POST['FUU_id_user'];
    $FUU_name = $_POST['FUU_name'];
    $FUU_apellido = $_POST['FUU_apellido'];
    $FUU_tipo_user = $_POST['FUU_tipo_user'];
    $FUU_correo_user = $_POST['FUU_correo_user'];
    $FUU_reset_pw = (string)$_POST['FUU_reset_pw'];

    $pwReser= '5309465306180a6a0de5def13b5347c7';

    if($FUU_reset_pw == 'false'){
        $sqlUpdateUser = "UPDATE usuario SET nombres_usuario = '".$FUU_name."', apellidos_usuario = '".$FUU_apellido."', correo_usuario = '".$FUU_correo_user."', id_tipo_usuario = '".$FUU_tipo_user."' WHERE usuario.id_usuario = '".$FUU_id_user."'"; 
    }
    else{
        $sqlUpdateUser = "UPDATE usuario SET nombres_usuario = '".$FUU_name."', apellidos_usuario = '".$FUU_apellido."', correo_usuario = '".$FUU_correo_user."', id_tipo_usuario = '".$FUU_tipo_user."', password_usuario = '".$pwReser."' WHERE usuario.id_usuario = '".$FUU_id_user."'";               
    }
       
        
        $ResultSQl = $conex->query($sqlUpdateUser);        
        if($ResultSQl == true){             
            $restext = "La usuario se actualizó correctamente";           
            $respuesta = true;
        }
        else{  
            $restext = "Hubo un problema al actualizar el usuario";
            $respuesta = false; 
        }//fin del else inscripcion


    echo json_encode(array("res"=>$respuesta,"restext"=>$restext, "bandera"=>$FUU_reset_pw)); 


?>