<?php
   
    $FullDataInsc = FullDataInscEstu($conex, $EstudianteReload['cod_estudiante']);  
    $DataStudentPrg = DatosEstudianteFull($conex, $EstudianteReload['cod_estudiante']) ; 
        
    list($fechaIN, $horaIN) = explode(" ",$FullDataInsc['fecha_inscripcion']);
    $fechaInscripcion = strftime("%d de %b del %Y",strtotime($fechaIN));
    $horaInscripcion = strftime("%I:%M:%S %p",strtotime($horaIN));
    
    $dataReport = new stdClass();
    // DATOS ESTUDIANTE
    $dataReport->documento_estudiante =  utf8_decode($EstudianteReload['tipo_documento'])." : ".utf8_decode($EstudianteReload['num_documento']);    
    $dataReport->codigo_estudiante = $EstudianteReload['cod_estudiante'];
    $dataReport->nombre_completo = $EstudianteReload['nombres_estudiante'] ." ". $EstudianteReload['apellidos_estudiante'];
    $dataReport->correo = utf8_decode($EstudianteReload['correo_estudiante']);
    $dataReport->programa = utf8_decode($DataStudentPrg['programa']);
    $dataReport->semestre = $EstudianteReload['semestre_estudiante'];;
    //INFORMACION DE LA PRUEBA
    $dataReport->prueba = utf8_decode($FullDataInsc['prueba']);
    $dataReport->periodo_aplicacion = utf8_decode($FullDataInsc['periodo'])." - ".utf8_decode($FullDataInsc['year_periodo']);
    $dataReport->fecha_aplicacion = strftime("%d de %b del %Y",strtotime($FullDataInsc['fecha_aplicacion_prueba']));
    $dataReport->hora_aplicacion = ($FullDataInsc['horario_grupo']);
    $dataReport->sede_aplicacion = utf8_decode($FullDataInsc['sede']);
    $dataReport->lugar_presentacion = ($FullDataInsc['lugar_sede']);
    // DETALLE DE LA INSCRIPCIÓN
    $dataReport->grupo_inscripcion = ($FullDataInsc['grupo']);
    $dataReport->fecha_inscripcion = ($fechaInscripcion." a las ".$horaInscripcion);
    $dataReport->aula_presentacion = "Aula - ".($FullDataInsc['aula_grupo']);
    $dataReport->estado_prueba = ($FullDataInsc['estado_prueba']);
    
?>
<div class='row'>
    <div class='col s12 center'>
        <i class='material-icons large'>person_pin</i><br>
        <h5><b><?php echo $dataReport->nombre_completo ?></b></h5>
        <h6><b id="CodEstuPruebas"><?php echo $dataReport->codigo_estudiante ?></b></h6> <br>

        <div class='chip ToolsTic_Verde white-text'>
            <span><b>Estudiante habilitado</b></span>
        </div>

        <div class='chip ToolsTic_Verde white-text'>
            <span><b>Estudiante inscrito</b></span>
        </div>

    </div>
</div> 

<div class='row'>
    <div class='progress'>
        <div class='indeterminate'></div>
    </div> <br>
</div>

<div class='row'>

    <div class="col s12 m12 left-align">
        <div class='chip ToolsTic_blue white-text'>
            <span><b>Información de la Prueba</b></span>
        </div> 
    </div>
    <br><br>
    
    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>language</i>
        <input id='PruebaEstu' type='text' class='validate infoEstu' disabled value='<?php echo $dataReport->prueba ?>'>
        <label for='PruebaEstu' class="labelInfo">Prueba</label>
    </div>

    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>timelapse</i>
        <input id='PeriodoPerueba' type='text' class='validate infoEstu' disabled value='<?php echo $dataReport->periodo_aplicacion; ?>'>
        <label for='PeriodoPerueba' class="labelInfo">Periodo</label>
    </div>

    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>date_range</i>
        <input id='FechaAplicacion' type='text' class='validate infoEstu' disabled value='<?php echo $dataReport->fecha_aplicacion; ?>'>
        <label for='FechaAplicacion' class="labelInfo">Fecha de aplicación de la prueba</label>
    </div>

    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>watch_later</i>
        <input id='HoraPrueba' type='text' class='validate infoEstu' disabled value='<?php echo $dataReport->hora_aplicacion; ?>'>
        <label for='HoraPrueba' class="labelInfo">Hora de presentación</label>
    </div>

    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>location_on</i>
        <input id='SedePrueba' type='text' class='validate infoEstu' disabled value='<?php echo $dataReport->sede_aplicacion;?>'>
        <label for='SedePrueba' class="labelInfo">Sede</label>
    </div>                        

    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>map</i>
        <input id='LugarSede' type='text' class='validate infoEstu' disabled value='<?php echo $dataReport->lugar_presentacion;?>'>
        <label for='LugarSede' class="labelInfo">Lugar de presentación</label>
    </div>
    
