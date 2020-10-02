<?php 
    session_start();
    if(isset($_SESSION['user_docente'])){
        $userlog = $_SESSION['user_docente'];
    }
    else{
        header('Location: ../../');
    }
?>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Validar preguntas | ToolsTIC</title>
        <link rel="icon" type="image/png" href="../../img/favUdenar.png">
        <link rel="stylesheet" href="../../css/valida-prg.css">
        <link rel="stylesheet" href="../../css/materialize.css">
        <link rel="stylesheet" href="../../css/sweetalert2.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="../../css/Chart.css">

        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">  
        
        <script src="../../js/jquery-341.js"></script>        
        <script src="../../js/Chart.js"></script>
        <script src="../../js/Chart.bundle.js"></script>
        <script src="../../js/chartjs-plugin-datalabels.js"></script>
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
        require './../conex.php';
        include './php/fetch_records.php';
    ?>
      
    <main>        
        <div class="row">
            <div class="col s12 m12">
                
                   
                        <?php 
                            $dataPA = PreguntasAsignadasList($userlog['id_usuario'],$conex);
                            $numDataResult = count($dataPA);
                            if($numDataResult < 1) { 
                        ?>
                        <div class="row center">
                                <div class="col s12 m6 push-m3 l4 push-l4 center">
                                    <img src="./../../img/sin_preguntas.svg" width="70%">
                                </div>                                
                        </div>
                        <br>
                        <div class="row center">
                        <div class="col s12">
                        <a class="btn green">No tiene preguntas por ser revisadas</a>
                        </div>
                        
                        </div>
                            
                        <?php }
                         else { ?>
                            <div class="card ToolsticBlanco">
                        <div class="card-content center">
                            <div class="col s12 m5 push-m1 ">
                            <h5 class="ToolsTic_Verde-text">Validación de preguntas</h5><hr>
                                <p style="text-align:center" class="center-align">A continuación se presentan las preguntas que han sido asignadas con el fin de realizar la respectiva validación de contenido; por favor complete sus observaciones correspondientes en cada pregunta y envié su retroalimentación. <br> <br><b>¡Muchas gracias por su colaboración y apoyar este proyecto!</b> </p>     <br>      
                                <a class="btn black white-text" onclick="GrafiPregunDocExperto('<?php echo $userlog['id_usuario'];?>')">RECARGAR GRAFICO</a>                        
                            </div>
                        
                            <div class="col s12 m5 push-m1 center ">
                                <canvas id="Graf-PreVali" width="98%" heigth="300px">
                                </canvas>                                
                            </div>
                            
                        </div> 
                          <!-- FIN DIV CARD-CONTENT TEXTO -->
                        <div class="progress" style=" margin-top: 20px; top: 28px !important;">  
                            <div class="indeterminate"></div>
                        </div>
                    <div class="card-content center">
                            <div class="card-tabs">
                                <ul class="tabs tabs-fixed-width">
                                    <?php for($j = 0; $j < $numDataResult; $j++){ ?>  
                                        <li class="tab <?php echo $dataPA[$j]['bgcolor_estado_pregunta'];?>">
                                            <a href="#test<?php echo $j;?>" class="white-text">
                                                <b><?php echo $j+1;?></b>
                                            </a>
                                        </li>
                                    <?php  } // fin for ?> 
                                </ul>   
                            </div>   <!-- FIN CARD TABS -->   
                            
                            <div class="card-content ToolsticBlanco">  
                            <?PHP  for($k = 0; $k < $numDataResult; $k++) { ?>
                                <div id="test<?php echo $k;?>" class="row">                            
                                    <div class="col s12 m12 l6">
                                        <div class="card-panel ToolsticBlanco black-text lighten-2">
                                            <div class="row">
                                                <b class="btn ToolsticAzul">Pregunta:</b> 
                                                <b class="btn orange black-text"><?php echo $k+1; ?></b> 
                                                &nbsp;
                                                <a class="btn ToolsticAzul"><?php echo $dataPA[$k]['cod_pregunta'];?></a>
                                            </div>
                                            
                                            <hr>
                                            <b>Estado de la pregunta:</b> 
                                            <div class="chip white-text <?php echo $dataPA[$k]['bgcolor_estado_pregunta'];?>"><?php echo $dataPA[$k]['estado_pregunta'];?></div>
                                        </div>
                                        
                                        <div class="row ToolsticBlanco white-text samll">

                                            <?php
                                                $dataCompe = ObtenerCompetenciaPrg($dataPA[$k]['id_pregunta'], $conex);
                                            ?>

                                            <!--COLLAPSIBLE COMPETENCIAS , EVI, TAREA DE LA PREGUNTA -->
                                            <ul class="collapsible black-text">
                                                <li>
                                                    <div class="collapsible-header">
                                                        <i class="material-icons">bookmark</i>
                                                        <span><b><?php echo utf8_encode($dataCompe['competencia']); ?></b></span>   
                                                    </div>

                                                    <div class="collapsible-body blue-grey lighten-5">
                                                        <span><?php echo utf8_encode($dataCompe['afirmacion_competencia']); ?></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header">
                                                        <i class="material-icons">description</i>
                                                        <span><b>EVIDENCIA</b></span>
                                                    </div>

                                                    <div class="collapsible-body blue-grey lighten-5">
                                                        <span><?php echo utf8_encode($dataCompe['evidencia']); ?></span>
                                                    </div>
                                                </li>
                                                <li class="active">
                                                    <div class="collapsible-header">
                                                        <i class="material-icons">import_contacts</i>
                                                        <span><b>TAREA</b></span>
                                                    </div>

                                                    <div class="collapsible-body blue-grey lighten-5">
                                                        <span><?php echo utf8_encode($dataCompe['tarea']);?> </span>
                                                    </div>
                                                </li>
                                            </ul>

                                            <!-- SECCIÓN DEL ENUNCIADO DE LA PREGUNTA -->
                                            <div class="card-panel ToolsticBlanco black-text">
                                                <span class="card-title left-align"><b>Enunciado de la pregunta</b></span> 
                                                <div class="TexEnunciado white black-text card-panel">
                                                    <?php echo $dataPA[$k]['enunciado_pregunta']; ?>
                                                </div> 
                                            
                                            <!-- SECCIÓN DE LAS OPCIONES DE RESPUESTA -->
                                                <br>
                                                <span class="card-title left-align">
                                                    <b>Opciones de respuesta</b>
                                                </span> <br>
                                                <?php
                                                    $DataRespu = ObtenerOpcionesRespuestas($dataPA[$k]['id_pregunta'], $conex);    
                                                    for($respu = 0; $respu < 4 ; $respu ++) { ?>
                                                

                                                <?php if($respu == 0){ ?>
                                                    <div class="chip ToolsticAzul accent-4 white-text left">
                                                        <b>Opción de respuesta No 1</b>
                                                    </div> 

                                                    
                                                    <a class="btn green white-text rigth">
                                                        <b>Peso de respuesta</b>
                                                    </a> 
                                                    <a class="btn green white-text rigth">
                                                        <b>
                                                            <?php echo $DataRespu[$respu]['peso_opcion_respuesta']; ?> %
                                                        </b>
                                                    </a>
                                                <?php } 
                                                 else if($respu == 1){ ?>
                                                    <div class="chip ToolsticAzul accent-4 white-text left">
                                                        <b>Opción de respuesta No 2</b>
                                                    </div>
                                                    <a class="btn blue white-text">
                                                        <b>Peso de respuesta</b>
                                                    </a> 
                                                    <a class="btn blue white-text">
                                                        <b>
                                                            <?php echo $DataRespu[$respu]['peso_opcion_respuesta']; ?> %
                                                        </b>
                                                    </a>
                                                <?php } 
                                                 else if($respu == 2){ ?>
                                                    <div class="chip ToolsticAzul accent-4 white-text left">
                                                        <b>Opción de respuesta No 3</b>
                                                    </div>
                                                    <a class="btn orange white-text">
                                                        <b>Peso de respuesta</b>
                                                    </a> 
                                                    <a class="btn orange white-text">
                                                        <b>
                                                            <?php echo $DataRespu[$respu]['peso_opcion_respuesta']; ?> %
                                                        </b>
                                                    </a>
                                                <?php } 
                                                else { ?>
                                                    <div class="chip ToolsticAzul accent-4 white-text left">
                                                        <b>Opción de respuesta No 4</b>
                                                    </div>
                                                    <a class="btn red white-text">
                                                        <b>Peso de respuesta</b>
                                                    </a> 
                                                    <a class="btn red white-text">
                                                        <b>
                                                            <?php echo $DataRespu[$respu]['peso_opcion_respuesta']; ?> %
                                                        </b>
                                                    </a>
                                                <?php } ?>


                                                <div class="TexEnunciado white black-text card-panel">
                                                    <?php echo $DataRespu[$respu]['opcion_respuesta'];?>
                                                </div>

                                                <br>

                                                <?php } //FIN FOR OPCIONES DE RESPUESTAS
                                                ?>                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>   <!-- FIN DIV izquierdo DE INFOMRAICON PREGUNTA --> 

                                    <div class="col s12 m12 l6">
                                        <div class="card-panel ToolsticBlanco large">
                                            <div class="card-content">  
                                                <div class="chip ToolsticAzul accent-4 white-text ">
                                                    <img src="./../../img/admin.gif" alt="Contact Person">
                                                    <b>Dar retroalimentación a pregunta</b>
                                                </div>                                                 
                                                <p>
                                                    <br>
                                                    Por favor complete la retroalimentación correspondiente a la pregunta, cambie el respectivo estado de la pregunta y digite las observaciones correspondientes.
                                                </p>                                                
                                                <br>
                                                <p>
                                                    <b>Retroalimentación para la regunta</b>
                                                    <a class="btn ToolsticAzul">
                                                        <?php echo $dataPA[$k]['cod_pregunta']; ?>
                                                    </a>
                                                </p>
                                                <br>
                                                <div class="row">
                                                <form class="col s12" method="POST" id="FPER_PRG_<?php echo $dataPA[$k]['id_pregunta'];?>">
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <select required id="FPER_SEP_<?php echo $dataPA[$k]['id_pregunta'];?>" class="validate"> 
                                                                <option value="1">Sin Validar</option>   
                                                                <option value="2">No aceptada</option>
                                                                <option value="3">Validada y por Corregir</option>
                                                                <option value="4">Validada y Aceptada</option> 
                                                            </select>
                                                            <label>Estado de la pregunta</label>             
                                                        </div>
                                                        
                                                        <div class="input-field col s12">
                                                            <textarea id="FPER_RETRO_<?php echo $dataPA[$k]['id_pregunta'];?>" class="materialize-textarea validate" placeholder="Retroalimentación de la pregunta" ></textarea>
                                                            <label for="textarea1">Observaciónes y/o comentarios</label>
                                                        </div>
                                                        
                                                        <button class="btn col s12 ToolsticAzul white-text" type="submit" onclick="GetIdPrgRetro(<?php echo $dataPA[$k]['id_pregunta'];?>)" name="action">Enviar retroalimentación
                                                            <i class="material-icons right">send</i>
                                                        </button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                            <div class="card-action right-align">
                                                <a class="btn-floating btn-large waves-effect waves-light red darken-3 modal-trigger tooltipped" data-position="bottom" data-tooltip="Ayuda para dar retroalimentación" href="#modalAyuda"><i class="large material-icons" style="font-size:2.2rem !important;">live_help</i></a>
                                            </div>
                                        </div>
                                        <?php if($dataPA[$k]['observaciones_validacion'] != "")  { ?>    
                                        <div class="card-panel ToolsticBlanco large">
                                            <span class="card-title">
                                                <b>Ultima retroalimentación enviada</b>
                                            </span> <hr>
                                            <br>
                                            <div class="row">
                                                <p style="text-align: justify">
                                                    <?php echo $dataPA[$k]['observaciones_validacion']; ?>
                                                </p>
                                            </div>
                                            <br>
                                            <div class="row right-align">
                                                <a class="btn ToolsticAzul">
                                                <?php  
                                                    $GetFODate = ObtenerFormatoFechaHora($dataPA[$k]['fecha_validacion']); 
                                                    echo $GetFODate['FO_Fecha']?>  
                                                </a>
                                                <a class="btn blue">
                                                    <?php echo $GetFODate['FO_Hora'];?>
                                                </a>
                                            </div>
                                            
                                            
                                        </div>
                                        <?php } // Fin coprobar si tiene retroalimen anteriores ?>

                                    </div>   <!-- FIN DIV DERECHO DE RETROALMINETACION PREGUNTA --> 

                                </div>    <!-- FIN DIV TEST# -->    
                                <?PHP } //FIN FOR TEST ?>             
                            </div> <!-- FIN CARD TABS CARD CONTENTS--> 
                            </div> <!-- FIN DIV CARD-CONTENT -->
                     </div> <!-- FIN DIV CARD -->
                        <?php  } //fin else si hay preguntas por validar?>
                    
            </div> <!-- FIN COL -->
        </div> <!-- FIN ROW -->
        
    <!-- MODAL AYUDA DE CONCEPTOS -->
    <div id="modalAyuda" class="modal modal-fixed-footer">
        <div class="modal-content container">
            <h4 class="center ToolsTic_Verde-text">Ayuda sobre la retroalimentación</h4>
            <p>
                Como docente experto temático tendrá la posibilidad de validar las preguntas realizadas por docentes del Módulo de Lenguaje y Herramientas Informáticas.                  
            </p>
            <p>    
                Para la formulación de las preguntas se aplicó la metodología denominada Modelo Basado en Evidencias (MBE) propuesta por el ICFES para el desarrollo de las pruebas SABER PRO con el fin de guiar, estructurar y fundamentar esta propuesta de manera más clara y precisa. 
            </p>
            <p>
                Esta metodología se refiere a un conjunto de procesos que parte de la identificación de las dimensiones de evaluación y descripción de las categorías que las conforman (en términos de procesos del sujeto y en aspectos disciplinares) hasta la definición de las tareas que debe desarrollar un estudiante en una evaluación, de manera que estas últimas se constituyan en evidencias que den cuenta de las competencias, los conocimientos o las habilidades que se quieren medir (Magisterio, 2016).
            </p>
                De este modo las preguntas son una descripción de los conocimientos, habilidades y destrezas (CHD) que las tareas miden y, representan el material de estímulo que pueden emplearse para que el evaluado exhiba el nivel que tiene de esos CHD (ICFES, 2018). 
            <p>
                Una vez la pregunta este completamente revisada y validada por el docente experto temático podrá y pasará a ser parte del banco de preguntas que serán utilizadas en la prueba de homologación del módulo de Lenguaje y Herramientas Informáticas.
            </p>
            
            <p>
                <div class="chip ToolsticAzul accent-4 white-text ">                    
                    <b>Observaciones y/o recomendaciones</b>
                </div> <br>                
                Usted podrá realizar observaciones a la pregunta con el propósito de mejorar su redacción, respuestas, peso de acierto en respuestas entre otras características que considere necesario; además, deberá actualizar el estado de la pregunta según corresponda:
                <br>
            </p>
                
                <h4 class="center ToolsTic_Verde-text">Estados aplicables a las preguntas</h4>           
                <br>
                <div class="row">
                    <div class="col s12 m3 center-align">
                        <div class="chip col s12 red darken-2 accent-4 white-text ">                    
                            <b>SIN VALIDAR</b>
                        </div>                
                    </div>
                    <div class="col s12 m9">
                        La pregunta aún no ha sido revisada por el docente experto temático, esta pregunta no está admitida para ser parte del banco de preguntas de la prueba de Homologación.
                    </div>
                </div>   
                
                <br>
                <div class="row">
                    <div class="col s12 m3 center-align">
                        <div class="chip col s12 grey darken-2 accent-4 white-text flow-text">                    
                            <b>NO ACEPTADA</b>
                        </div>                
                    </div>
                    <div class="col s12 m9">
                        La pregunta ha sido revisada por el docente experto temático y NO será admitida para ser parte del banco de preguntas de la prueba de homologación. Además, deberá reformularse por completo por no alcanzar el mínimo de aceptación.
                    </div>
                </div>  
                
                <br>
                <div class="row">
                    <div class="col s12 m3 center-align">
                        <div class="chip col s12 blue darken-2 accent-4 white-text flow-text">                    
                            <b>VALIDADA Y CORREGIR</b>
                        </div>                
                    </div>
                    <div class="col s12 m9">
                        La pregunta ha sido revisada por el docente experto temático, y dicha pregunta NO esta admitida para ser parte del banco de preguntas de la prueba de Homologación. Además, deberá reformularse de acuerdo a las observaciones y/o sugerencias presentadas por el docente experto temático. 
                    </div>
                </div>  

                <br>
                <div class="row">
                    <div class="col s12 m3 center-align">
                        <div class="chip col s12 ToolsticVerde darken-2 accent-4 white-text flow-text">                    
                            <b>VALIDADA Y ACEPTADA</b>
                        </div>                
                    </div>
                    <div class="col s12 m9">
                    La pregunta ha sido revisada por el docente experto temático y presenta una estructura correcta en su redacción y cumple con el objetivo de la tarea. Esta pregunta es admitida para ser parte del banco de preguntas de la prueba de homologación.
                    </div>
                </div> 
                      
            
            </div>
            <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat white-text red darken-2">Cerrar</a>
        </div>
</div>
        
        
    </main>
   
    <br><br>
    <?php include './../footer.php'; ?>
        
   

    <script src="../../js/materialize.js"></script> 
    <script src="../../js/sweetalert2.all.js"></script> 
    <script src="funciones.js"></script>   
    <script src="./js/DarRetroalimentacion.js"></script>
    <script src="./js/gra_preval.js"></script>
    
    <script>
        $(document).ready(function(){
            M.AutoInit();
            M.updateTextFields();
            Toast.fire({
              type: 'success',
              title: 'Todo listo'
            });
            
            mostrarDatos();
            agregaDatosEdicion(<?php echo $userlog['id_usuario']; ?>);

            GrafiPregunDocExperto(<?php echo $userlog['id_usuario']; ?>);
        });  
        
        
        
    </script>
    
      
    </body>
</html>