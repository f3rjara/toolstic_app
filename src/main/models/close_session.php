<?php

    
    include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
    include (ROOT_INCLUDE."/connect.php");  
    include_once (ROOT_INCLUDE.'/fetch_array.php'); 
    session_start();  

    $student = $_POST['student'];
    $restext = "";

    if ( isset( $_SESSION['user_student'] ) ) {
        $login = "UPDATE estudiante SET is_logged = 0 WHERE estudiante.cod_estudiante = ' ". $userlog['cod_estudiante'] ." ' ";
        $eject = $conex->query( $login );
        if ( $eject ) :            
            if(isset($_SESSION['error_user'])){
                $_SESSION['error_user'] = TRUE;
            }            
            session_destroy(); 
            $restext = "La sesión fue cerrada satisfactoriamente";
            echo json_encode(array("res"=>true,"restext"=>$restext));
        else:
            session_destroy();
            $restext = "Hubo un problema al cerrar la sesión";
            echo json_encode(array("res"=>false,"restext"=>$restext));
        endif;
        
    }
    else {
        $login = "UPDATE estudiante SET is_logged = 0 WHERE estudiante.cod_estudiante = ' ".$student." ' ";
        $eject = $conex->query( $login );
        if ( $eject ) :  
            session_destroy(); 
            $restext = "La sesión fue cerrada satisfactoriamente";
            echo json_encode(array("res"=>true,"restext"=>$restext));
        else:
            session_destroy();
            $restext = "Hubo un problema al cerrar la sesión";
            echo json_encode(array("res"=>false,"restext"=>$restext));
        endif;
    }

    

    ?>