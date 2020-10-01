<?php
    include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
    include_once (ROOT_INCLUDE."/connect.php");  
    include_once (ROOT_INCLUDE.'/fetch_array.php'); 
    include_once (ROOT_MAIN.'/views/sesion_student.php'); 
    if( $_SESSION['error_user'] != FALSE && $_SESSION['user_student'] == NULL) { header('Location: '.ROOT_MEDIA_USER.'/');   }   
    
?>

<html lang="es">

    <head>        
        <title>Estudiante | ToolsTic</title>  
        <?php include (ROOT_INCLUDE."/headers.php"); ?>
        <link rel="stylesheet" href="<?php echo ROOT_PUBLIC;?>/css/index.css">        
    </head>
        

    <body class="ToolsticBlanco" >
        <div class="navbar-fixed">
            <nav class="ToolsTic_Verde z-depth-2">
                <div class="nav-wrapper">
                    <a class="brand-logo center">
                        <img src="<?php echo ROOT_PUBLIC;?>/img/logotipo.png" width="230px">
                    </a>                     
                    <ul id="nav-mobile show-on-small" class="left">
                        <li>
                            <a href="#" data-target="slide-out" class="sidenav-trigger">
                                <i class="material-icons">menu</i>
                            </a>
                        </li>                
                    </ul>                
                </div>
            </nav> 
        </div>

        <?php            
            include (ROOT_MAIN.'/views/menu_student.php');   
            //ActualizaEstadoPrueba($conex); 
        ?>
       
        <br>
        
        <main class="white mainTT"> 
            <div class="row container">
                <div class='row'>
                    <div class='col s12 center'>
                        <!-- <i class='material-icons large'>person_pin</i><br> -->
                        <img src='<?php echo ROOT_PUBLIC;?>/img/student.gif' width='30%' height='auto'>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 center">
                        <h5 style="font-weight: 600;" ><b id="NomEstudiante"></b></h5>
                        <h6><b id="codEstudiante"></b></h6>
                        <div class='chip ToolsTic_Verde white-text'>
                            <span><b>Estudiante</b></span>
                        </div>
                    </div>
                </div>

                <div class='row'>
                    <div class='progress'>
                        <div class='indeterminate'></div>
                    </div> <br>
                </div>

                <div class="row">
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>subtitles</i>
                        <input id='TipoDocumentoEs' type='text' class='validate infoEstu' disabled >
                        <label for='TipoDocumentoEs'>Tipo de documento</label>
                    </div>
                
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>chrome_reader_mode</i>
                        <input id="CedulaEstudiante" type='text' class='validate infoEstu' disabled >
                        <label for='CedulaEstudiante'>Número de documento</label>
                    </div>
                </div>
                
                <div class="row">
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>school</i>
                        <input id='programaEstudiante' type='text' class='validate infoEstu' disabled >
                        <label for='programaEstudiante'>Programa académico</label>
                    </div>
                
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>grade</i>
                        <input id='semestreEstudiante' type='text' class='validate infoEstu' disabled >
                        <label for='semestreEstudiante'>Semestre</label>
                    </div>
                </div>

                <div class="row">
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>email</i>
                        <input id='CorreoEstudiante' type='text' class='validate infoEstu' disabled >
                        <label for='CorreoEstudiante'>Correo electrónico</label>
                    </div>
                
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>phone</i>
                        <input id='TelefonoEstudiante' type='text' class='validate infoEstu' disabled >
                        <label for='TelefonoEstudiante'>Número de contacto</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 right-align">
                        <a style="cursor: pointer;" class="tooltipped modal-trigger" data-position='top' data-tooltip='Actualizar información de contacto' href='#modalActualiza' id="BtnModalActualiza">
                            <div class='chip ToolsTic_Verde white-text' id="EditInfoEstu">
                                <span><b>Editar información</b></span>
                            </div>
                        </a>
                    </div>
                </div>

                <br>

                <?php 
                    //ARRAY FULL DATOS DE INSCRIPCION DE UN ESTUDIANTE
                    $InfoInscEstu = FullDataInscEstu($conex, $userlog['cod_estudiante']);
                ?>

                <!-- COLLAPSIBE CONSULTA SOBRE PRUEBAS Y RESULTADOS -->
                <div class='row'>
                    <ul class='collapsible popout'>
                        <li>          
                        <?php if($InfoInscEstu === NULL){ ?>
                            <div class='collapsible-header valign-wrapper'>
                                <i class='material-icons'>arrow_drop_down_circle</i>
                                ¿El estudiante esta inscrito en un grupo? <hr>
                                <span class='chip red white-text'><b>NO</b> </span>
                            </div>
            
                            <div class='collapsible-body center'>
                                <div class='center'>
                                        <a href='<?php echo ROOT_MEDIA_USER;?>/student/pruebas.php' class='ToolsticAzulC btn'>
                                            <i class='material-icons right'>send</i>
                                            Inscribirse a una prueba
                                        </a>
                                </div>
                            </div> 
            
                        <?php } else { ?>
                            <div class='collapsible-header valign-wrapper'>
                                <i class='material-icons'>arrow_drop_down_circle</i>
                                ¿El estudiante esta inscrito en un grupo? <hr>
                                <span class='chip ToolsTic_Verde white-text'><b>SI</b> </span>
                            </div>

                            <div class='collapsible-body'>
                                <div class='row'>
                                    <div class='input-field col s12 m6'>
                                        <i class='material-icons prefix'>language</i>
                                        <input id='PruebaEstu' type='text' class='validate infoEstu' disabled value='<?php echo utf8_decode($InfoInscEstu['prueba']);?>'>
                                        <label for='PruebaEstu'>Prueba</label>
                                    </div>
                
                                    <div class='input-field col s12 m6'>
                                        <i class='material-icons prefix'>timelapse</i>
                                        <input id='PeriodoPerueba' type='text' class='validate infoEstu' disabled value='<?php echo utf8_decode($InfoInscEstu['periodo'])." - ".utf8_decode($InfoInscEstu['year_periodo']);?>'>
                                        <label for='PeriodoPerueba'>Periodo</label>
                                    </div>
                
                                    <div class='input-field col s12 m6'>
                                        <i class='material-icons prefix'>location_on</i>
                                        <input id='SedePrueba' type='text' class='validate infoEstu' disabled value='<?php echo utf8_decode($InfoInscEstu['sede']);?>'>
                                        <label for='SedePrueba'>Sede</label>
                                    </div>                        
                            
                                    <div class='input-field col s12 m6'>
                                        <i class='material-icons prefix'>map</i>
                                        <input id='LugarSede' type='text' class='validate infoEstu' disabled value='<?php echo ($InfoInscEstu['lugar_sede']);?>'>
                                        <label for='LugarSede'>Lugar de presentación</label>
                                    </div>
                
                                    <div class='input-field col s12 m6'>
                                        <i class='material-icons prefix'>supervisor_account</i>
                                        <input id='GrupoEstu' type='text' class='validate infoEstu' disabled value='<?php echo ($InfoInscEstu['grupo']);?>'>
                                        <label for='GrupoEstu'>Grupo inscrito</label>
                                    </div>
                
                                    <div class='input-field col s12 m6'>
                                        <i class='material-icons prefix'>location_searching</i>
                                        <input id='AulaPrueba' type='text' class='validate infoEstu' disabled value='<?php echo "Aula - ".($InfoInscEstu['aula_grupo']);?>'>
                                        <label for='AulaPrueba'>Aula de presentación</label>
                                    </div>
                
                                    <div class='input-field col s12 m6'>
                                        <i class='material-icons prefix'>watch_later</i>
                                        <input id='HoraPrueba' type='text' class='validate infoEstu' disabled value='<?php echo ($InfoInscEstu['horario_grupo']);?>'>
                                        <label for='HoraPrueba'>Hora de presentación</label>
                                    </div>
                                    <?php
                                        $fechaAplicacion = strftime("%d de %b del %Y",strtotime($InfoInscEstu['fecha_aplicacion_prueba']));

                                        list($fechaIN, $horaIN) = explode(" ",$InfoInscEstu['fecha_inscripcion']);
                                                                
                                        $fechaInscripcion = strftime("%d de %b del %Y",strtotime($fechaIN));
                                        $horaInscripcion = strftime("%I:%M:%S %p",strtotime($horaIN));
                                    ?>
                                    <div class='input-field col s12 m6'>
                                        <i class='material-icons prefix'>date_range</i>
                                        <input id='FechaAplicacion' type='text' class='validate infoEstu' disabled value='<?php echo ( $fechaAplicacion);?>'>
                                        <label for='FechaAplicacion'>Fecha de aplicación de la prueba</label>
                                    </div>
                                    
                                    <div class='input-field col s12 m6'>
                                        <i class='material-icons prefix'>date_range</i>
                                        <input id='FechaInscripcion' type='text' class='validate infoEstu' disabled value='<?php echo ( $fechaInscripcion." a las ".$horaInscripcion);?>'>
                                        <label for='FechaInscripcion'>Fecha de inscripción del estudiante</label>
                                    </div>            
                                    
                                    <div class='input-field col s12 m12 center'>
                                        <a href='<?php echo ROOT_MEDIA_USER;?>/student/pruebas.php' class='ToolsticAzulC btn'>
                                            <i class='material-icons right'>poll</i>
                                            ver inscripción a prueba</a>
                                    </div>
                                </div> 
                            </div>

                        <?php }  ?>                        
                        </li>
                        <br>
                        <li>
                            <?php 
                                $ResultCuestEstu  = FullDataResulCuestEstu($conex, $userlog['cod_estudiante']);
                                $ReaizoPruebaEstu = EstudianteRealizoPrueba($conex, $userlog['cod_estudiante']);
                                
                                if($ReaizoPruebaEstu['realizo_prueba'] == 0 || $ResultCuestEstu == NULL) { ?>

                            <div class='collapsible-header valign-wrapper'>
                                <i class='material-icons'>arrow_drop_down_circle</i>
                                ¿El estudiante presentó la prueba de homologación? <hr>
                                <span class='chip red white-text'><b>NO</b> </span>
                            </div>
            
                            <div class='collapsible-body center'>
                                <div class='center'>
                                        <a href='<?php echo ROOT_MEDIA_USER;?>/student/homologacion.php' class='ToolsticAzulC btn'>
                                            <i class='material-icons right'>send</i>
                                            Presentar prueba de homologación
                                        </a>
                                </div>
                            </div> 

                            <?php } else { ?>
                            <div class='collapsible-header valign-wrapper'>
                                <i class='material-icons'>arrow_drop_down_circle</i>
                                ¿El estudiante presentó la prueba de homologación? <hr>                                
                                <span class='chip ToolsTic_Verde white-text'><b>SI</b> </span>
                            </div>

                            <div class='collapsible-body'>
                                <div class='row'>
            
                                    <div class='input-field col s12 m6'>
                                        <i class='material-icons prefix'>description</i>
                                        <input id='EstadoCuestionario' type='text' class='validate infoEstu' disabled value='<?php echo $ResultCuestEstu['estado_cuestionario'];?>'>
                                        <label for='EstadoCuestionario'>Estado cuestionario</label>
                                    </div>

                                    <?php
                                        list($fechaIniCues, $horaIniCues) = explode(" ",$ResultCuestEstu['inicio_cuestionario']);
                                                                
                                        $fechaInicioCues = strftime("%d de %b del %Y",strtotime($fechaIniCues));
                                        $horaInicioCues = strftime("%I:%M:%S %p",strtotime($horaIniCues));


                                        list($fechaFinCues, $horaFinCues) = explode(" ",$ResultCuestEstu['fin_cuestionario']);
                                                                
                                        $fechaFinCuestionario = strftime("%d de %b del %Y",strtotime($fechaFinCues));
                                        $horaFinCuestionario = strftime("%I:%M:%S %p",strtotime($horaFinCues));


                                    ?>
            
                                    <div class='input-field col s12 m6'>
                                        <i class='material-icons prefix'>date_range</i>
                                        <input id='InicioCuestionario' type='text' class='validate infoEstu' disabled value='<?php echo $fechaInicioCues." a las ".$horaInicioCues;?>'>
                                        <label for='InicioCuestionario'>Inicio del cuestionario</label>
                                    </div>                            
            
                                    <div class='input-field col s12 m6'>
                                        <i class='material-icons prefix'>date_range</i>
                                        <input id='FinCuestionario' type='text' class='validate infoEstu' disabled value='<?php echo $fechaFinCuestionario." a las ".$horaFinCuestionario;?>'>
                                        <label for='FinCuestionario'>Fin del cuestionario</label>
                                    </div>
            
                                    <div class='input-field col s12 m6'>
                                        <i class='material-icons prefix'>graphic_eq</i>
                                        <input id='PuntajeObtenido' type='text' class='validate infoEstu' disabled value='<?php echo $ResultCuestEstu['puntaje_final'] ." / 5";?>'>
                                        <label for='PuntajeObtenido'>Puntaje final obtenido</label>
                                    </div>
            
                                    <div class='input-field col s12 m12 center'>
                                        <a href='<?php echo ROOT_MEDIA_USER;?>/student/resultados.php' class='ToolsticAzulC btn'>
                                            <i class='material-icons right'>poll</i>
                                            ver resultados detallados</a>
                                    </div>
                        
                                </div>
                                <?php } ?>
                            </div>
                        </li>
                    </ul>
            
                </div>
                <!-- fin *** -->
            </div>

            


        <!-- Modal PARA ACTUALZIAR DATOS -->
        <div id="modalActualiza" class="modal modal-fixed-footer">
            <div class="modal-content center">
                <form class="col s12" id="FRActualizaDatos"> 
                    <h5>
                        <b>Actualización de datos</b>
                    </h5>

                    <div class="conatainer">
                        <input type="number" id="FAiduser" hidden value="<?php echo $userlog['cod_estudiante']; ?>">  
                      

                        <div class='row'>
                            <div class='col s12 center'>
                                <i class='material-icons large'>person_pin</i><br>
                                <span><b id="NomEstudianteModal"></b></span><br>
                                <span><b id="codEstudianteModal"></b></span>
                            </div>
                        </div> <br>
                        
                        <div class='row'>
                            <div class='progress'>
                                <div class='indeterminate'></div>
                            </div>
                        </div> <br>
                        
                        <div class="row">
                            <div class='input-field col s12 m6'>
                                <i class='material-icons prefix'>account_circle</i>
                                <input id="FAnombre" min="2" type="text" required name="FAnombre" class="validate active" pattern="[a-zA-Z ÑÁÉÍÓÚñáéíóú]{2,60}"  autocomplete="off" onkeypress="EvitarEspacios(this.id)" >
                                <label for='FAnombre'>Nombres del usuario</label>
                            </div>

                            <div class="input-field col s12 m6">
                                <i class='material-icons prefix'>account_circle</i>
                                <input id="FAapellido" type="text" min="2" required name="FAapellido" class="validate" pattern="[a-zA-Z ÑÁÉÍÓÚñáéíóú]{2,60}" onkeypress="EvitarEspacios(this.id)" >
                                <label for="FAapellido">Apellidos del usuario</label>
                            </div>
                        </div>
                            
                        <div class="row">
                            <div class='input-field col s12 m6'>
                                <i class='material-icons prefix'>email</i>
                                <input id='FAcorreo' type='email' required name="FAcorreo" class="validate">
                                <label for='FAcorreo'>Correo electrónico</label>
                            </div>

                            <div class='input-field col s12 m6'>
                                <i class='material-icons prefix'>phone</i>
                                <input id="FAtelefono" onkeypress="return justNumbers(event);" pattern="[0-9]{1,15}" type="text" name="FAtelefono" class="validate" >
                                <label for='FAtelefono'>Número de contacto</label>
                            </div>
                        </div> <br>
                        
                        <div class="row">
                            <div class="row">
                                <div class='chip ToolsTic_Verde white-text'>
                                    <span><b>Para confirmar los cambios digite su contraseña actual</b></span>
                                </div>
                            </div>
                            <div class="input-field col s12 m6 push-m3">
                                <i class='material-icons prefix'>dialpad</i>
                                <input id="FApassword" pattern="[A-Za-z0-9_-]{1,15}" type="password" name="FApassword" required class="validate" autocomplete="off" onkeypress="EvitarEspacios(this.id)">
                                <label for="FApassword">Contraseña Actual</label>
                            </div>
                        </div> <br>
                        
                        <div class="row">
                            <div class="col s12 left-align">
                                <div class='chip ToolsticAzulC white-text'>
                                    <span><b>Complete solo si desea cambiar su contraseña</b></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12 m6">
                                <i class='material-icons prefix'>dialpad</i>
                                <input id="FAnewpassword1" pattern="[A-Za-z0-9_-]{1,15}" type="password" name="FAnewpassword1" class="validate" min="1" autocomplete="off" onkeypress="EvitarEspacios(this.id)">
                                <label for="FAnewpassword1">Nueva Contraseña</label>
                            </div>                   


                            <div class="input-field col s12 m6">
                                <i class='material-icons prefix'>dialpad</i>
                                <input id="FAnewpassword2" pattern="[A-Za-z0-9_-]{1,15}" type="password" name="FAnewpassword2" min="1" class="validate" autocomplete="off" >
                                <label for="FAnewpassword2">Repita Contraseña</label>
                            </div>
                        </div>                        
                    </div>
            </div>
            <div class="modal-footer">
                <a class="modal-close btn red white-text left">Cerrar</a>
                    
                <button class="btn ToolsTic_Verde white-text" type="submit"  id="BTNActualizaDatos">
                    Actualizar Datos
                    <i class="material-icons right">send</i>
                </button>
            </div>
                </form>
        </div>
    </main>
    <br> <br>
   

        <!--INCLUSION DE FOOTER POR PHP  -->  
        <?PHP include ROOT_INCLUDE.'/footer.php'; ?>   

        <!--INCLUSION DE SCRIPTS JS POR PHP  -->
        <?PHP include ROOT_INCLUDE.'/scripts.php'; ?>

        <!-- INCLUSION DE FUNCIONS JS -->
        <script src="<?php echo ROOT_PUBLIC;?>/js/index.js"></script>   
    
        <!-- INCLUSION DE FUNCIONS USURIO ESTUDIANTE JS -->        
        <script src="<?php echo ROOT_MAIN_CON;?>/controllers/student.js"></script>   
       

        <script>
            $(document).ready(function(){
                M.AutoInit();
                    Toast.fire({
                    type: 'success',
                    title: 'Usuario Conectado'
                })
                
                mostrarDatosMenu(<?php echo $userlog['cod_estudiante']; ?>)       
                mostrarDatos(<?php echo $userlog['cod_estudiante']; ?>);       
                agregaDatosEdicion(<?php echo $userlog['cod_estudiante'];?>);  
                  
            });   
        </script>      
    </body>
</html>