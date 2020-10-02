<?php
    session_start();
    if(isset($_SESSION['user_docente'])){ $userlog = $_SESSION['user_docente']; }
    else{ header('Location: ../../'); }

    require "./../../conex.php";  
    

    $cod_estu=$_POST['cod_estu'];
    
    $pass = md5($cod_estu);


    $SqlUpdateStudent = "UPDATE estudiante SET password_estudiante = '".$pass."' WHERE cod_estudiante = '".$cod_estu."'"; 
    
    $ResultSQl = $conex->query($SqlUpdateStudent);  

    if($ResultSQl == true){             
        $restext = "La contraseña se actualizo, su nueva constraseña es su código";           
        $respuesta = true;
    }
    else{  
        $restext = "Hubo un problema al actualizar la contraseña";
        $respuesta = false; 
    }//fin del else inscripcion
       

    echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 


?>