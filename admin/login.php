<?php
    session_start();
    
    //VALIDAD HACIA DONDE SE VA A REDIRIGIR
    if(isset($_GET['since']) && ($_GET['since'] == "pruebas" || $_GET['since'] == "preguntas")){        
        $since = $_GET['since'];  
    }
    else{
        header("Location: ./index.php");
    }

    //REDIRIGIENDO SEGUN SELECCION Y SESSION
    if(isset($_SESSION['user_docente'])){   

        $id_tipo_tuser =  $_SESSION['user_docente']["id_tipo_usuario"];
       
        if($since == "pruebas")
        {               
            header('Location: ./tt-admin/perfil.php');
           
        }
        else if($since == "preguntas"){            
            header('Location: ./valida-prg/perfil.php');
        }
        
    }
   

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Inicia sesión | ToolsTic</title>  
        <link rel="icon" type="image/png" href="../img/favUdenar.png">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"> 
        
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/materialize.css">
        <link rel="stylesheet" href="../css/login.css">
        <link rel="stylesheet" href="../css/sweetalert2.css">

    </head>
    <style> body{overflow-x: hidden;} </style>
    <body class="ToolsticBlanco" >
    <!-- ****** INICIO DE NAV DE LOGO ****** -->   
    <nav>
        <div class="nav-wrapper ToolsTic_Verde">
            <a href="/toolsticapp" class="brand-logo center"><img src="../img/logotipo.png" width="230px"></a>           
        </div>
    </nav> 
    <!-- ****** INICIO DE NAV DE LOGO ****** -->   
    <main> 
        <br>
         <!-- Page Layout here -->
        <div class="row center-align">
        <div class="col s8 push-s2 m6 push-m3 l5 push-l1 center-align cc_cursor"> 
            <img src="../img/login2.svg" width="95%"> 
        </div>

            <div class="col s12 m12 l5 push-l1 cc_cursor">  
                <div class="black-text center-align">
                    
                    <img src="../img/logoTic2.png" width="65%"> 
                    <div class="row">
                        <form id="formlg" class="col s12 center-align">
                            <input type="text" name="since" hidden= "true" value="<?php echo $since;?>">
                            <div class="row">                            
                                <div class="input-field col s12 m8 offset-m2">
                                    <i class="material-icons prefix tiny">account_circle</i>
                                    <input id="usuario_valida" onkeypress="return justNumbers(event);" pattern="[0-9]{1,12}" required type="text" class="validate tooltipped" min="0" name="usuario_valida" data-position="bottom" data-tooltip="Tu numero de documento">
                                    <label for="usuario_valida">Usuario</label>
                                </div>
                                
                                <div class="input-field col s10 m7 push-m2">
                                    <i class="material-icons prefix tiny">https</i>
                                    <input id="pw_valida" required pattern="[A-Za-z0-9_-]{1,15}" type="password" class="validate tooltipped" autocomplete="on" name="pw_valida" data-position="bottom" data-tooltip="Tu Contraseña">
                                    <label for="pw_valida">Contraseña</label>
                                    
                                </div>
                                <div class="input-field col s2 m1 push-m2">
                                    <a onclick="mostrarContrasena()" id="MostratPW" class="btn ToolsticAzul"> <i class="material-icons">remove_red_eye</i></a> 
                                </div>
                                
                                <div class="input-field col s12">
                                    <b> 
                                    <label>
                                        <input name="terminos" id="terminoschk" type="checkbox" required />
                                        <span> <a href="#modalTerminos" class="btn modal-trigger ToolsticAzul" style="font-size: 10px">Leer y aceptar Terminos y Condicones</a> </span>
                                    </label>                                    
                                    </b>
                                </div>  
                                                            
                                <div class="input-field col s12">                                    
                                    <button id="btnInicia" class="btn ToolsTic_Verde btnCard darken-2 s12 botonlg" type="submit" name="action">Iniciar Sesión 
                                    </button>                                   
                                </div>  
                                                          
                            </div>
                        </form>
                        <div class="row">
                            <div class="col s10 push-s1 m6 push-m4">
                            <a onclick="PwLostAdmin()" style="cursor: pointer;" id="aPwLost" class="right blue-text darken-3"><b>Olvide mi contraseña</b></a>
                            </div>
                                
                            </div>
                       
                    </div>
                </div>                    
            </div>
        </div>
        <br> <br><br>
        <!-- Modal TERMINOS Y CONDICIONES -->
        <div id="modalTerminos" class="modal modal-fixed-footer">
            <div class="modal-content center" id="modalTerminos-content">
                <h4>Terminos y condiones de Uso del Sitio Web ToolsTIC</h4>
                <br>
                <h5>CONDICIONES GENERALES DEL USO DEL SITIO WEB</h5> 

                <p style="text-align:justify">Apreciado Usuario: el sitio web de - TOOLSTIC, HERRAMIENTAS INFORMATICAS - << toolstic.udenar.edu.co >> (en adelante el Sitio Web) tiene como función principal la correspondiente validación por parte de expertos temáticos de cada una de las preguntas expuestas en el banco de preguntas del - MÓDULO DE LENGUAJE Y HERRAMIENTAS INFORMÁTICAS- (en adelante ToolsTIC).</p>

                <p style="text-align:justify">Por medio del Sitio Web, ToolsTic publica y asigna a cada experto temático una cierta cantidad de preguntas enmarcadas en el currículo de competencias digitales que dispone ToolsTIC, estas preguntas deberán dar razón a las evidencias y tareas que las contienen. Adicionalmente, el experto temático tendrá acceso al Sitio Web y especificamente al menú <<validación de preguntas>> el cual tiene como finalidad comprobar la calidad de preguntas, verificando si estas evalúan lo que se pretende medir (tareas, evidencias) dando como resultado su respectiva validez de contenido.</p>
                <br>
                <h5>1.         Derechos de Propiedad. </h5>
                <p style="text-align:justify">Holguer Andrade, Daniel Cabrera y Fernando Jaramillo estudiantes del programa de Licenciatura en Informática de la Universidad de Nariño; diseñan y desarrollan la presente plataforma como trabajo de grado para optar por el título de Licenciados en Informática de la Universidad de Nariño, son los autores principales de todo el contenido (incluyendo, por ejemplo, audio, fotografías, ilustraciones, gráficos, otros medios visuales, videos, copias, textos, software, títulos, archivos, preguntas, servicios , etc.), códigos, datos y materiales del mismo, el aspecto y el ambiente, el diseño y la organización del Sitio Web y la compilación de los contenidos, códigos, datos y los materiales en el Sitio Web. Su uso del Sitio Web no le otorga propiedad de ninguno de los contenidos, códigos, datos o materiales a los que pueda acceder en o a través del Sitio Web.
                </p>
                <br>
                <h5>2.         Licencia Limitada. </h5>
                <p style="text-align:justify">Como docente experto temático, usted puede acceder y visualizar el contenido del Sitio Web desde su computadora o desde cualquier otro dispositivo con conexión a internet y, a menos de que se indique de otra manera en estos Términos y Condiciones o en el Sitio Web, podrá sacar copias o impresiones individuales del contenido del Sitio Web para su uso personal, no comercial e intransferible.</p>
                <br>
                <h5>3.         Uso Prohibido.</h5>
                <p style="text-align:justify">Cualquier distribución, publicación o explotación comercial o promocional del Sitio Web, o de cualquiera de los contenidos, códigos, datos o materiales en el Sitio Web, está estrictamente prohibida, a menos de que usted haya recibido el previo permiso expreso por escrito del personal autorizado del Sitio Web o de algún otro poseedor de derechos aplicable. A no ser como está expresamente permitido en los presentes terminos, usted no puede descargar, informar, exponer, publicar, copiar, reproducir, distribuir, transmitir, modificar, ejecutar, difundir, transferir, crear trabajos derivados de, vender o de cualquier otra manera explotar cualquiera de los contenidos, códigos, datos o materiales en o disponibles a través del Sitio Web. </p>
                <br>
                <h5>4. 	Aceptación de términos</h5>            
                <p style="text-align:justify">El usuario cuando accede al sitio web lo hace bajo su total responsabilidad y que, por tanto, acepta plenamente la utilización correcta del mismo en conformidad con las leyes, la buena fe y las presentes condiciones generales de uso; asumiendo frente al sitio web y a terceros, de los daños y perjuicios que pudieran causarse como consecuencia del incumplimiento de dicha obligación.</p>
                <br><br><hr>
                <p style="text-align:justify">El Sitio Web se reserva el derecho de actualizar y modificar en cualquier momento las presentes condiciones generales de uso, así como cualquier otra instrucción o aviso que resulte de la aplicación. Dichas modificaciones serán publicadas en la página web y el usuario asumirá la responsabilidad de revisar las condiciones generales de uso que sean aplicables cada vez que ingrese a la página.</p>
                
            </div>
                
            <div class="modal-footer">
                <a href="#!" class="modal-close btn ToolsticRojo" onclick="aceptarTerminos()">Cerrar</a>
            </div>
        </div>

    <br> </main>
    
    <!-- ****** INICIO DE PIE DE PAGINA ****** -->
    <!--Footer-->
