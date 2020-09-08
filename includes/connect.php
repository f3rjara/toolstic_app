<?php
    function db_connect() {    
        static $conex;
        if(!isset($conex)) {        
            $config = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/private/config.ini'); 
            $conex = mysqli_connect($config['servidor'],$config['usuario'],$config['pass'],$config['bbdd']);
        }
        
        if($conex === false) {
                // Manejo de error - notificamos al administrador, creamos un archivo log, mostramos un error en pantalla, etc.
            return mysqli_connect_error(); 
        }
        return $conex;
    }

    // Conexión a la base de datos
    $conex = db_connect();
    $conex->set_charset("utf8;");  

    // Revisamosconexión
    if ($conex->connect_error) {
        die("Connection failed: " . $conex->connect_error);
    }    
     
?>