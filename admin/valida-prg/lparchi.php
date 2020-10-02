<?PHP
$SqlMisPreguntas = "SELECT * FROM pregunta, estado_pregunta WHERE pregunta.creador_pregunta = '".$userlog['id_usuario']."' AND pregunta.id_estado_pregunta = estado_pregunta.id_estado_pregunta AND pregunta.id_estado_pregunta = 6 ";

$resultSQL = $conex->query($SqlMisPreguntas);

if($resultSQL->num_rows > 0){
    $cuenta = 0;
?>
<div class="row">
    <div class="col s12">
        <ul class="collapsible">
            <li>
                <div class="collapsible-header ToolsticBlanco">
                    <i class="material-icons">assignment_late</i>
                    Preguntas archivadas
                </div>
                <div class="collapsible-body">
                    <div class="row">
                        <table class="highlight responsive-table">
                            <thead >
                                <tr>
                                    <th width="4%">No</th>
                                    <th width="18%">Cod. Pregunta</th>
                                    <th width="54%">Competencia</th>
                                    <th width="20%">Estado Pregunta</th>
                                    <th width="5%">Visualizar</th>                                    
                                </tr>
                            </thead>
                            <tbody >
                                <?PHP                                 
                                    while($MisPrg = $resultSQL->fetch_assoc()) {
                                        $cuenta ++;
                                        $datacomp = ObtenerCompetenciaPrg($MisPrg['id_pregunta'], $conex);
                                        ?>
                                    
                                    <tr>
                                    <td><?php echo $cuenta; ?></td>
                                    <td><?php echo $MisPrg['cod_pregunta']; ?></td>
                                    <td><?php echo utf8_encode($datacomp['competencia']); ?></td>
                                    <td >
                                        <a class="btn <?php echo $MisPrg['bgcolor_estado_pregunta']; ?>"><b><?php echo $MisPrg['estado_pregunta']; ?></b></a>
                                    </td>
                                    <td>
                                        <a class="modal-trigger" href="#VerPregunta<?php echo $MisPrg['id_pregunta']; ?>">
                                            <b><i class="material-icons black-text">remove_red_eye</i></b>
                                        </a>
                                    </td>                                    
                                </tr>

                                <!-- MODAL VER PREGUNTA -->
                                <div id="VerPregunta<?php echo $MisPrg['id_pregunta'];?>" class="modal modal-fixed-footer">
                                    <div class="modal-content">
                                        <div class="row">
                                            <div class="col s12 m6 center">
                                                <b>Código Pregunta:</b>
                                                <a class="btn ToolsticAzul white-text"><?php echo $MisPrg['cod_pregunta']; ?></a>
                                            </div>
                                            <div class="col s12 m6 center">                    
                                                <a class="btn <?php echo $MisPrg['bgcolor_estado_pregunta']; ?> white-text"><?php echo $MisPrg['estado_pregunta']; ?></a>    
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
                                            <label>Enunciado de la pregunta</label> <hr>
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
                                                <label>Opción de respuesta No <?php echo ($i + 1); ?></label> <hr>
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
                                            <label>Creada por: <b><?php echo $userlog['nombres_usuario']." ".$userlog['apellidos_usuario'] ?></b></label> <br>
                                            <hr>
                                            <?php 
                                                if($MisPrg['validador_pregunta'] === null || $MisPrg['validador_pregunta'] ==""){
                                                    echo "<a class='btn red'><b>La pregunta no podrá ser asignada</b></a>";
                                                }
                                                else {
                                                    echo "<p>Pregunta fue asignada al Docente Experto Temático: <a class='btn green'><b>".$MisPrg['validador_pregunta']."</b></a></p>";
                                                    echo "<br>";
                                                    if($MisPrg['observaciones_validacion'] === null || $MisPrg['observaciones_validacion'] ==""){
                                                        echo "<a class='btn red'><b>Aún no se han realizado observaciones por parte del Docente Experto Temático</b></a>";
                                                    }
                                                    else {
                                                        echo "<div class='TexEnunciado white black-text card-panel'><label>".$MisPrg['observaciones_validacion']."</label> </div>";
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

                                <?php } //FIN DEL WHILE
                                
                                ?>
                                        

                            </tbody>
                        </table>
                    </div> 
                </div>
            </li>
        </ul>
                        
    </div>
</div>
<?PHP } //fin del if
else{
    echo "<br>";
};  ?>