<footer class="bg_blue page-footer footer-c" style="position:relative;">
                    
                    <div class="trifooter">
                         
                     </div>
        <div class="container">
            <div class="row">
              <div class="col s12 m8 l8 left-align">
                <h5 class="white-text">Contacto sede Pasto</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!"><i
                        class="material-icons tiny">house</i> Calle #18 Carrera 50 Ciudadela Universitaria Torobajo.</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!"><i
                        class="material-icons tiny">location_on</i> Pasto - Nariño, Colombia.</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!"><i
                        class="material-icons tiny">phone</i> 7000000</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!"><i
                        class="material-icons tiny">mail</i> toolstic@udenar.edu.co</a></li>
                </ul>
              </div>
                <div class="col s12 offset-l2 m4 l2 responsive-img right">
                    <img src="./../img/udenar_f1.png" alt="Escudo Udenar" width="150">
                </div>
                
            </div>
        </div>
        <div class="footer-copyright darken-3">
            <div class="container">
                © 2020 Licencia Creative Commons. | <a class="modal-trigger white-text" href="#modalAviso">Aviso legal.</a>
                <a class="grey-text text-lighten-4 right" href="#!">Desarrollado Por: <strong>Proyecto @ToolsTic.</strong></a>
            </div>
        </div>
    </footer>
    <!-- ****** FIN DE PIE DE PAGINA ****** -->   
        
    <script src="../js/jquery-341.js"></script>
    <script src="../js/materialize.js"></script>
    <script src="../js/sweetalert2.all.js"></script>    
    <script src="../js/login.js"></script>
    <script src="../js/PwLostAdmin.js"></script>
    


    <script>
        $(document).ready(function(){                     
            M.AutoInit();
        });        
    </script>


    </body>
</html>
