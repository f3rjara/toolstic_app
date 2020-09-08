<?php

$PruebasActivas = pruebasActive($conex);
$TotalPruebas = sizeof($PruebasActivas);                        

?>
          
          
<div class='row'>
    <div class='col s12 center'>
        <i class='material-icons large'>person_pin</i><br>
        <h5><b><?php echo $EstudianteReload['nombres_estudiante'] ." ". $EstudianteReload['apellidos_estudiante'];?></b></h5>
        <h6><b id="CodEstuPruebas"><?php echo $EstudianteReload['cod_estudiante'];?></b></h6> <br>

        <div class='chip ToolsTic_Verde white-text'>
            <span><b>Estudiante habilitado</b></span>
        </div>

        <div class='chip red white-text'>
            <span><b>Estudiante no inscrito</b></span>
        </div>

    </div>
</div> 

<div class='row'>
    <div class='progress'>
        <div class='indeterminate'></div>
    </div> <br>
</div>

                          
<div class="row">
    <?php
    for($i = 0; $i < $TotalPruebas; $i++){ 
        $fechaAplicacion = strftime("%d de %b del %Y",strtotime($PruebasActivas[$i]['fecha_aplicacion_prueba']));
        $fechaLimiteInsc = strftime("%d de %b del %Y",strtotime($PruebasActivas[$i]['fecha_inscripcion_prueba']));

        ?>
        <div class="col s12 m12 l6 xl6 ">
            <div class="card-panel">
                <div class="card-content black-text">

                    <div class="row">
                        <i class='material-icons large'>assistant</i><br>
                        <h5><b><?php echo $PruebasActivas[$i]['prueba'];?></b></h5>
                        <div class='chip <?php echo $PruebasActivas[$i]['bgcolor_estado_prueba']; ?> white-text'>
                            <span><b><?php echo strtoupper($PruebasActivas[$i]['estado_prueba']); ?></b></span>
                        </div>
                    </div>
                    <br>
                    <div class="row">

                        <div class='input-field col s10 push-s1'>
                            <i class='material-icons prefix'>date_range</i>
                            <input id='FechaAplicacion' type='text' class='validate infoEstu' disabled value='<?php echo ($fechaAplicacion);?>'>
                            <label for='FechaAplicacion' class="labelInfo">Fecha de aplicación de la prueba</label>
                        </div>

                        <div class='input-field col s10 push-s1'>
                            <i class='material-icons prefix'>timelapse</i>
                            <input id='PeriodoPerueba' type='text' class='validate infoEstu' disabled value='<?php echo utf8_decode($PruebasActivas[$i]['periodo'])." - ".utf8_decode($PruebasActivas[$i]['year_periodo']);?>'>
                            <label for='PeriodoPerueba' class="labelInfo">Periodo</label>
                        </div>



                        <div class='input-field col s10 push-s1'>
                            <i class='material-icons prefix'>location_on</i>
                            <input id='SedePrueba' type='text' class='validate infoEstu' disabled value='<?php echo utf8_encode($PruebasActivas[$i]['sede']);?>'>
                            <label for='SedePrueba' class="labelInfo">Sede</label>
                        </div> 
                        
                        <div class='input-field col s10 push-s1'>
                            <i class='material-icons prefix'>map</i>
                            <input id='LugarSede' type='text' class='validate infoEstu' disabled value='<?php echo ($PruebasActivas[$i]['lugar_sede']);?>'>
                            <label for='LugarSede' class="labelInfo">Lugar de presentación</label>
                        </div>
                        
                        <div class='input-field col s10 push-s1'>
                            <i class='material-icons prefix'>date_range</i>
                            <input id='FechaLimiteInsc' type='text' class='validate infoEstu' disabled value='<?php echo ($fechaLimiteInsc);?>'>
                            <label for='FechaLimiteInsc' style="color: red !important;" class="labelInfo "><b>Fecha límite de inscripción</b></label>
                        </div>

                    </div>

                </div>
                
                <div class="card-action black-text">
                    <?php
                        $resultComprueba = CompruebaFechaInscripcion($conex, $PruebasActivas[$i]['id_prueba']);

                        if(($PruebasActivas[$i]['id_estado_prueba'] == 2) AND $resultComprueba == "true"){  
                    ?>                    
                        <a class="green btn"  onclick="MostrarGrupo(<?php echo $PruebasActivas[$i]['id_prueba'];?>)">
                            <i class="material-icons right">send</i>
                            inscribirse a esta prueba
                        </a> 
                    <?php
                    }
                    else
                    { ?>
                        <a class="grey btn" disabled>
                            <i class="material-icons right">send</i>Inscripciones no disponibles</a>
                    <?php }                                    
                    ?>
                </div>
            </div>
        </div> 
    <?php } ?>
</div>


<div class="row">
    <div id="SelectGrupo" class="row">
        <div class="col s12 m10 push-m1">
            <div class="card-panel">
                <div class="row left-align">
                    <div class='chip ToolsTic_Verde white-text'>
                        <span><b>Seleccione grupo para finalizar la inscripción</b></span>
                    </div>
                </div>
                <br>
                <div class="row center-align">
                    <div class='input-field col s12 m6 push-m3'>
                        <i class='material-icons prefix'>language</i>
                        <input id='NamePrueba' type='text' class='validate infoEstu' disabled value='Prueba de homologación'>
                        <label for='NamePrueba' class="labelInfo">Prueba</label>
                    </div>
                </div>
                
                <div class="row">
                    <span>Seleccione el grupo y horario de acuerdo a los cupos disponibles</span>
                    <hr>
                </div>

                <div class="row">
                    <form method="POST" id="FormGrupos" >
                        <div class="row">
                            <table class="container centered">
                                <thead>
                                <tr>
                                    <th width="20%"><i class="material-icons">check</i></th>
                                    <th width="20%">Grupo</th>
                                    <th width="20%">Aula</th>
                                    <th width="20%">Hora</th>
                                    <th width="20%">Cupos disponibles</th>
                                </tr>
                                </thead>

                                <tbody id="GruposPrueba">
                                    <!-- AQUI SE CONSULTA LOS DATOS -->
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="row" >
                            <button class="ToolsTicAzul btn btn-large white-text" type="submit" name="action" disabled id="BtnRealizarInscripcion" >
                                Realizar Inscripción  
                                <i class="material-icons right">send</i>
                            </button>
                        </div>                        
                    </form>
                </div>
                
            </div>
            <br>
        </div>
    </div>
</div>
