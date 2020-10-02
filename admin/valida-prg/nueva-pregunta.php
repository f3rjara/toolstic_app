<?php 
    session_start();
    if(isset($_SESSION['user_docente'])){
        $userlog = $_SESSION['user_docente'];
    }
    else{
        header('Location: ../../logout.php');
    }

    require "./../conex.php";   
?>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Nueva Pregunta | ToolsTIC</title>
        <link rel="icon" type="image/png" href="../../img/favUdenar.png">
        <link rel="stylesheet" href="../../css/valida-prg.css">
        <link rel="stylesheet" href="../../css/materialize.css">
        <link rel="stylesheet" href="../../css/sweetalert2.css">
        <link rel="stylesheet" href="css/new-prg.css">

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">      

        <link rel="stylesheet" href="./../../css/summernote-lite.css" rel="stylesheet">

    </head>
    
    <body class="ToolsticBlanco" >

    <div class="navbar-fixed">
    <nav class="ToolsTic_Verde z-depth-2">
        <div class="nav-wrapper">
            <a class="brand-logo center"><img src="../../img/logotipo.png" width="200px"></a> 
            <ul id="nav-mobile" class="left">
                <li><a data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a></li>                
            </ul>            
        </div>
    </nav> 
       
    </div>
    
    <?php 
        include 'menu_Docente.php';
    ?>
       
    <br><br>
    <main id="mainTT"> 
        <div class="row">
            <div class="col s12 m10 push-m1">
                <div class="card  ">
                    <div class="card-content">
                        <div class="row center">
                            <div class="col s12 m10 push-m1 ">
                       
                    <h4>Creación de preguntas</h4> <br>
                   
                    <div class="col s12 m10 push-m1">
                    <p style="text-align: justify;">Complete el siguiente formulario para la creación de preguntas de una competencia específica,  una vez la pregunta sea validada y aceptada pasará a hacer parte del banco de preguntas de la prueba de Homologación del Curso de Lenguaje y Herramientas Informáticas. <b>Homologa ToolsTIC</>. </p> <br>
                    </div>

                    <div class="col s12">
                        <p>
                            <span class="red-text left"> <b> * Todos los campos son obligatorios</b> </span>
                            <br>
                            <br>
                        </p>
                    </div>
                    <form class="col s12" method="POST" id="FormNewPrg" >
                        <div class="row">
                            <div class="row">
                            <!-- SELECT PARA LAS COMPETENCIAS -->
                            <div class="input-field col s12">
                                <select id="SelectLista1" require>
                                    <option value="0" disabled selected >Seleccione una Opción</option>
                                    <option value="1" >ALFABETIZACIÓN INFORMACIONAL</option>
                                    <option value="2">RESOLUCIÓN DE PROBLEMAS CON EL USO DE RECURSOS COMPUTACIONALES</option>
                                    <option value="3">COMUNICACIÓN Y COLABORACIÓN EN ENTORNOS DIGITALES</option>
                                    <option value="4">CREACIÓN Y PUBLICACIÓN DE CONTENIDOS DIGITALES</option>
                                </select>
                                <label>Seleccione una Competencia</label>
                            </div>

                            <!-- SELECT PARA LAS EVIDENCIAS -->
                            <div class="input-field col s12"> 
                                <select id="SelectLista2" require> 

                                </select>
                                <label>Seleccione una Evidencia</label>
                                
                            </div>

                            <!-- SELECT PARA LAS TAREAS -->
                            <div class="input-field col s12">                    
                                <select id="SelectLista3">                        
                                </select>
                                <label>Seleccione una Tarea</label>  
                                <br>
                            </div>
                            
                            <br>
                            <div class="row">
                             <!-- ENUNCIADO DE LA PREGUNTA -->
                            <label>Enunciado de la pregunta</label> <br>
                            <div class="input-field col s12 TexArea left-align">  
                                <textarea require id="TxEnunciado" class="materialize-textarea"></textarea>  
                            </div> 
                            </div>

                            <!-- OPCION DE RESPUESTA 1  -->
                            <div class="row ">
                                <br>
                                <label>Opción de respuesta No. 1</label> 
                                <br>    
                                <div class="col s12 m12 l3  ">
                                    <hr>                                    
                                    <div class="input-field col s12">
                                        <a class="btn col s12 green"><b>Peso respuesta 1</b></a>
                                        
                                        <select class="browser-default" id="PesoTxOpcion1">
                                            <option require disabled selected>Peso Respuesta 1</option>  
                                            <?php
                                            $pesos =100 ;
                                            for($i=20; $i>=0; $i--){
                                            ?>
                                                <option value="<?php echo $pesos;?>"><?php echo $pesos;?></option>
                                            
                                            <?php $pesos -= 5; };?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col s12 m12 l9">
                                    <div class="input-field col s12 TexArea2">
                                        <textarea require id="TxOpcion1" class="materialize-textarea"></textarea> 
                                    </div>
                                </div>                        
                            </div>

                            <!-- OPCION DE RESPUESTA 2  -->
                            <div class="row ">
                                <br>
                                <label>Opción de respuesta No. 2</label> 
                                <br>    
                                <div class="col s12 m12 l3  ">
                                    <hr>                                    
                                    <div class="input-field col s12">
                                        <a class="btn col s12 blue"><b>Peso respuesta 2</b></a>
                                        
                                        <select class="browser-default" id="PesoTxOpcion2">
                                            <option require disabled selected>Peso Respuesta 2</option>  
                                            <?php
                                            $pesos =100 ;
                                            for($i=20; $i>=0; $i--){
                                            ?>
                                                <option value="<?php echo $pesos;?>"><?php echo $pesos;?></option>
                                            
                                            <?php $pesos -= 5; };?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col s12 m12 l9">
                                    <div class="input-field col s12 TexArea2">
                                        <textarea require id="TxOpcion2" class="materialize-textarea"></textarea> 
                                    </div>
                                </div>                        
                            </div>


                            <!-- OPCION DE RESPUESTA 3  -->
                            <div class="row ">
                                <br>
                                <label>Opción de respuesta No. 3</label> 
                                <br>    
                                <div class="col s12 m12 l3  ">
                                <hr>                                    
                                    <div class="input-field col s12">
                                        <a class="btn col s12 orange"><b>Peso respuesta 3</b></a>
                                        
                                        <select class="browser-default" id="PesoTxOpcion3">
                                            <option require disabled selected>Peso Respuesta 3</option>  
                                            <?php
                                            $pesos =100 ;
                                            for($i=20; $i>=0; $i--){
                                            ?>
                                                <option value="<?php echo $pesos;?>"><?php echo $pesos;?></option>
                                            
                                            <?php $pesos -= 5; };?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col s12 m12 l9">
                                    <div class="input-field col s12 TexArea2">
                                        <textarea require id="TxOpcion3" class="materialize-textarea"></textarea> 
                                    </div>
                                </div>                        
                            </div>


                            <!-- OPCION DE RESPUESTA 4  -->
                            <div class="row ">
                                <br>
                                <label>Opción de respuesta No. 4</label> 
                                <br>    
                                <div class="col s12 m12 l3  ">
                                    <hr>                                    
                                    <div class="input-field col s12">
                                        <a class="btn col s12 red"><b>Peso respuesta 4</b></a>
                                        
                                        <select class="browser-default" id="PesoTxOpcion4">
                                            <option require disabled selected>Peso Respuesta 4</option>  
                                            <?php
                                            $pesos =100 ;
                                            for($i=20; $i>=0; $i--){
                                            ?>
                                                <option value="<?php echo $pesos;?>"><?php echo $pesos;?></option>
                                            
                                            <?php $pesos -= 5; };?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col s12 m12 l9">
                                    <div class="input-field col s12 TexArea2">
                                        <textarea require id="TxOpcion4" class="materialize-textarea"></textarea> 
                                    </div>
                                </div>                        
                            </div>

                            <div class="row">
                                <br>
                                <hr>
                                <br>
                                    <button class="btn col s12 m12 l6 push-l3 green" type="submit" name="action" id="BtnNewPrg" >CREAR NUEVA PREGUNTA
                                        <i class="material-icons right">send</i>
                                    </button>
                                    
                            </div>

                        </div>
                    </form>
                    </div>
                    </div>
                    </div>  
                    <br>    
                </div>
            </div>
        </div>
    
    </main>
   
    <br><br>
    <?php include './../footer.php'; ?>
        
    <script src="../../js/jquery-341.js"></script>
    <script src="../../js/materialize.js"></script> 
    <script src="../../js/sweetalert2.all.js"></script>  
    <script src="funciones.js"></script> 
    <script src="js/new-question.js"></script> 
    <script src="js/summernote-lite.js"></script>
    <script src="js/summernote-es-ES.js"></script>
    <script src="js/textareas.js"></script>
    <script src="js/agregaPregunta.js"></script>

    <script>
        $(document).ready(function(){
            M.AutoInit();
            HabilitarTexarea();
            

            let timerInterval
                Swal.fire({
                title: 'Borrar estilos de parrafo!',
                html: '<h6>Por favor borre los estilos de fuente tanto en el enunciado como las opciones de respuestas, con el propósito de obtener un estilo igual en todas las preguntas realizadas por los usuarios. <br><br> Puede hacer uso de las teclas <br><strong>CONTROL + SHIFT + V</strong> <hr> comenzar en: <b> </b></hr></h6>.',
                timer: 3500,
                allowOutsideClick: false,
                allowEscapeKey:false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {
                    Swal.getContent().querySelector('b')
                        .textContent = Swal.getTimerLeft()
                    }, 100)
                },
                onClose: () => {
                    clearInterval(timerInterval)
                }
                }).then((result) => {
                if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.timer
                ) {
                    console.log('Ahora puede crear una pregunta');
                    Toast.fire({
                        type: 'success',
                        title: 'Todo listo'
                    });
                }
                });

                
           
            
            
            

            mostrarDatos();
            agregaDatosEdicion(<?php echo $userlog['id_usuario']; ?>);   
            
           


            //recargarLista COMPETENCIAS ;   
            $('#SelectLista1').change(function(){                    
                $('#SelectLista1 option:selected').each(function(){        
                    id_competencia = $(this).val(); 
                    console.log(id_competencia);                    
                    $.ajax({
                        data: {
                            id_competencia: id_competencia                            
                        },
                        url:   './php/get-evidencia.php',
                        type:  'post',                    
                        success:  function (response) {                             
                            $('#SelectLista2').html(response);                            
                            $('select').formSelect();
                        }
                    });
                });              
                    limpiaLista3();                
                //
            }); //FIN CHANGE SELECT LISTA 1

            $('#SelectLista2').change(function(){
                //$('#SelectLista2 option:selected').val();                               
                $('#SelectLista2 option:selected').each(function(){        
                    id_evidencia = $(this).val(); 
                    console.log(id_evidencia);
                    $.ajax({
                        data: {
                            id_evidencia: id_evidencia
                        },
                        url:   './php/get-tarea.php',
                        type:  'post',                    
                        success:  function (response) {                             
                            $('#SelectLista3').html(response);                            
                            $('select').formSelect();
                        }
                    });
                });
            });
            //FIN CHANGE SELECT LISTA 3
            $('#SelectLista3').change(function(){ 
                id_tarea = $(this).val(); 
                console.log(id_tarea);
            });

            
        });  
        
        document.addEventListener('DOMContentLoaded', function() {
            M.AutoInit();
        });
        
    </script>
    
      
    </body>
</html>