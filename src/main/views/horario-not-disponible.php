<?php
   
    $FullDataInsc = FullDataInscEstu($conex, $EstudianteReload['cod_estudiante']);
    
    $fechaAplicacion = strftime("%d de %b del %Y",strtotime($FullDataInsc['fecha_aplicacion_prueba']));

    list($fechaIN, $horaIN) = explode(" ",$FullDataInsc['fecha_inscripcion']);
                            
    $fechaInscripcion = strftime("%d de %b del %Y",strtotime($fechaIN));
    $horaInscripcion = strftime("%I:%M:%S %p",strtotime($horaIN));

    
?>
<div class='row'>
    <div class='col s12 center'>
        <i class='material-icons large'>person_pin</i><br>
        <h5><b><?php echo $EstudianteReload['nombres_estudiante'] ." ". $EstudianteReload['apellidos_estudiante'];?></b></h5>
        <h6><b id="CodEstuPruebas"><?php echo $EstudianteReload['cod_estudiante'];?></b></h6> <br>

        <div class='chip ToolsTic_Verde white-text'>
            <span><b>Estudiante habilitado</b></span>
        </div>

        <div class='chip ToolsTic_Verde white-text'>
            <span><b>Estudiante inscrito</b></span>
        </div>

        <div class='chip green white-text'>
            <span><b>prueba disponible</b></span>
        </div>

        <div class='chip orange white-text'>
            <span><b>Horario no disponible</b></span>
        </div>

        <!--
        <div class='chip red white-text'>
            <span><b>Cuestionario no presentado</b></span>
        </div>
        -->
    </div>
</div> 

<div class='row'>
    <div class='progress'>
        <div class='indeterminate'></div>
    </div> <br>
</div>

<div class='row'>
    <div class="col s12 m12 center">
        <div class='chip orange white-text'>
            <span><b>HORARIO NO DISPONIBLE</b></span>
        </div> 
        <div class='chip ToolsTic_blue white-text'>
            <span><b>Tenga muy presente la fecha y hora para presentar el cuestionario.</b></span>
        </div> 
    </div>
    <br><br>
</div>
 <br>

<div class='row'>

    <div class="col s12 m12 left-align">
        <div class='chip ToolsTic_blue white-text'>
            <span><b>Información de la Prueba</b></span>
        </div> 
    </div>
    <br><br>
    
    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>language</i>
        <input id='PruebaEstu' type='text' class='validate infoEstu' disabled value='<?php echo utf8_decode($FullDataInsc['prueba']);?>'>
        <label for='PruebaEstu' class="labelInfo">Prueba</label>
    </div>

    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>timelapse</i>
        <input id='PeriodoPerueba' type='text' class='validate infoEstu' disabled value='<?php echo utf8_decode($FullDataInsc['periodo'])." - ".utf8_decode($FullDataInsc['year_periodo']);?>'>
        <label for='PeriodoPerueba' class="labelInfo">Periodo</label>
    </div>

    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>date_range</i>
        <input id='FechaAplicacion' type='text' class='validate infoEstu' disabled value='<?php echo ($fechaAplicacion);?>'>
        <label for='FechaAplicacion' class="labelInfo">Fecha de aplicación de la prueba</label>
    </div>

    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>watch_later</i>
        <input id='HoraPrueba' type='text' class='validate infoEstu' disabled value='<?php echo ($FullDataInsc['horario_grupo']);?>'>
        <label for='HoraPrueba' class="labelInfo">Hora de presentación</label>
    </div>


    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>location_on</i>
        <input id='SedePrueba' type='text' class='validate infoEstu' disabled value='<?php echo utf8_decode($FullDataInsc['sede']);?>'>
        <label for='SedePrueba' class="labelInfo">Sede</label>
    </div>                        

    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>map</i>
        <input id='LugarSede' type='text' class='validate infoEstu' disabled value='<?php echo ($FullDataInsc['lugar_sede']);?>'>
        <label for='LugarSede' class="labelInfo">Lugar de presentación</label>
    </div>

    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>supervisor_account</i>
        <input id='GrupoEstu' type='text' class='validate infoEstu' disabled value='<?php echo ($FullDataInsc['grupo']);?>'>
        <label for='GrupoEstu' class="labelInfo">Grupo inscrito</label>
    </div>

    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>location_searching</i>
        <input id='AulaPrueba' type='text' class='validate infoEstu' disabled value='<?php echo "Aula - ".($FullDataInsc['aula_grupo']);?>'>
        <label for='AulaPrueba' class="labelInfo">Aula de presentación</label>
    </div>

    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>announcement</i>
        <input id='AulaPrueba' type='text' class='validate infoEstu' disabled value='<?php echo ($FullDataInsc['estado_prueba']);?>'>
        <label for='AulaPrueba' class="labelInfo">Estado de la prueba</label>
    </div>   
    
</div> 

  

<div class="row">    
    <div class="col s12 m12 left-align">
        <div class='chip ToolsTic_blue white-text'>
            <span><b>Detalle de la inscripción</b></span>
        </div> 
    </div>    <br>

    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>supervisor_account</i>
        <input id='GrupoEstu' type='text' class='validate infoEstu' disabled value='<?php echo ($FullDataInsc['grupo']);?>'>
        <label for='GrupoEstu' class="labelInfo">Grupo inscrito</label>
    </div>


    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>date_range</i>
        <input id='FechaInscripcion' type='text' class='validate infoEstu' disabled value='<?php echo ($fechaInscripcion." a las ". 
    $horaInscripcion);?>'>
        <label for='FechaInscripcion' class="labelInfo">Fecha de inscripción del estudiante</label>
    </div>            
       
</div>

<div class="row">
    <div class="col s12 m4 push-m8">          
        <div class='input-field col s12 m12 center'>
            <a href='<?php echo ROOT_MEDIA_USER;?>/student/pruebas.php' class='ToolsTic_Verde btn btn-large col s12'>
                <i class='material-icons right'>send</i>
                Consultar inscripción
            </a>
        </div>
    </div>
</div>