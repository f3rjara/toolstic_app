<?php     
    $conex = new mysqli('sql102.eshost.com.ar','eshos_24671878','ToolsTic','eshos_24671878_toolsticapp_bd');
    if($conex->connect_errno){
        echo "Error al conectarse con la base de datos".$conex->connect_error;
    }    
    $conex->set_charset("utf8;");
       
    
?>