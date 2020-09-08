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

    <main id="mainTT">        
        <div class="row">
            <div class="col s12 m10 push-m1 center">
                               
                <?php 
                $EstudianteInscritoPrueba = EstudianteInscrito($userlog['cod_estudiante'], $conex);
                $EstudianteReload = DatosEstudiantesReload($conex, $userlog['cod_estudiante']);
                                
                if($EstudianteReload['estudiante_habilitado'] == 1  || $EstudianteReload['realizo_prueba'] != 0){ ?>

                    <?php
                    
                    if($EstudianteInscritoPrueba['bandera'] == FALSE){

                        if(pruebasActive($conex)) 
                        { 
                            include_once (ROOT_MAIN.'/views/pruebas_abiables.php'); 
                        }
                        else{
                            include_once (ROOT_MAIN.'/views/pruebas_not_abiable.php'); 
                        }
                    }
                    else{

                        include_once (ROOT_MAIN.'/views/student_inscrito_grupo.php');                         
                    }
                }
                else{
                    include_once (ROOT_MAIN.'/views/student_not_abiable.php'); 
                }
                ?>

            </div>
        </div>
        <br>
        <br>
        
    </main>
   
   
    <!--INCLUSION DE FOOTER POR PHP  -->  
    <?PHP include ROOT_INCLUDE.'/footer.php'; ?>   

    <!--INCLUSION DE SCRIPTS JS POR PHP  -->
    <?PHP include ROOT_INCLUDE.'/scripts.php'; ?>

    <!-- INCLUSION DE FUNCTIONS JS -->
    <script src="<?php echo ROOT_PUBLIC;?>/js/index.js"></script>   

    <!-- INCLUSION DE FUNCTIONS USURIO ESTUDIANTE JS -->        
    <script src="<?php echo ROOT_MAIN_CON;?>/controllers/student.js"></script>   
       
    <!-- INCLUSION DE FUNCTIONS MOSTRAR GRUPOS DISPONIBLES -->        
    <script src="<?php echo ROOT_MAIN_CON;?>/controllers/mostrarGrupoInscripcion.js"></script>   

    <!-- INCLUSION DE FUNCTIONS EJECUTAR INSCRIPCION -->        
    <script src="<?php echo ROOT_MAIN_CON;?>/controllers/realizarInscripcion.js"></script>   

    <!-- INCLUSION DE FUNCTIONS CANCELAR INSCRIPCION -->        
    <script src="<?php echo ROOT_MAIN_CON;?>/controllers/cancelarInscripcion.js"></script> 


    <script>
        $(document).ready(function(){
            M.AutoInit();
                Toast.fire({
                type: 'success',
                title: 'Usuario Conectado'
            })
            
            mostrarDatosMenu(<?php echo $userlog['cod_estudiante']; ?>)      
            $('.tooltipped').tooltip();

            function imprimirMain() {
                alert("Configure los ajustes de la hoja, cambie la escala a 75 para una mejor visualización.");
                window.print();
            }
                
        });   
    </script>          
      
    </body>
</html>