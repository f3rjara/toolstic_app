<div class="row">
    <div class="col s12">
        <ul class="collapsible">
            <li>
                <div class="collapsible-header ToolsticBlanco">
                    <i class="material-icons">description</i>
                    <span><b>Mis preguntas</b></span>
                </div>
                <div class="collapsible-body">
                    
                    <div class="row center">
                        <table class="centered highlight responsive-table">
                            <thead>
                                <tr>
                                    <th width="2%">No</th>
                                    <th width="13%">Cod. Pregunta</th>
                                    <th width="49%">Competencia</th>
                                    <th width="21%">Estado Pregunta</th>
                                    <th width="5%">Visualizar</th>
                                    <th width="5%">Editar</th>
                                    <th width="5%">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?PHP                      

                                $SqlMisPreguntas = "SELECT pregunta.*, estado_pregunta.*, competencia.id_competencia FROM pregunta, estado_pregunta, tarea, evidencia, competencia WHERE pregunta.creador_pregunta = '".$userlog['id_usuario']."' AND pregunta.id_estado_pregunta = estado_pregunta.id_estado_pregunta AND pregunta.id_estado_pregunta != 6 AND tarea.id_tarea = pregunta.id_tarea AND tarea.id_evidencia = evidencia.id_evidencia AND evidencia.id_competencia = competencia.id_competencia ORDER BY competencia.id_competencia ASC, pregunta.id_estado_pregunta";

                                $resultSQL = $conex->query($SqlMisPreguntas);

                                if($resultSQL->num_rows > 0){
                                    $cuenta = 0;
                                    while($MisPrg = $resultSQL->fetch_assoc()) {
                                        $cuenta ++;
                                        $datacomp = ObtenerCompetenciaPrg($MisPrg['id_pregunta'], $conex);
                                     ?>

                                <tr>
                                    <td><?php echo $cuenta; ?></td>
                                    <td>
                                        <a class="btn ToolsticAzul">
                                            <?php echo $MisPrg['cod_pregunta']; ?>
                                        </a>
                                    </td>
                                    <td><?php echo utf8_encode($datacomp['competencia']); ?></td>
                                    <td class="left">
                                        <a
                                            class="btn <?php echo $MisPrg['bgcolor_estado_pregunta']; ?>"><b><?php echo $MisPrg['estado_pregunta']; ?></b></a>
                                    </td>
                                    <td>
                                        <a class="modal-trigger"
                                            href="#VerPregunta<?php echo $MisPrg['id_pregunta']; ?>">
                                            <b><i class="material-icons black-text">remove_red_eye</i></b>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="modal-trigger"
                                            href="./editar-prg.php?pd=<?php echo $MisPrg['id_pregunta'];?>&has=<?php echo md5($userlog['id_usuario']);?>">
                                            <b><i class="material-icons blue-text">create</i></b>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn_elimina"
                                            onclick="DeletePrg(<?php echo $MisPrg['id_pregunta']; ?>)">
                                            <b><i class="material-icons red-text">delete</i></b>
                                        </a>
                                    </td>
                                </tr>

                                <!-- MODAL VER PREGUNTA -->
                                <div id="VerPregunta<?php echo $MisPrg['id_pregunta'];?>"
                                    class="modal modal-fixed-footer">
                                    <div class="modal-content">
                                        <div class="row">
                                            <div class="col s12 m6 center">
                                                <b>Código Pregunta:</b>
                                                <a
                                                    class="btn ToolsticAzul white-text"><?php echo $MisPrg['cod_pregunta']; ?></a>
                                            </div>
                                            <div class="col s12 m6 center">
                                                <a
                                                    class="btn <?php echo $MisPrg['bgcolor_estado_pregunta']; ?> white-text"><?php echo $MisPrg['estado_pregunta']; ?></a>
                                            </div>
                                            <br>
                                        </div>

                                        <div class="row">
                                            <br>
                                            <ul class="collapsible">
                                                <li>
                                                    <div class="collapsible-header">
                                                        <i class="material-icons">bookmark</i>
                                                        <span><b><?php echo utf8_encode($datacomp['competencia']); ?></b></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header">
                                                        <i class="material-icons">description</i>
                                                        <span><b>EVIDENCIA</b></span>
                                                    </div>

                                                    <div class="collapsible-body">
                                                        <span><?php echo utf8_encode($datacomp['evidencia']); ?></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="collapsible-header">
                                                        <i class="material-icons">import_contacts</i>
                                                        <span><b>TAREA</b></span>
                                                    </div>

                                                    <div class="collapsible-body">
                                                        <span><?php echo utf8_encode($datacomp['tarea']); ?></span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="row">
                                            <br>
                                            <label>Enunciado de la pregunta</label>
                                            <hr>
                                            <div class="TexEnunciado white black-text card-panel">
                                                <?php echo $MisPrg['enunciado_pregunta'];?>
                                            </div>
                                            <?php
                    //Se obtienen las respuestas de la pregunta seleccionada
                        $IdPreg = $MisPrg['id_pregunta'];                   
                        $OpcionesRespuesta = ObtenerOpcionesRespuestas($IdPreg, $conex);  
                        for($i=0;$i < 4;$i++){                        
                    ?>
                                            <br>
                                            <label>Opción de respuesta No <?php echo ($i + 1); ?></label>
                                            <hr>
                                            <?php 
                            switch ($i) {
                                case 0:
                                    echo '<a class="btn green white-text"><b>Peso de respuesta</b></a> 
                                            <a class="btn green white-text">
                                                <b>'.$OpcionesRespuesta[$i]["peso_opcion_respuesta"].' %</b>
                                            </a> ';
                                    break;
                                case 1:
                                    echo '<a class="btn blue white-text"><b>Peso de respuesta</b></a> 
                                            <a class="btn blue white-text">
                                            <b>'.$OpcionesRespuesta[$i]["peso_opcion_respuesta"].' %</b>
                                            </a> ';
                                    break;
                                case 2:
                                        echo '<a class="btn orange  white-text"><b>Peso de respuesta</b></a> 
                                        <a class="btn orange white-text">
                                        <b>'.$OpcionesRespuesta[$i]["peso_opcion_respuesta"].' %</b>
                                        </a> ';
                                    break;

                                case 3:
                                    echo '<a class="btn red  white-text"><b>Peso de respuesta</b></a> 
                                    <a class="btn red white-text">
                                        <b>'.$OpcionesRespuesta[$i]["peso_opcion_respuesta"].' %</b>
                                    </a> ';
                                break;
                            }
                        ?>
                                            <div class="TexEnunciado white black-text card-panel">
                                                <?php                                                 
                                echo $OpcionesRespuesta[$i]['opcion_respuesta'];  
                            ?>
                                            </div>
                                            <?php                    
                        };
                    ?>

                                        </div>

                                        <div class="row">
                                            <br>
                                            <label>Creada el: <b>
                                                    <?php                    
                        echo strftime("%d de %b del %Y, %I:%M:%S %p",strtotime($MisPrg['fecha_creacion_pregunta']));
                        
                        ?>
                                                </b></label> <br>
                                            <label>Creada por:
                                                <b><?php echo $userlog['nombres_usuario']." ".$userlog['apellidos_usuario'] ?></b></label>
                                            <br>
                                            <hr>
                                            <?php 
                        if($MisPrg['validador_pregunta'] === null || $MisPrg['validador_pregunta'] ==""){
                            echo "<a class='btn red'><b>La pregunta aún no se asigna a ningún docente experto temático para su revisión.</b></a>";
                        }
                        else {
                            $dataDocET = DataDocentesET($conex,$MisPrg['validador_pregunta']);  

                            echo "<p>La pregunta fue asignada al docente experto temático: <a class='btn green'><b>".$dataDocET[0]['nombres_usuario']."  ".$dataDocET[0]['apellidos_usuario']."</b></a></p>";

                            
                           
                            if($MisPrg['observaciones_validacion'] === null || $MisPrg['observaciones_validacion'] ==""){
                                echo "<a class='btn red'><b>Aún no se han realizado observaciones por parte del docente experto temático</b></a>";
                            }
                            else {
                                $GetFODate = ObtenerFormatoFechaHora($MisPrg['fecha_validacion']); 
                                echo "<div class='TexEnunciado white black-text card-panel'><span class='left'><b>Retroalimentación por parte del docente</b></span> <br><p>".$MisPrg['observaciones_validacion']."</p> <span class='right'> Ultimá retoalimentación:    <b>".$GetFODate['FO_Fecha']." a las ".$GetFODate['FO_Hora']."</b></span></div>";
                            }
                        }                         
                    
                    ?>
                                            <br>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#!" class="modal-close red white-text btn-flat">Cerrar</a>
                                    </div>
                                </div>
                                <!-- FIN DEL MODAL MODAL VER PREGUNTA -->

                                <?php } }
        else { ?>                                
            <td colspan="7">
                <img src="./../../img/sin_datos.svg" width="10%"> <br>
                <a class="btn ToolsticAzul">Aún no tienes preguntas realizadas</a>
            </td>  
        <?php } ?>


                            </tbody>
                        </table>
                    </div>

                </div>
            </li>
        </ul>
    </div>
</div>