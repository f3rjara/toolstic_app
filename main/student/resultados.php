<?php
    include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
    include_once (ROOT_INCLUDE."/connect.php");  
    include_once (ROOT_INCLUDE.'/fetch_array.php'); 
    include_once (ROOT_MAIN.'/views/sesion_student.php'); 
    if( $_SESSION['error_user'] != FALSE && $_SESSION['user_student'] == NULL) { header('Location: '.ROOT_MEDIA_USER.'/');   }   
    $_SESSION['dataReport'] = FALSE;
    $_SESSION['btnPresentaPrueba'] = FALSE;
    $_SESSION['UserInteraction'] = FALSE;
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
       
    <br>
    <main class="mainTT">

        <div class="row">
            <div class="col s12 m10 push-m1 center">
                <?php 
                    $EstudianteInscritoPrueba = EstudianteInscrito($userlog['cod_estudiante'], $conex);
                    $EstudianteReload = DatosEstudiantesReload($conex, $userlog['cod_estudiante']);
                    
                    if( $EstudianteReload['realizo_prueba'] !== 0 || $EstudianteReload['estudiante_habilitado'] === 1  ){ 

                        if( $EstudianteInscritoPrueba['bandera'] == TRUE ) {
                            $checkCuest =  checkReslut ( $conex , $userlog['cod_estudiante'] ) ;

                            if ( $checkCuest['result'] ) {
                                // ESTUDIANTE TIENE RESULTADOS Y ESTA INSCRITO
                                include_once (ROOT_MAIN.'/views/result_abiables.php'); 
                            }
                            else { 
                                // ESTUDIANTE NO TIENE RESULTADOS Y ESTA INSCRITO
                                include_once (ROOT_MAIN.'/views/result_not_abiables.php'); 
                            }
                        }
                        else {
                            // ESTUDIANTE NO INSCRITO EN UN GRUPO
                            include_once (ROOT_MAIN.'/views/result_not_enroll.php'); 
                        }
                    }
                    else{
                        // ESTUDIANTE NO HABILITADO
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

    <!-- INCLUSION DE FUNCTIONS USURIO ESTUDIANTE JS -->        
    <script src="<?php echo ROOT_MAIN_CON;?>/controllers/student.js"></script>   
    

    <script>
        $(document).ready(function(){
            M.AutoInit();
                Toast.fire({
                type: 'success',
                title: 'Usuario Conectado'
            })
            
            mostrarDatosMenu(<?php echo $userlog['cod_estudiante']; ?>)      
            $('.tooltipped').tooltip();            
        });
    </script>      
    </body>
</html>

