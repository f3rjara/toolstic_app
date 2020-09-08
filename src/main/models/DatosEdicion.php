<?php       
    include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
    include (ROOT_INCLUDE."/connect.php");  
    include_once (ROOT_INCLUDE.'/fetch_array.php'); 
    include_once (ROOT_MAIN.'/views/sesion_student.php'); 
    if( $_SESSION['error_user'] != FALSE && $_SESSION['user_student'] == NULL) { header('Location: '.ROOT_MEDIA_USER.'/');   }   
    

    $codigo = $_POST['codigo'];

    $sql="SELECT * FROM estudiante WHERE cod_estudiante = ?";
    
    $query=$conex->prepare($sql);
    $query->bind_param('i',$codigo);
    $query->execute();
    $datos=$query->get_result()->fetch_assoc();
    
    echo json_encode($datos, JSON_UNESCAPED_UNICODE);
   
    $conex->close();   
    



?>