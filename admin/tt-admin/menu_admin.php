
<ul id="slide-out" class="sidenav">
        <li>
            <div class="user-view">
                <div class="background">
                    <img src="../../img/admin.gif" class="responsive-img">
                </div>
                <br> <br>
                <div class="chip ToolsticAzul"> 
                    <a href="#name" class="white-text">
                        <b id="NombreLog"></b>&nbsp;<b id="ApellidoLog"></b>
                    </a>
                </div>  <br>
                <div class="chip ToolsticAzul">
                    <a href="mailto:<?php echo $userlog['correo_usuario']; ?>" target="_blank" class="white-text">
                        <b id="CorreoLog"></b>
                    </a>
                </div>
            </div>
        </li>

        <?php if($userlog['id_tipo_usuario'] == 1 || $userlog['id_tipo_usuario'] == 99) { ?>
            <li><a href="../" class="btn ToolsTic_Azul btnCard "><i class="white-text material-icons large">home</i>Inicio</a></li>
        <?php }; ?>                       
        
        
        <li><a href="perfil.php" class="btn ToolsTic_Azul btnCard white-text"><i class="white-text material-icons large">person_pin</i>Mi perfil</a></li>

        <li><div class="divider"></div></li>
        
        <li><a href="./users.php" class="center btn ToolsTic_Verde btnCard white-text">Gestionar Usuarios</a></li>
        
        <li><a href="./students.php" class="center btn ToolsTic_Verde btnCard white-text">Gestionar Estudiantes</a></li>

        <li><a href="./periodos.php" class="center btn ToolsTic_Verde btnCard white-text">Gestionar Periodos</a></li>

        <li><a href="./pruebas.php" class="center btn ToolsTic_Verde btnCard white-text" >Gestionar Pruebas</a></li>

        <li><a href="./grupos.php" class="center btn ToolsTic_Verde btnCard white-text" >Gestionar Grupos</a></li>

        <li><a href="./cuestionarios.php" class="center btn ToolsTic_Verde btnCard white-text" >Resultados</a></li>

            
        <li><a href="../logout.php" class="btn red "><i class="white-text material-icons large">cancel</i>Cerrar Sesión</a></li>
        
        <br>
        

        
    </ul>