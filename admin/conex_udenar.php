<?php     
    $conex = new mysqli('10.10.10.121','moodle_tools','Tools2020','moodle_tools');
    if($conex->connect_errno){
        echo "Error al conectarse con la base de datos".$conex->connect_error;
    }    
    $conex->set_charset("utf8;");
       
    
?>