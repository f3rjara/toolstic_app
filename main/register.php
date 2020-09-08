<?php     
    include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
    include (ROOT_INCLUDE."/connect.php");  
    include_once (ROOT_INCLUDE.'/fetch_array.php'); 
?>



<!DOCTYPE html>
<html>

<head>        
        <title>Registro| ToolsTic</title>  
        <?php include (ROOT_INCLUDE."/headers.php"); ?>
        <link rel="stylesheet" href="<?php echo ROOT_PUBLIC;?>/css/index.css">
    </head>

<body>

    <!-- ****** INICIO DE NAV DE LOGO ****** -->  
        <nav>
            <div class="nav-wrapper ToolsTic_Verde">
                <a href="../" class="brand-logo left" style="position: relative !important;">
                    <img src="<?php echo ROOT_PUBLIC;?>/img/logotipo.png" width="230px">
                </a>  
                <ul id="nav-mobile" class="right">
                    <li> 
                        <a class="btn waves-effect white black-text" href="<?php echo ROOT_MEDIA; ?>/main">
                            <b>INICIAR SESIÓN</b>
                        </a>
                    </li>            
                </ul>
            </div>      
        </nav>     
    <!-- ****** INICIO DE NAV DE LOGO ****** -->  

    <form id="FormNewStudent">
        <div class="carousel carousel-slider center">           
                <div class="carousel-item white black-text" href="#one!">
                    <br>
                    <div class='row'>
                        <div class='col s12 center'>
                            <i class='material-icons large'>beenhere</i>
                            <h2 style="margin-top: 0">Datos de acceso</h2>
                            <div class='progress'>
                                <div class='indeterminate'></div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row container">
                        <div class="row">
                            <div class="input-field col s12 m6 push-m3">
                                <i class='material-icons prefix'>subtitles</i>
                                <input pattern="[0-9]{1,12}" require min="0" onkeypress="return justNumbers(event);" placeholder="Este será su nombre de usuario" autocomplete="off"  id="FNE_cod_estudiante" type="text" class="validate tooltipped" onkeyup="HabilitarBtn1()"  data-position="bottom" data-tooltip="Código Estudiantil" name="FNE_cod_estudiante">
                                <span class="right helper-text" data-error="Solo números" data-success="Muy bien!">Número de documento</span>
                                <label for="FNE_cod_estudiante">Código Estudiantil</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s10 m5 push-m3 ">
                                <i class='material-icons prefix'>dialpad</i>
                                <input autocomplete="off" require id="FNE_password" type="password" class="validate tooltipped" data-position="bottom" onkeyup="HabilitarBtn1()" autocomplete="false" data-tooltip="Contraseña" name="FNE_password">
                                <span class="left helper-text" data-error="error" data-success="Muy bien!">Digite su contraseña</span>
                                <label for="FNE_password">Contraseña</label>
                            </div>
                            <div class="input-field col s2 m1 push-m3">
                                <i id="showP1" onclick="mostrarContrasena('showP1', 'FNE_password')" class='material-icons prefix'>visibility</i>                        
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s10 m5 push-m3">
                                <i class='material-icons prefix'>dialpad</i>
                                <input  autocomplete="off" require id="FNE_conpassword" type="password" class="validate tooltipped" data-position="bottom" onkeyup="HabilitarBtn1()"  autocomplete="false" data-tooltip="Repita la contraseña" name="FNE_conpassword">
                                <span class="left helper-text" data-error="error" data-success="Muy bien!">Digite nuevamente su contraseña</span>
                                <label for="FNE_conpassword">Repita Contraseña</label>
                            </div>
                            <div class="input-field col s2 m1 push-m3 align-left">
                                <i id="showP2" onclick="mostrarContrasena('showP2', 'FNE_conpassword')" class='material-icons prefix'>visibility</i>
                            </div>
                        </div> 
                        <br>
                        <div class="row">
                            <a id="next-button_1" class="waves-effect waves-light btn ToolsTic_Azul white-text">
                                <i class="material-icons left">navigate_next</i>
                                SIGUIENTE PASO
                            </a> 
                        </div>   
                    </div>
                </div>

                <div class="carousel-item white black-text" href="#two!">
                    <br>
                    <div class="row">
                        <div class='col s12 center'>
                            <i class='material-icons large'>person_pin</i>
                            <h2 style="margin-top: 0">Datos personales</h2>
                            <div class='progress'>
                                <div class='indeterminate'></div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row container">

                        <div class="row">                    
                            <div class="input-field col s12 m6 push-m3">                        
                                <select id="FNE_tipo_doc" name="FNE_tipo_doc"  class="validate tooltipped" data-position="bottom"  data-tooltip="Tipo de documento">
                                    <option value="" disabled selected>Seleccione un tipo de documento</option>
                                    <option value="CC">CC</option>
                                    <option value="TI">TI</option>
                                    <option value="OTRO">OTRO</option>
                                    </select>
                                <label>Tipo de documento</label>
                            </div>   
                        </div>

                        <div class="row">
                            <div class="input-field col s12 m6 push-m3">
                                <i class='material-icons prefix'>subtitles</i>
                                <input pattern="[0-9]{1,16}" require min="0" onkeypress="return justNumbers(event);" id="FNE_num_identificacion" type="text" class="validate tooltipped" onkeyup="HabilitarBtn2()" autocomplete="off" data-position="bottom" data-tooltip="Num. Documento de identificación" name="FNE_num_identificacion">
                                <span class="left helper-text" data-error="Solo números" data-success="Muy bien!">Número de documento</span>
                                <label for="FNE_num_identificacion">Documento de identidad</label>
                            </div>

                        </div>

                        <div class="row">
                            <div class="input-field col s12 m6 push-m3">
                                <i class='material-icons prefix'>person</i>
                                <input require id="FNE_name" type="text" class="validate tooltipped" onkeyup="HabilitarBtn2()" autocomplete="off" pattern="[a-zA-Z ÑÁÉÍÓÚñáéíóú]{2,60}"  data-position="bottom" data-tooltip="Nombres del usuario" name="FNE_name">
                                <span class="left helper-text" data-error="Solo letras" data-success="Muy bien!">Su nombre completo</span>
                                <label for="FNE_name">Sus nombres completos</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12 m6 push-m3 ">
                                <i class='material-icons prefix'>person</i>
                                <input onkeyup="HabilitarBtn2()" require pattern="[a-zA-Z ÑÁÉÍÓÚñáéíóú]{2,60}"   id="FNE_apellido"  autocomplete="off" type="text" class="validate tooltipped" data-position="bottom" data-tooltip="Apellidos del usuario" name="FNE_apellido">
                                <span class="left helper-text" data-error="Solo letras" data-success="Muy bien!">Sus apellidos completo</span>
                                <label for="FNE_apellido">Apellidos completos</label>
                            </div>
                        </div>

                        <div class="row">
                            <a id="next-button_2" disabled class="waves-effect waves-light btn ToolsTic_Azul white-text">
                                <i class="material-icons left">navigate_next</i>
                                SIGUIENTE PASO
                            </a> 
                        </div>
                    </div>
                </div>


                <div class="carousel-item white black-text" href="#three!">
                    <br>
                    <div class='row'>
                        <div class='col s12 center'>
                            <i class='material-icons large'>school</i>
                            <h2 style="margin-top: 0">Datos académicos</h2>
                            <div class='progress'>
                                <div class='indeterminate'></div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row container">

                        <!-- INPUT DE SELECIONAR SEMESTRE -->
                        <div class="row">
                            <div class="input-field col s12 m6 push-m3">
                                <label for="FNE_semestre">Semestre Actual</label>
                                <br>
                                <div class="col s10 m10">
                                    <p class="range-field">
                                        <input type="range" onclick="HabilitarBtn3()" required id="FNE_semestre" name="FNE_semestre" value="1" min="1" max="10" />
                                    </p> 
                                </div>
                                <div class="col s2 m2">
                                    <a class="btn ToolsTic_Azul" id="NumSemestre"></a>
                                </div>                          
                                
                            </div>
                        </div>


                        <!--INPUT DE PROGRAMAS ACADEMICOS POR SEDE -->
                        <div class="row">
                            <div class="input-field col s12 m6 push-m3">                 
                                <select onchange="HabilitarBtn3()" id="FNE_programa" name="FNE_programa"  class="validate tooltipped" data-position="bottom"  data-tooltip="programa Academico" >
                                <option value="0" disabled selected>Escoja su programa académico</option>

                                <optgroup label="PASTO">
                                    <?php
                                        $progrmas = ProgramasXsede($conex, 1);
                
                                        for($i = 0; $i < count($progrmas); $i++){
                                            echo  "<option value='".$progrmas[$i]['id_programa']."'>".$progrmas[$i]['programa']."</option>";
                                        }
                                    ?>
                                </optgroup>
                
                                <optgroup label="IPIALES">
                                    <?php
                                        $progrmasI = ProgramasXsede($conex, 2);
                
                                        for($i = 0; $i < count($progrmasI); $i++){
                                            echo  "<option value='".$progrmasI[$i]['id_programa']."'>".$progrmasI[$i]['programa']."</option>";
                                        }
                                    ?>
                                </optgroup>
                
                                <optgroup label="TUMACO">
                                    <?php
                                        $progrmasT = ProgramasXsede($conex, 3);
                
                                        for($i = 0; $i < count($progrmasT); $i++){
                                            echo  "<option value='".$progrmasT[$i]['id_programa']."'>".$progrmasT[$i]['programa']."</option>";
                                        }
                                    ?>
                                </optgroup>        
                
                                <optgroup label="TUQUERRES">
                                    <?php
                                        $progrmasTu = ProgramasXsede($conex, 4);
                
                                        for($i = 0; $i < count($progrmasTu); $i++){
                                            echo  "<option value='".$progrmasTu[$i]['id_programa']."'>".$progrmasTu[$i]['programa']."</option>";
                                        }
                                    ?>
                                </optgroup>
                
                                </select>
                                <label>Seleccione un programa de acuerdo a la sede</label>
                            </div>
                        </div>

                        
                        <br>
                        <!-- BOTON SIGUIENTE N3 STEP -->
                        <div class="row">
                            <a id="next-button_3" disabled class="waves-effect waves-light btn ToolsTic_Azul white-text">
                                <i class="material-icons left">navigate_next</i>
                                SIGUIENTE PASO
                            </a> 
                        </div>
                    </div>
                </div>

                <div class="carousel-item white black-text" href="#four!">
                    <br>
                    <div class='row'>
                        <div class='col s12 center'>
                            <i class='material-icons large'>contact_mail</i>
                            <h2 style="margin-top: 0">Datos de contacto</h2>
                            <div class='progress'>
                                <div class='indeterminate'></div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row container">
                        <div class="row">
                            <div class="input-field col s12 m6 push-m3 ">
                                <i class='material-icons prefix'>email</i>
                                <input onkeyup="HabilitarBtn4()" require autocomplete="off"  id="FNE_correo" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" type="email" class="validate tooltipped" data-position="bottom" data-tooltip="Correo Electronico" name="FNE_correo">
                                <label for="FNE_correo">Correo Electronico</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m6 push-m3">
                                <i class='material-icons prefix'>contact_phone</i>
                                <input onkeyup="HabilitarBtn4()" autocomplete="off"  pattern="[0-9]{10,10}" require min="0" onkeypress="return justNumbers(event);"  id="FNE_telefono_estudiante" type="text" class="validate tooltipped" data-position="bottom" data-tooltip="Número de teléfono" name="FNE_telefono_estudiante">
                                <label for="FNE_telefono_estudiante">Número de teléfono</label>
                            </div>
                        </div>
                        <br>
                        <!-- BOTON SIGUIENTE N3 STEP -->
                        <div class="row">
                            <button id="next-button_4" class="btn ToolsTic_Verde white-text" type="submit" name="action">
                                    <b>CREAR UNA CUENTA</b> 
                            </button> 
                        </div>

                    </div>

                    
                </div>               
            </div>  
        </form>
    </div>


    

    <br>

    <!--INCLUSION DE FOOTER POR PHP  -->  
    
    <?PHP include ROOT_INCLUDE.'/footer.php'; ?>    
    <!--INCLUSION DE SCRIPTS JS POR PHP  -->
    <?PHP include ROOT_INCLUDE.'/scripts.php'; ?>
    <!-- INCLUSION DE FUNCIONS JS -->
    <script src="<?php echo ROOT_PUBLIC;?>/js/index.js"></script>
    
    
    <script src="<?php echo ROOT_MAIN_CON;?>/controllers/new-student.js"></script>

    <script>

    $( document ).ready(function() {
        $('.carousel.carousel-slider').carousel({        
            noWrap: true,
            fullWidth: true
        });
    });
    
    $('select').formSelect();
    M.updateTextFields();
    
    </script>


</body>

</html>