</div> 

<div class="row">    
    <div class="col s12 m12 left-align">
        <div class='chip ToolsTic_blue white-text'>
            <span><b>Detalle de la inscripción</b></span>
        </div> 
    </div><br>

    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>supervisor_account</i>
        <input id='GrupoEstu' type='text' class='validate infoEstu' disabled value='<?php echo $dataReport->grupo_inscripcion;?>'>
        <label for='GrupoEstu' class="labelInfo">Grupo inscrito</label>
    </div>

    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>date_range</i>
        <input id='FechaInscripcion' type='text' class='validate infoEstu' disabled value='<?php echo $dataReport->fecha_inscripcion;?>'>
        <label for='FechaInscripcion' class="labelInfo">Fecha de inscripción del estudiante</label>
    </div>   

    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>location_searching</i>
        <input id='AulaPrueba' type='text' class='validate infoEstu' disabled value='<?php echo $dataReport->aula_presentacion;?>'>
        <label for='AulaPrueba' class="labelInfo">Aula de presentación</label>
    </div>

    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>announcement</i>
        <input id='EstadoPrueba' type='text' class='validate infoEstu' disabled value='<?php echo $dataReport->estado_prueba;?>'>
        <label for='EstadoPrueba' class="labelInfo">Estado de la prueba</label>
    </div>         
</div>

<div class="row">
    <div class="col s12 m4 push-m8">
        <?php  
            $FechaHoy = ObtenerDateTime();
            date_default_timezone_set('America/Bogota');            
            $Faplica = new DateTime($FullDataInsc['fecha_aplicacion_prueba']);
            $Fhoy = new DateTime($FechaHoy['fecha']);            
            $diff = $Faplica->diff($Fhoy);

            if($FullDataInsc['estado_prueba'] == "Activo" && $Fhoy <= $Faplica  && $diff->days > 1) { ?>           

                <div class='input-field col s12 m12 center'>
                    <a class="btn btn-large red col s12" onclick="cancelaInscripcion(<?php echo $FullDataInsc['id_inscripcion_prueba']; ?>,<?php echo $FullDataInsc['id_grupo']; ?>)" >
                            <i class='material-icons right'>cancel</i>
                            CANCELAR INSCRIPCIÓN
                    </a>
                </div>

        <?php } else { ?>

            <div class='input-field col s12 m12 center'>
                <a target="_blank" class='grey lighten-3 grey-text  text-darken-2 btn btn-large  col s12 tooltipped' data-position="bottom" data-tooltip="Solo es posible cancelar 3 días antes de la aplicación de la prueba">
                    <i class='material-icons right'>cancel</i>
                    CANCELAR INSCRIPCIÓN
                </a>
            </div>

        <?php } ?>        
        <?php  $sendReport = str_replace('"', "'", json_encode($dataReport)); ?>

        <div class='input-field col s12 m12 center'>
            <a  target="_blank" id="BtnGenerateReport" class='ToolsTic_Verde btn btn-large col s12' 
                onclick="generatereport(<?php echo $sendReport; ?>)"  >
                <i class='material-icons right'>picture_as_pdf</i>
                Generar reporte
            </a>
        </div>

    </div> 
</div>