<?php
    include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
    include_once (ROOT_INCLUDE."/connect.php");  
    include_once (ROOT_INCLUDE.'/fetch_array.php'); 
    include_once (ROOT_MAIN.'/views/sesion_student.php'); 
    if( !isset($_SESSION['user_student']) || ($_SESSION['error_user'] != FALSE && $_SESSION['user_student'] == NULL )) { header('Location: '.ROOT_MEDIA_USER.'/');   }   
    $_SESSION['btnPresentaPrueba'] = FALSE;
    $_SESSION['UserInteraction'] = FALSE;
?>

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
               
                <ul id="nav-mobile show-on-medium-and-down" class="left">
                    <li><a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a></li>                
                </ul>  
               
            </div>
        </nav> 
    </div>
    
    <?php            
        include (ROOT_MAIN.'/views/menu_student.php');   
        //ActualizaEstadoPrueba($conex); 
    ?>
           

    <main style="min-height: 70vh;" >  
    <br>
        <div class="row">
            <div class="col s12 m10 push-m1 center">
                <?php 
                    $EstudianteReload = DatosEstudiantesReload($conex, $userlog['cod_estudiante']);                             
                    if( $EstudianteReload['estudiante_habilitado'] == 1 ) { 
                        $EstudianteInscritoPrueba = EstudianteInscrito($userlog['cod_estudiante'], $conex);

                        if( $EstudianteInscritoPrueba['bandera'] ) {                            
                            if( $EstudianteReload['realizo_prueba'] == 0 ) {  

                                $idInscripcion =  $EstudianteInscritoPrueba['data']['id_inscripcion_prueba']; 
                                $idGrupo =  $EstudianteInscritoPrueba['data']['id_grupo'];             
                                $dataInscripcion = FullDatosInsctipcion($idGrupo, $conex);

                                if( $dataInscripcion['id_estado_prueba'] == 3 ) { 
                                    $BanderaHorario = VerificacionHorarioGrupo($dataInscripcion['id_estado_prueba'],$dataInscripcion['horario_grupo']);

                                    if( $BanderaHorario['bandera'] ) { 
                                        // VERIFICACIÓN SI TIENE UN CUESTIONARIO EN CURSO O NO
                                        $NoIntentosCues = IntenoStudent($conex, $userlog['cod_estudiante']);  
                                        $encripCod = md5($userlog['cod_estudiante']);                                       
                                        
                                        if( $NoIntentosCues !== NULL ) {
                                            // SE RECUPERAN PREGUNTAS Y RESPUESTAS GUARDAS POR EL ESTUDIANTE Y ACCESO A CUESTIONARIO
                                            $_SESSION['btnPresentaPrueba'] = TRUE; 
                                            include_once (ROOT_MAIN.'/views/reload-cuestionario.php');
                                            include_once (ROOT_MAIN.'/views/info-prueba.php');
                                            include_once (ROOT_MAIN.'/views/info-prueba-reload-cues.php');
                                        }
                                        else {
                                            // SE HABILITA EL ACCESO A UN NUEVO CUESTIONARIO POR EL ESTUDIANTE  
                                            $_SESSION['btnPresentaPrueba'] = TRUE; 
                                            include_once (ROOT_MAIN.'/views/new-cuestionario.php');
                                            include_once (ROOT_MAIN.'/views/info-prueba.php');
                                            include_once (ROOT_MAIN.'/views/info-prueba-new-cues.php');
                                        } 
                                    }
                                    else { 
                                        // NO ES HORA PARA LA PRESENTACION DEL CUESTIONARIO    
                                        $_SESSION['btnPresentaPrueba'] = FALSE; 
                                        include_once (ROOT_MAIN.'/views/horario-not-disponible.php');
                                    }
                                }
                                else {
                                    // LA PRUEBA NO ESTA EN CURSO, VERIFICAR FECHA DE PRESENTACIÓN
                                    include_once (ROOT_MAIN.'/views/prueba-not-disponible.php');
                                }
                            }                            
                            else{
                                // ESTUDIANTE YA PRESENTO EL CUESTIONARIO SE VA A RESULTADOS
                                include_once (ROOT_MAIN.'/views/student-presented.php');  
                            }
                        }   
                        else{
                            // ESTUDIANTE HABLITADO PERO NO ESTA INSCRITO
                            include_once (ROOT_MAIN.'/views/student-not-inscrit-group.php');  
                        }
                    }
                    else{
                        // ESTUDIANTE NO ESTA HABLITADO 
                        include_once (ROOT_MAIN.'/views/student_not_abiable.php'); 
                    }
                ?>
            </div>
        </div>
        <br><br>
    </main>
    <!--INCLUSION DE FOOTER POR PHP  -->  
    <?PHP include ROOT_INCLUDE.'/footer.php'; ?>   

    <!--INCLUSION DE SCRIPTS JS POR PHP  -->
    <?PHP include ROOT_INCLUDE.'/scripts.php'; ?>

    <!-- INCLUSION DE FUNCTIONS JS -->
    <script src="<?php echo ROOT_PUBLIC;?>/js/index.js"></script>   

    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <!-- INCLUSION DE FUNCTIONS USURIO ESTUDIANTE JS -->        
    <script src="<?php echo ROOT_MAIN_CON;?>/controllers/student.js"></script>
    <script src="<?php echo ROOT_MAIN_CON;?>/controllers/acceso_cuest.js"></script> 

    <script>
        $(document).ready(function(){
            M.AutoInit();
            Toast.fire({
              type: 'success',
              title: 'Usuario Conectado'
            });   
            mostrarDatosMenu(<?php echo $userlog['cod_estudiante']; ?>)      
            $('.tooltipped').tooltip();
        });  
    </script>
    

    <script>

        $('.content-carrousel').slick({
            slidesToShow: 4,
            adaptiveHeight: true,
            centerMode: true,
            focusOnSelect: true,
            infinite: true,
            dots: true,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [
                {
                breakpoint: 2500,
                    settings: {
                        slidesToShow: 4
                    }
                },
                {
                breakpoint: 1920,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                breakpoint: 1366,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                breakpoint: 800,
                    settings: {
                        slidesToShow: 1
                    }
                }                
            ]
        });

    </script>
      
    </body>
</html>