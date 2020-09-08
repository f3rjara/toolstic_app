<?php        
    include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
    include (ROOT_INCLUDE."/connect.php");     
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Home | ToolsTic</title>
        <?php include (ROOT_INCLUDE."/headers.php"); ?>
        <link rel="stylesheet" href="<?php echo ROOT_PUBLIC;?>/css/index.css">
    </head>
    <body class="ToolsticBlanco" >
    
    <nav>
        <div class="nav-wrapper ToolsTic_Verde">
            <a href="<?php echo ROOT_PATH;?>/index.php" class="brand-logo center">
                <img src="<?php echo ROOT_PUBLIC;?>/img/logotipo.png" width="230px">
            </a>            
        </div>
    </nav>  
     
    <br>
    <main>           
        <div class="row ">   
            <!-- PRIMERA TARJETA DE BIENVENIDA OCW -->
            <div class="col s12 m6 l3 push-l105">                
                <div class="card large center">
                    <div class="card-image">
                        <a href="<?php echo ROOT_MEDIA;?>/ocw_tools/">
                            <img src="<?php echo ROOT_PUBLIC;?>/img/ocw.gif">
                        </a>                   
                    </div>
                    
                    <div class="card-content">
                        <span class="card-title ToolsTic_Verde-text ">
                            <b style="font-weight: 600;">Open Course ToolsTIC</b>
                        </span>
                        <p>El curso abierto de Herramientas Informáticas - OpenCourse ToolsTIC, te brinda todo lo necesario para tu preparación al momento de realizar la prueba de Homologación ToolsTIC.</p>
                    </div>
                    
                    <div class="card-action center">
                        <a href="<?php echo ROOT_MEDIA;?>/ocw_tools/" class="btn btnCard ToolsTic_Verde col s12">
                            Acceder al Open Course
                        </a>
                    </div>
                </div>                 
            </div>
            
            <!-- SEGUNDA TARJETA DE BIENVENIDA OPEN-COURSE -->
            <div class="col s12 m6 l3 push-l105">
                <div class="card large center">
                    <div class="card-image">
                        <a href="<?php echo ROOT_MEDIA;?>/main">
                            <img src="<?php echo ROOT_PUBLIC;?>/img/examen.gif">
                        </a>                   
                    </div>
                    
                    <div class="card-content">
                        <span class="card-title ToolsTic_Verde-text ">
                            <b style="font-weight: 600;">Homologa ToolsTIC</b>
                        </span>                        
                        <p>La prueba de homologación a ToolsTIC solo estará habilitada en las fechas estipuladas, podrá ser realizada solo una vez durante tu carrera de pregrado.</p>
                    </div>
                    
                    <div class="card-action center">
                        <a href="<?php echo ROOT_MEDIA;?>/main" class="btn btnCard ToolsTic_Verde col s12">
                            Acceder a Homologación 
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- TERCERA TARJETA DE BIENVENIDA -->
            <div class="col s12 m6 l3 push-l105">
                <div class="card large center">
                    <div class="card-image">
                        <a href="<?php echo ROOT_MEDIA;?>/moodle_tools">
                            <img src="<?php echo ROOT_PUBLIC;?>/img/curso.gif">
                        </a>                    
                    </div>
                    
                    <div class="card-content">
                        <span class="card-title ToolsTic_Verde-text ">
                            <b style="font-weight: 600;">Curso ToolsTIC</b>
                        </span>                        
                        <p>El curso en Competencias Herramientas Informáticas - ToolsTIC, está preparado para alcanzar las diversas competencias digitales necesarias en tu carrera profesional. </p>
                    </div>
                    
                    <div class="card-action center">
                        <a href="<?php echo ROOT_MEDIA;?>/moodle_tools" class="btn btnCard ToolsTic_Verde col s12">Acceder a ToolsTIC</a>
                    </div>
                </div>
            </div>
        </div>   
        

        <div class="fixed-action-btn">
            <a class="btn-floating btn-large help ToolsTic_Verde darken-4">
                <i class="large material-icons">help_outline</i>
            </a>
            <ul>
                <li>
                    <a class="btn-floating green tooltipped modal-trigger" data-position="left" data-tooltip="Preguntas frecuentes"  href="#PrgFre">
                        <i class="material-icons">live_help</i>
                    </a>
                </li>

                <li>
                    <a class="btn-floating blue darken-1 tooltipped modal-trigger" data-position="left" data-tooltip="Video tutorial"  href="#VidTut">
                        <i class="material-icons">videocam</i>
                    </a>
                </li>            
            </ul>
        </div>

        <?php 
            include ROOT_PATH.'/public/requiere/quesFrecu.php';
            include ROOT_PATH.'/public/requiere/vidtuto.php';
        ?>


    </main>
    <br><br>
    
    <!--INCLUSION DE FOOTER POR PHP  -->  
        <?PHP include ROOT_INCLUDE.'/footer.php'; ?>    
    <!--INCLUSION DE SCRIPTS JS POR PHP  -->
        <?PHP include ROOT_INCLUDE.'/scripts.php'; ?>
   
        <script src="<?php echo ROOT_PUBLIC;?>/js/index.js"></script>   

    </body>
</html>
