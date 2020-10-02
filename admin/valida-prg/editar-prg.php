<?php 
    session_start();
    if(isset($_SESSION['user_docente'])){
        $userlog = $_SESSION['user_docente'];
    }
    else{
        header('Location: ../../logout.php');
    }

    require "./../conex.php";   
    if(isset($_GET['pd']) && isset($_GET['has']) && $_GET['has'] == md5($userlog['id_usuario'])  ) { 
        $IdPrguntaDelete = $_GET['pd'];        
    }
    else{
        header('Location: ./index.php');
    }
?>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Editar Pregunta | ToolsTic</title>
        <link rel="icon" type="image/png" href="../../img/favUdenar.png">
        <link rel="stylesheet" href="../../css/valida-prg.css">
        <link rel="stylesheet" href="../../css/materialize.css">
        <link rel="stylesheet" href="../../css/sweetalert2.css">
        <link rel="stylesheet" href="css/new-prg.css">

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">      

        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css" rel="stylesheet">

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
        include './php/fetch_records.php';

        $ICETprg = ObtenerICETprg($IdPrguntaDelete, $conex);
       

    ?>
       
    <br><br>
    <main id="mainTT"> 
        <div class="row">
            <div class="col s12 m10 push-m1">
                <div class="card  ">
                    <div class="card-content">
                        <div class="row center">
                            <div class="col s12 m10 push-m1 ">
                       
                    <h4>Actualización de preguntas</h4> <br>
                   
                    <div class="col s12 m10 push-m1">
                    
                    <p style="text-align: justify;">Complete el siguiente formulario para la actualización de la pregunta,  una vez la pregunta sea modificada cambiara su estado a Sin validar; de este modo deberá ser revisada por un Docente Experto Tematico para su validación y aceptación, de esta forma pasará a hacer parte del banco de preguntas de la prueba de Homologación del Curso de Lenguaje y Herramientas Informáticas. <b>Homologa ToolsTic</>. </p> <br>
                    </div>

                    <div class="col s12">
                        <p>
                            <span class="red-text left"> <b> * Todos los campos son obligatorios</b> </span>
                            <br>
                            <br>
                        </p>
                    </div>
                    <form class="col s12" method="POST" id="FormActualizaPrg" >
                        <div class="row">
                            <div class="row">                            
                                    
                            <!-- SELECT PARA LAS COMPETENCIAS -->
                            <div class="input-field col s12">
                                <select id="SelectLista1" require>
                                    <option value="0" disabled >Seleccione una Opción</option>
                                    <?php  echo $ICETprg['id_competencia']; 

                                    switch ($ICETprg['id_competencia']) {
                                        case 1:
                                        ?>
                                            <option value="1" selected >ALFABETIZACIÓN INFORMACIONAL</option>
                                            <option value="2">RESOLUCIÓN DE PROBLEMAS CON EL USO DE RECURSOS COMPUTACIONALES</option>
                                            <option value="3">COMUNICACIÓN Y COLABORACIÓN EN ENTORNOS DIGITALES</option>
                                            <option value="4">CREACIÓN Y PUBLICACIÓN DE CONTENIDOS DIGITALES</option>
                                        <?php  break;
                                        case 2:
                                        ?>
                                            <option value="1"  >ALFABETIZACIÓN INFORMACIONAL</option>
                                            <option value="2" selected>RESOLUCIÓN DE PROBLEMAS CON EL USO DE RECURSOS COMPUTACIONALES</option>
                                            <option value="3">COMUNICACIÓN Y COLABORACIÓN EN ENTORNOS DIGITALES</option>
                                            <option value="4">CREACIÓN Y PUBLICACIÓN DE CONTENIDOS DIGITALES</option>
                                        <?php  break;
                                        case 3:
                                        ?>
                                           <option value="1"  >ALFABETIZACIÓN INFORMACIONAL</option>
                                            <option value="2">RESOLUCIÓN DE PROBLEMAS CON EL USO DE RECURSOS COMPUTACIONALES</option>
                                            <option value="3" selected>COMUNICACIÓN Y COLABORACIÓN EN ENTORNOS DIGITALES</option>
                                            <option value="4">CREACIÓN Y PUBLICACIÓN DE CONTENIDOS DIGITALES</option>
                                        <?php  break;
                                        case 4:
                                        ?>
                                           <option value="1"  >ALFABETIZACIÓN INFORMACIONAL</option>
                                            <option value="2">RESOLUCIÓN DE PROBLEMAS CON EL USO DE RECURSOS COMPUTACIONALES</option>
                                            <option value="3">COMUNICACIÓN Y COLABORACIÓN EN ENTORNOS DIGITALES</option>
                                            <option value="4" selected>CREACIÓN Y PUBLICACIÓN DE CONTENIDOS DIGITALES</option>
                                        <?php  break;
                                    }

                                    ?> 
                                </select>
                                <label>Seleccione una Competencia</label>
                            </div>

                            <!-- SELECT PARA LAS EVIDENCIAS -->
                            <div class="input-field col s12"> 
                                <select id="SelectLista2" require> 
                                    <?php 

                                        $SqlEvidencia = "SELECT * FROM evidencia WHERE id_competencia = '".$ICETprg['id_competencia']."' ";
                                        $ResultSql = $conex->query($SqlEvidencia);

                                        $cadena = '<option value="0">Seleccione una opción</option>';
                                        while($datos = $ResultSql->fetch_assoc()){ 
                                            if($datos['id_evidencia'] == $ICETprg['id_evidencia'] ){
                                                $cadena = $cadena.'<option selected value="'.$datos['id_evidencia'].'">'.utf8_encode($datos['evidencia']).'</option>';
                                            }
                                            else{
                                                $cadena = $cadena.'<option value="'.$datos['id_evidencia'].'">'.utf8_encode($datos['evidencia']).'</option>';
                                            }                                            
                                        };
                                        echo $cadena;
                                    ?>
                                </select>
                                <label>Seleccione una Evidencia</label>
                                
                            </div>

                            <!-- SELECT PARA LAS TAREAS -->
                            <div class="input-field col s12">                    
                                <select id="SelectLista3">    
                                <?php 
                                    $SqlTarea = "SELECT * FROM tarea WHERE id_evidencia = '".$ICETprg['id_evidencia']."'";
                                    $ResultSql = $conex->query($SqlTarea);

                                    $cadena = '<option value="0">Seleccione una opción</option>';
                                    while($datos = $ResultSql->fetch_assoc()){ 
                                        if($datos['id_tarea'] == $ICETprg['id_tarea'] ){
                                            $cadena = $cadena.'<option selected value="'.$datos['id_tarea'].'">'.utf8_encode($datos['tarea']).'</option>';
                                        }
                                        else{
                                            $cadena = $cadena.'<option value="'.$datos['id_tarea'].'">'.utf8_encode($datos['tarea']).'</option>';
                                        }                                            
                                    };
                                    echo $cadena;
                                    ?>                    
                                </select>
                                <label>Seleccione una Tarea</label>  
                                <br>
                            </div>
                            <?php
                            $DatosPregunta = PreguntaAll($IdPrguntaDelete, $conex);                         
                            
                            ?>
                            <!-- CÓDIGO DE LA PREGUNTA --> 
                            <div class="col s12 left-align">
                                &nbsp; <span><b>Código pregunta</b> </span>
                                    <a class="btN orange white-text"><b><?php echo $DatosPregunta['cod_pregunta'];?></b></a>
                                <br> <br>
                            </div> 
                            </div>
                            
                            

                            <div class="row">
                            <input type="text" hidden="true"  id="IdPrguntaDelete" value="<?php echo $IdPrguntaDelete;?>"> 
                            
                            
                            <br>
                            <!-- ENUNCIADO DE LA PREGUNTA -->
                            <label>Enunciado de la pregunta</label> <br>
                            <div class="input-field col s12 TexArea left-align">  
                                <textarea require id="TxEnunciado" class="materialize-textarea">
                                    <?php echo $DatosPregunta['enunciado_pregunta'];?>
                                </textarea>  
                            </div> 
                            </div>
                            <?php
                                $DataRespu = ObtenerOpcionesRespuestas($IdPrguntaDelete, $conex);
                            ?>

                            


                            <!-- OPCION DE RESPUESTA 1  -->
                            <div class="row ">                            
                                <br>
                                <label>Opción de respuesta No. 1</label> 
                                <br>    
                                <input type="text" hidden="true"  id="Idop1" value="<?php echo $DataRespu[0]['id_opcion_respuesta'];?>">
                                
                                <div class="col s12 m12 l3">
                                    <hr>                                    
                                    <div class="input-field col s12">
                                        <a class="btn col s12 green"><b>Peso respuesta 1</b></a>
                                        
                                        <select class="browser-default" id="PesoTxOpcion1">
                                            <option require disabled selected>Peso Respuesta 1</option>  
                                            <?php
                                            $pesos =0 ;
                                            for($i=0; $i<=20; $i++){
                                                if($DataRespu[0]['peso_opcion_respuesta'] == $pesos){
                                                    echo '<option selected value="'.$pesos.'">'.$pesos.'</option>';
                                                }else{
                                                    echo '<option value="'.$pesos.'">'.$pesos.'</option>';
                                                };  $pesos += 5; };?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col s12 m12 l9">
                                    <div class="input-field col s12 TexArea2">
                                        <textarea require id="TxOpcion1" class="materialize-textarea">
                                                <?php echo $DataRespu[0]['opcion_respuesta'];?>
                                        </textarea> 
                                    </div>
                                </div>                        
                            </div>

                            <!-- OPCION DE RESPUESTA 2  -->
                            <div class="row ">
                                <br>
                                <label>Opción de respuesta No. 2</label> 
                                <br>    
                                <input type="text" hidden="true"  id="Idop2" value="<?php echo $DataRespu[1]['id_opcion_respuesta'];?>">
                                <div class="col s12 m12 l3  ">
                                    <hr>                                    
                                    <div class="input-field col s12">
                                        <a class="btn col s12 blue"><b>Peso respuesta 2</b></a>
                                        
                                        <select class="browser-default" id="PesoTxOpcion2">
                                            <option require disabled selected>Peso Respuesta 2</option>  
                                            <?php
                                            $pesos =0 ;
                                            for($i=0; $i<=20; $i++){
                                                if($DataRespu[1]['peso_opcion_respuesta'] == $pesos){
                                                    echo '<option selected value="'.$pesos.'">'.$pesos.'</option>';
                                                }else{
                                                    echo '<option value="'.$pesos.'">'.$pesos.'</option>';
                                                };  $pesos += 5; };?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col s12 m12 l9">
                                    <div class="input-field col s12 TexArea2">
                                        <textarea require id="TxOpcion2" class="materialize-textarea">
                                            <?php echo $DataRespu[1]['opcion_respuesta'];?>
                                        </textarea> 
                                    </div>
                                </div>                        
                            </div>


                            <!-- OPCION DE RESPUESTA 3  -->
                            <div class="row ">
                                <br>
                                <label>Opción de respuesta No. 3</label> 
                                <br> 
                                <input type="text" hidden="true"  id="Idop3" value="<?php echo $DataRespu[2]['id_opcion_respuesta'];?>">   
                                <div class="col s12 m12 l3  ">
                                <hr>                                    
                                    <div class="input-field col s12">
                                        <a class="btn col s12 orange"><b>Peso respuesta 3</b></a>
                                        
                                        <select class="browser-default" id="PesoTxOpcion3">
                                            <option require disabled selected>Peso Respuesta 3</option>  
                                            <?php
                                            $pesos =0 ;
                                            for($i=0; $i<=20; $i++){
                                                if($DataRespu[2]['peso_opcion_respuesta'] == $pesos){
                                                    echo '<option selected value="'.$pesos.'">'.$pesos.'</option>';
                                                }else{
                                                    echo '<option value="'.$pesos.'">'.$pesos.'</option>';
                                                };  $pesos += 5; };?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col s12 m12 l9">
                                    <div class="input-field col s12 TexArea2">
                                        <textarea require id="TxOpcion3" class="materialize-textarea">
                                            <?php echo $DataRespu[2]['opcion_respuesta'];?>
                                        </textarea> 
                                    </div>
                                </div>                        
                            </div>


                            <!-- OPCION DE RESPUESTA 4  -->
                            <div class="row ">
                                <br>
                                <input type="text" hidden="true"  id="Idop4" value="<?php echo $DataRespu[3]['id_opcion_respuesta'];?>"> 
                                <label>Opción de respuesta No. 4</label> 
                                <br>    
                                <div class="col s12 m12 l3  ">
                                    <hr>                                    
                                    <div class="input-field col s12">
                                        <a class="btn col s12 red"><b>Peso respuesta 4</b></a>
                                        
                                        <select class="browser-default" id="PesoTxOpcion4">
                                            <option require disabled selected>Peso Respuesta 4</option>  
                                            <?php
                                            $pesos =0 ;
                                            for($i=0; $i<=20; $i++){
                                                if($DataRespu[3]['peso_opcion_respuesta'] == $pesos){
                                                    echo '<option selected value="'.$pesos.'">'.$pesos.'</option>';
                                                }else{
                                                    echo '<option value="'.$pesos.'">'.$pesos.'</option>';
                                                };  $pesos += 5; };?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col s12 m12 l9">
                                    <div class="input-field col s12 TexArea2">
                                        <textarea require id="TxOpcion4" class="materialize-textarea">
                                            <?php echo $DataRespu[3]['opcion_respuesta'];?>
                                        </textarea> 
                                    </div>
                                </div>                        
                            </div>

                            <div class="row">
                                <br>
                                <hr>
                                <br>
                                    <button class="btn col s12 m12 l6 push-l3 blue" type="submit" name="action" id="BtnActPrg" >ACTUALIZAR PREGUNTA
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
    <script src="js/updatePregunta.js"></script>

    <script>
        $(document).ready(function(){
            M.AutoInit();
            Toast.fire({
              type: 'success',
              title: 'Ussuario Conectado'
            })
            
            let timerInterval
                Swal.fire({
                title: 'Borrar estilos de parrafo!',
                html: '<h6>Por favor borre los estilos de fuente tanto en el enunciado como las opciones de respuestas, con el propósito de obtener un estilo igual en todas las preguntas realizadas por los usuarios. <br><br> Puede hacer uso de las teclas <br><strong>CONTROL + SHIFT + V</strong> <hr> comenzar en: <b> </b></hr></h6>.',
                timer: 5000,
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
                    console.log('Ahora puede crear una pregunta')
                }
                });
           

            mostrarDatos();
            agregaDatosEdicion(<?php echo $userlog['id_usuario']; ?>);   
            
            HabilitarTexarea();


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