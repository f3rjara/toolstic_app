<?php     
    $conex = new mysqli('localhost','root','','toolsticapp_bd');
    if($conex->connect_errno){
        echo "Error al conectarse con la base de datos".$conex->connect_error;
    }    
    $conex->set_charset("utf8;");
       
    
?>