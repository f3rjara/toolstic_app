<?php

    
    include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
    include (ROOT_INCLUDE."/connect.php");  
    include_once (ROOT_INCLUDE.'/fetch_array.php'); 
    session_start();  

    
    $UsRe = $_POST['usuario_estudiante'];
    $PwRe = md5($_POST['pw_valida']);
    $FechaServer = ObtenerDateTime();

    $estudiante = "SELECT * FROM estudiante WHERE cod_estudiante = '".$UsRe."' AND password_estudiante = '".$PwRe."'";

    $usuario = $conex->query($estudiante);

    if( $usuario->num_rows > 0):
        $is_log = "SELECT is_logged FROM estudiante WHERE cod_estudiante = '".$UsRe."'";
        $result_log = $conex -> query( $is_log );
        if ( $result_log ):
            $validator = $result_log -> fetch_assoc();
            if ( $validator['is_logged'] == '1'): 
                $_SESSION['error_user'] = TRUE;
                echo json_encode(array('error' => true, 'mens'=>'Ya tiene una sesión iniciada', 'log' => true , 'student' => $UsRe ));
            else:
                $login = "UPDATE estudiante SET is_logged = 1, logined = '".$FechaServer['date']."' WHERE estudiante.cod_estudiante = ' ".$UsRe." ' ";
                $eject = $conex->query( $login );
                if ( $eject ) :
                    $datos = $usuario->fetch_assoc();             
                    $_SESSION['user_student'] = $datos;     
                    $_SESSION['error_user'] = FALSE;
                    echo json_encode(array('error' => false , 'logg' => $validator['is_logged']));  
                endif;
            endif;
        endif;     
    else:        
        $_SESSION['error_user'] = TRUE;
        echo json_encode(array('error' => true, 'mens'=>'Usuario o contraseña incorrectos', 'log' => false));
    endif;

    $conex->close();
  
?>

