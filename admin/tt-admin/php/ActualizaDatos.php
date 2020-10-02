<?php
    session_start();   

    if(isset($_SESSION['user_docente'])){
        $userlog = $_SESSION['user_docente'];
    }
    else{
        header('Location: ../../logout.php');
    }


    $userLogueado = $userlog['id_usuario'];
    $PWuserLogueado = $userlog['password_usuario'];
    
    require "../../conex.php";
    
    
    $pw=$conex->real_escape_string(htmlentities($_POST['FApassword']));
    $NuevaPW = false;
    $cambioPW = 'false';

    if($PWuserLogueado==md5($pw))
    {   
        
        $datos=array(
        $conex->real_escape_string(htmlentities($_POST['FAcorreo'])),
        $conex->real_escape_string(htmlentities($_POST['FAtelefono'])),
        $conex->real_escape_string(htmlentities($_POST['FApassword'])), 
        $conex->real_escape_string(htmlentities($_POST['FAnombre'])),
        $conex->real_escape_string(htmlentities($_POST['FAapellido'])), 
        $conex->real_escape_string(htmlentities($_POST['FAnewpassword1'])),
        $conex->real_escape_string(htmlentities($_POST['FAnewpassword2']))
            );
        
        
        if($datos[5]!== "" || $datos[6]!== "")
        {
            $NewP1 = md5($datos[5]);
            $NewP2 = md5($datos[6]); 
            $NuevaPW = true;
            $cambioPW = 'true';
        }
                
        if(isset($NewP1) == isset($NewP2) && $NuevaPW == true && $NewP1!=='7215ee9c7d9dc229d2921a40e899ec5f' ){ 
            
            $pw = $NewP1;
            
        }
        else {$pw = md5($pw);}
        
        
        
        $sql="
            UPDATE usuario
            SET     correo_usuario = ?,
                    telefono_usuario = ?,
                    password_usuario = ?,
                    nombres_usuario = ?,
                    apellidos_usuario = ?
            WHERE id_usuario = '".$userLogueado."'
        ";
        $nom = utf8_decode($datos[3]);
        $ape = utf8_decode($datos[4]);
        $corr = utf8_decode($datos[0]);
        
        $query=$conex->prepare($sql);
        $query->bind_param('sssss',$corr,$datos[1],$pw,$nom,$ape);
        
        
       
        
        $query->execute();
        $query->close();
        echo json_encode(array('res'=>1,'bandera'=>$cambioPW));
    }
    else
    {
        echo 2;
    }
    
    
   
    
?>


