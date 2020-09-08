<?php
    include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
?>
<ul id="slide-out" class="sidenav menu-student ">
        <li>
            <div class="user-view">
                <div class="background">
                    <img src="<?php echo ROOT_PUBLIC; ?>/img/student.gif" width="100%" class=" responsive-img">
                </div>
                <br> <br>
                <div class="chip ToolsticAzul"> 
                    <a href="" class="white-text">
                        <b id="NombreLog"></b>&nbsp;
                        <b id="ApellidoLog"></b>
                    </a>
                </div>  <br>
                <div class="chip ToolsticAzul"> 
                    <a href="" class="white-text">
                        <b id="CorreoLog"></b>&nbsp;
                    </a>
                </div>  <br>
            </div>
        </li>


        <li>
            <a href="<?php echo ROOT_INCLUDE_MEDIA; ?>/logout.php" class="btn red ">
                <i class="white-text material-icons large">cancel</i>
                Cerrar Sesión
            </a>
        </li>              
                
        <li>
            <a href="<?php echo ROOT_MEDIA_USER; ?>/student/index.php" class="btn ToolsTic_Azul btnCard white-text">
                <i class="white-text material-icons large">person_pin</i>
                Mi perfil
            </a>
        </li>

        <li>
            <div class="divider"></div>
        </li>
        
        <li>
            <a href="<?php echo ROOT_MEDIA_USER; ?>/student/pruebas.php" class="center btn ToolsTic_Verde btnCard white-text">
                Inscripción a Pruebas
            </a>
        </li>        
        
        <li>
            <a href="<?php echo ROOT_MEDIA_USER; ?>/student/homologacion.php" class="center btn ToolsTic_Verde btnCard white-text" >
                Presentar Prueba
            </a>
        </li>

        <li>
            <a href="<?php echo ROOT_MEDIA_USER; ?>/student/resultados.php" class="center btn ToolsTic_Verde btnCard white-text">
                Resultados
            </a>
        </li>
       
        
</ul>