<?php     
    include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
    include_once (ROOT_INCLUDE."/connect.php");  
    include_once (ROOT_INCLUDE.'/fetch_array.php'); 
    include_once (ROOT_MAIN.'/views/sesion_student.php');     
    if( $_SESSION['error_user'] === FALSE ) { header("Location: '.ROOT_MEDIA_USER.'/student/");  }
    
?>

<!DOCTYPE html>
<html lang="es">
    <head>        
        <title>Inicia sesión | ToolsTic</title>  
        <?php include (ROOT_INCLUDE."/headers.php"); ?>
        <link rel="stylesheet" href="<?php echo ROOT_PUBLIC;?>/css/index.css">
    </head>

    
    <body style="body{overflow-x: hidden;}" class="ToolsticBlanco" >
    <!-- ****** INICIO DE NAV DE LOGO ****** -->  

    <nav>
        <div class="nav-wrapper ToolsTic_Verde">
            <a href="../" class="brand-logo center">
                <img src="<?php echo ROOT_PUBLIC;?>/img/logotipo.png" width="230px">
            </a>            
        </div>
    </nav> 
    
    <br>
    <!-- ****** INICIO DE NAV DE LOGO ****** -->   
    <main> 
         <!-- Page Layout here -->
    <div class="row center-align">

        <div class="col s8 push-s2 m6 push-m3 l5 push-l1 center-align cc_cursor hide-on-med-and-down">  
            <br>
            <img src="<?php echo ROOT_PUBLIC;?>/img/login.svg" width="90%"> 
        </div>
        
        <div class="col s12 m12 l5 push-l1 cc_cursor">  
            <div class="black-text center-align cc_cursor">
                    <img src="<?php echo ROOT_PUBLIC;?>/img/logoTic2.png" width="60%"> 
                    <div class="row center-align">
                        <form id="formlg" class="col s10 push-s1 center-align cc_cursor">

                            <input type="text" name="since" hidden="true" value="">

                            <div class="row">                            
                                <div class="input-field col s12 m8 offset-m2">
                                    <i class="material-icons prefix tiny">account_circle</i>
                                    <input id="usuario_valida"  autocomplete="off" onkeypress="return justNumbers(event);" pattern="[0-9]{1,12}" required type="text" class="validate tooltipped invalid" min="0" name="usuario_estudiante" data-position="bottom" data-tooltip="Tu código estudiantil">
                                    <span class="right helper-text" data-error="Solo números" data-success="Muy bien!">Número de documento</span>
                                    <label for="usuario_valida" class="">Usuario</label>
                                </div>
                                
                                <div class="input-field col s10 m7 push-m2">
                                    <i class="material-icons prefix tiny">https</i>
                                    <input id="pw_valida"  autocomplete="off" required pattern="[A-Za-z0-9_-]{1,15}" type="password" class="validate tooltipped" autocomplete="on" name="pw_valida" data-position="bottom" data-tooltip="Tu Contraseña">
                                    <span class="left helper-text" data-error="error" data-success="Muy bien!">Contraseña registrada</span>
                                    <label for="pw_valida">Contraseña</label>
                                    
                                </div>

                                <div class="input-field col s2 m1 push-m2">
                                    <a onclick="mostrarContrasena()" id="MostratPW" class="btn ToolsTic_Azul "> <i class="material-icons">remove_red_eye</i></a> 
                                </div>                     
                                                            
                                <div class="input-field col s9 push-s2">                                    
                                    <button id="btnInicia" class="btn ToolsTic_Verde btnCard col s12 botonlg" type="submit" name="action">
                                        <b>INICIAR SESIÓN</b> 
                                    </button>                                   
                                </div>  
                                                          
                            </div>
                            <br>

                            <div class="row">
                                <div class="col s10 push-s1">
                                    <a onclick="PwLost()" id="aPwLost" style="cursor: pointer;" class=" right red-text"><b>Olvide mi contraseña</b></a>
                                </div>                                
                            </div>
                            <div class="row">
                            <div class="col s10 push-s1">
                                <a href="./register.php" class="right blue-text modal-trigger"><b>Registrarme</b></a>
                            </div>
                                
                            </div>
                        </form>
                        
                    </div>
                </div>                    
            </div>
        </div>

    

    <br> <br> <br></main>
    
   
    <!--INCLUSION DE FOOTER POR PHP  -->  
    <?PHP include ROOT_INCLUDE.'/footer.php'; ?>    
    <!--INCLUSION DE SCRIPTS JS POR PHP  -->
    <?PHP include ROOT_INCLUDE.'/scripts.php'; ?>
    <!-- INCLUSION DE FUNCIONS JS -->
    <script src="<?php echo ROOT_PUBLIC;?>/js/index.js"></script>   

    
    <script src="<?php echo ROOT_MAIN_CON;?>/controllers/log-student.js"></script>
    <script src="<?php echo ROOT_MAIN_CON;?>/controllers/PwLost.js"></script>
    
    </body>
</html>
