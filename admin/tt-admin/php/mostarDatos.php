<?php
    session_start();
    

    if(isset($_SESSION['user_docente'])){
        $userlog = $_SESSION['user_docente'];
    }
    else{
        header('Location: ../../logout.php');
    }

    $userLogueado = $userlog['id_usuario'];

    require "../../conex.php";    


    $sql="SELECT * FROM usuario, tipo_usuario WHERE usuario.id_tipo_usuario = tipo_usuario.id_tipo_usuario AND usuario.id_usuario = '".$userLogueado."'";
    
    $LosDatos=$conex->query($sql);    
    $card = "";
    
    if($LosDatos->num_rows > 0){
        $datos = $LosDatos->fetch_assoc();  
        $_SESSION['DatosMostar'] = $datos;
        $card = " 
            <div class='card-content ToolsTic_Blue right-align'>
                <div class='chip white black-text'><span>".utf8_encode($datos['tipo_usuario'])."</span></div>
            </div>
            <br>
            <img src='../../img/admin.gif' class='circle' width='55%'>

            <div class='card-content ToolsticBlanco'>
                <span class='card-title'><b>".$datos['nombres_usuario']." ".$datos['apellidos_usuario']."</b></span> <hr>
                <p>Universidad de Nariño.</p>
            </div>

            <div class='card-content left-align white-text ToolsTic_Blue darken-2'>
                <div class='user-data'>
                    <b><i class='material-icons'>contacts</i></b> &nbsp;
                    <span>".$datos['id_usuario']."</span> <br>
                </div>

                <div class='user-data'>
                    <b><i class='material-icons'>contact_phone</i></b> &nbsp; <span>".$datos['telefono_usuario']."</span> <br>
                </div>

                <div class='user-data'>
                    <b><i class='material-icons'>contact_mail</i></b> &nbsp;
                    <span> ".$datos['correo_usuario']."</span> <br>
                </div> 
            </div>
            <a class='btn-floating tooltipped halfway-fab waves-effect waves-light red modal-trigger' data-position='top' data-tooltip='Editar información' href='#modalActualiza' onclick='agregaDatosEdicion(".$datos['id_usuario'].")' ><i class='material-icons'>edit</i></a>
        ";        
    }

    $conex->close();
    
    echo $card;
    

?>
    
<!--
*********
                 


