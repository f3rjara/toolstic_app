<?php
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
            $StudneReload = DatosEstudiantesReload($conex,$userlog['cod_estudiante']);?>

<html lang="es">

    <head>        
        <title>Estudiante | ToolsTic</title>  
        <?php include (ROOT_INCLUDE."/headers.php"); ?>
        <link rel="stylesheet" href="<?php echo ROOT_PUBLIC;?>/css/index.css">        
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
    <br><br> </main>

    <!--INCLUSION DE FOOTER POR PHP  -->  
    <?PHP include ROOT_INCLUDE.'/footer.php'; ?>   

    <!--INCLUSION DE SCRIPTS JS POR PHP  -->
    <?PHP include ROOT_INCLUDE.'/scripts.php'; ?>

    <!-- INCLUSION DE FUNCTIONS JS -->
    <script src="<?php echo ROOT_PUBLIC;?>/js/index.js"></script>   

    <!-- INCLUSION DE FUNCTIONS CUESTIONARIO --> 
    <script src="<?php echo ROOT_MAIN_CON;?>/controllers/cuestionario.js"></script>
        
    <!-- INCLUSION DE FUNCTIONS USURIO ESTUDIANTE JS -->        
    <script src="<?php echo ROOT_MAIN_CON;?>/controllers/student.js"></script>

    <script>
        $(document).ready(function(){  
            //RespuestaNewCues = "<?php// echo $ResponseCuestionario['res']; ?>";
        });  
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