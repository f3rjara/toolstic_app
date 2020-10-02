<?php
    session_start();
    
   

    if(isset($_SESSION['user_docente'])){
        $userlog = $_SESSION['user_docente'];
    }
    else{
        header('Location: ../../logout.php');
    }   
    
    //var_dump($userlog);

    $id_user = $userlog['id_usuario'];
    $nommbre = utf8_encode($userlog['nombres_usuario']);
    $apellidos = utf8_encode($userlog['apellidos_usuario']);
    $correo = utf8_encode($userlog['correo_usuario']);
    $telefono = $userlog['telefono_usuario'];

    


    echo json_encode(array(
        "id_user"=>$id_user,
        "nommbre"=>$nommbre,
        "apellidos"=>$apellidos,
        "correo"=>$correo,
        "telefono"=>$telefono
    ));





?>