<?php
    require 'conex.php';
    
    session_start();
    $ruta = $_POST['since'];
    $UsRe = $_POST['usuario_valida'];
    $PwRe = md5($_POST['pw_valida']);

    $UsuarioConec = "SELECT * FROM usuario, tipo_usuario WHERE usuario.id_usuario = '".$UsRe."' AND usuario.password_usuario = '".$PwRe."' AND usuario.id_tipo_usuario = tipo_usuario.id_tipo_usuario ";


    $usuarios = $conex->query($UsuarioConec);


    if($usuarios->num_rows == 1):
        $datos = $usuarios->fetch_assoc();
        $id = $datos['id_tipo_usuario'];
        echo json_encode(array('error' => false, 'tipo' => $id, 'ruta'=> $ruta));        
        $_SESSION['user_docente'] = $datos;       
    else:        
        echo json_encode(array('error' => true));
    endif;

    $conex->close();

    
?>