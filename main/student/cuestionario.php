<?php
    header('Content-Type: text/html; charset=utf-8');
    include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
    include (ROOT_INCLUDE."/connect.php");  
    include_once (ROOT_INCLUDE.'/fetch_array.php'); 
    include_once (ROOT_MAIN.'/views/sesion_student.php'); 
    // SI EL USUARIO NO ESTA LOGUEADO Y QUIERE ACCEDER
    if( !isset($_SESSION['error_user']) || ($_SESSION['error_user'] != FALSE && $_SESSION['user_student'] === NULL))   
    { header('Location: '.ROOT_MEDIA_USER.'/');  }   
    // COMPROBACION DEL ESTUDIANTE SI INTERACTUA CON LOS BOTONES 
    if( isset($_SESSION['btnPresentaPrueba'] ) && $_SESSION['btnPresentaPrueba'] == TRUE ) {        
        if(isset($_SESSION['UserInteraction']) && $_SESSION['UserInteraction'] === TRUE) { 
            $StudneReload = DatosEstudiantesReload($conex,$userlog['cod_estudiante']);
            $VieneBoton = True;     
            $ReiniciarTempo = False;   
        ?>

<html lang="es">

    <head>        
        <title>Estudiante | ToolsTic</title>  
        <?php include (ROOT_INCLUDE."/headers.php"); ?>
        <link rel="stylesheet" href="<?php echo ROOT_PUBLIC;?>/css/index.css">   
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    
    
    <body>
    <div class="navbar-fixed">
        <nav class="ToolsTic_Verde z-depth-2">
            <div class="nav-wrapper">
                <a class="brand-logo center"><img src="<?php echo ROOT_PUBLIC;?>/img/logotipo.png" width="230px"></a> 
               
                <ul id="nav-mobile show-on-medium-and-down" class="right">
                    <li>
                        <a class="white black-text btn-large" id="btn_TempPrueba">
                            <i class="material-icons left">timer</i>
                            <span class="bold flow-text" id="TempPrueba">--:--:--</span> &nbsp; <span>Tiempo restante</span>
                        </a>
                    </li>                
                </ul>  
            </div>
        </nav> 
    </div>

    <main style="min-height: 70vh;" >  <br><br>
        <div class="row">
            <?php
                // CHECK STRIC NEW OR OLD CUEST.
                include_once (ROOT_MAIN.'/views/check_cuest.php');
                //INCLUDE INSTRUCCIONES Y TIEMPO
                include_once (ROOT_MAIN.'/views/instruction_cuest.php');
                //INCLUDE TABS 1 A 50 Y FIN
                include_once (ROOT_MAIN.'/views/tabs_cuest.php');
            ?>
        </div>

        <div class="row">
        <br> <br>
            <div class="col s12 m12">
                <?php 
                    for( $prgs = 1; $prgs <= 51; $prgs++ ) {
                        if($prgs != 51) { ?>
                            <div id="prg<?php echo $prgs;?>" class="row">
                                <div class="col s12 m10 push-m1">
                                    <?php 
                                        // SE PRESENTA No DE PREGUNTA Y EL ESTADO DE LA RESPUESTA
                                        include (ROOT_MAIN.'/views/quest_answer_status.php');
                                    ?>
                                    <div class="white-text small">
                                        <?php 
                                            // SE PRESENTA COMPETENCIA A EVALUAR EN LA PREGUNTA
                                            include (ROOT_MAIN.'/views/quest_competencia.php');

                                            // SE PRESENTA EL ENUNCIADO PREGUNTA
                                            include (ROOT_MAIN.'/views/quest_enunciado.php');
                                        ?>
                                        <div class="card-panel ToolsTicBlanco black-text">
                                            <span class="card-title"><b>Seleccione la opción correcta</b></span> <br>
                                            <?php 
                                                // INPUT GROUPS DE RADIO BUTTONS DE CADA RESPUESTA
                                                include (ROOT_MAIN.'/views/quest_radios_answer.php');

                                                // CARDS ANWER FRONT
                                                include (ROOT_MAIN.'/views/quest_cards_answer.php');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } // FIN IF
                        else { 
                            // BODY TAB END ALL QUEST .
                            include_once (ROOT_MAIN.'/views/body-tabs-all-quest.php');
                        } // FIN ELSE
                    } // FIN FOR
                ?>
            </div>
        </div>
    <br><br> </main>

    <!--INCLUSION DE FOOTER POR PHP  -->  
    <?PHP include ROOT_INCLUDE.'/footer.php'; ?>   

    <!--INCLUSION DE SCRIPTS JS POR PHP  -->
    <?PHP include ROOT_INCLUDE.'/scripts.php'; ?>

    <!-- INCLUSION DE FUNCTIONS JS -->
    <script src="<?php echo ROOT_PUBLIC;?>/js/index.js"></script>   

    <!-- INCLUSION DE FUNCTIONS CUESTIONARIO --> 
    <script src="<?php echo ROOT_MAIN_CON;?>/controllers/cuestionario.js"></script>
        
    <!-- INCLUSION DE FUNCTIONS USUARIO ESTUDIANTE JS -->        
    <script src="<?php echo ROOT_MAIN_CON;?>/controllers/student.js"></script>

    <!-- INCLUSION DE FUNCTIONS TEMPORISADOR JS -->        
    <script src="<?php echo ROOT_MAIN_CON;?>/controllers/temporizador.js"></script>

    <!-- INCLUSION DE FUNCTIONS STOP QUEST -->        
    <script src="<?php echo ROOT_MAIN_CON;?>/controllers/stoping_quest.js"></script>

    <!-- INCLUSION DE FUNCTIONS SPEAKING QUEST -->        
    <script src="<?php echo ROOT_MAIN_CON;?>/controllers/speak_quest.js"></script>

    <!-- INCLUSION DE FUNCTIONS NEW QUEST -->        
    <script src="<?php echo ROOT_MAIN_CON;?>/controllers/create-cuest-valid.js"></script>

    <!-- INCLUSION DE FUNCTIONS SAVE QUEST -->        
    <script src="<?php echo ROOT_MAIN_CON;?>/controllers/save-answ-quest-post.js"></script>
    
    <!-- INCLUSION DE FUNCTIONS ETYT -->        
    <script src="<?php echo ROOT_MAIN_CON;?>/controllers/etyt.js"></script>
    
    <!-- INCLUSION DE FUNCTIONS SAVE ALL QUEST FORM -->        
    <script src="<?php echo ROOT_MAIN_CON;?>/controllers/save-all-pre-reload.js"></script>
   

    <script>
        $(document).ready(function(){  
            //RespuestaNewCues = "<?php// echo $ResponseCuestionario['res']; ?>";
            if(RespuestaNewCues == 'true'){
                Toast.fire({
                    type: 'success',
                    title: "<?php echo $ResponseCuestionario['ResTex']; ?>"
                });
            }
            else{
                Toast.fire({
                    type: 'error',
                    title: "<?php echo $ResponseCuestionario['ResTex']; ?>"
                });
            }    
                    
            setTimeout(function(){
                SavAllOPRReload(<?php echo $Id_Cuestionario['id_cuestionario']; ?>, <?php echo $userlog['cod_estudiante']; ?>);
            }, 3000);

        });  

        <?php  if($ReiniciarTempo == True) { ?>
            setTimeout(function(){
                Toast.fire({
                        type: 'warning',
                        title: "Recalculando tiempo"
                    });
            },1500);
            TemporizadorDesde(<?php echo $MinnutosRestantes;?>);
        <?php  } else { ?>
            TemporizadorDesde(0);        
        <?php  }  ?>
    </script>

    </body>
</html>
        <?php } else {
            // EL USUARIO NO REALIZA INTERACION CON EL BOTON DEL CUESTIONARIO
            $_SESSION['UserInteraction'] = FALSE;
            header('Location: '.ROOT_MEDIA_USER.'/');
        }
    } else {
        // EL USUARIO NO TIENE EL BOTON HABILITADO
        header('Location: '.ROOT_MEDIA_USER.'/');
    }
?>