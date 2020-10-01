
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

        <div class='chip ToolsTic_Verde white-text'>
            <span><b>Resultados disponibles</b></span>
        </div>
        
        <div class='chip ToolsTic_Verde white-text'>
            <span><b>Cuestionario presentado</b></span>
        </div>

        

    </div>
</div> 

<div class='row'>
    <div class='progress'>
        <div class='indeterminate'></div>
    </div> <br>
</div>

<div class='row' style = 'margin-top: 2rem;  margin-bottom: 5rem;'>


    <div class="col s12 m12 l10 push-l1">

        <?php
            list($fechaIniCues, $horaIniCues) = explode(" ",$ResultCuestEstu['inicio_cuestionario']);
                                    
            $fechaInicioCues = strftime("%d de %b del %Y",strtotime($fechaIniCues));
            $horaInicioCues = strftime("%I:%M:%S %p",strtotime($horaIniCues));


            list($fechaFinCues, $horaFinCues) = explode(" ",$ResultCuestEstu['fin_cuestionario']);
                                    
            $fechaFinCuestionario = strftime("%d de %b del %Y",strtotime($fechaFinCues));
            $horaFinCuestionario = strftime("%I:%M:%S %p",strtotime($horaFinCues));


        ?>

        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>date_range</i>
            <input id='InicioCuestionario' type='text' class='validate infoEstu' disabled value='<?php echo $fechaInicioCues." a las ".$horaInicioCues;?>'>
            <label for='InicioCuestionario'>Inicio del cuestionario</label>
        </div>                            

        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>date_range</i>
            <input id='FinCuestionario' type='text' class='validate infoEstu' disabled value='<?php echo $fechaFinCuestionario." a las ".$horaFinCuestionario;?>'>
            <label for='FinCuestionario'>Fin del cuestionario</label>
        </div>
        
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input id='EstadoCuestionario' type='text' class='validate infoEstu' disabled value='<?php echo $ResultCuestEstu['estado_cuestionario'];?>'>
            <label for='EstadoCuestionario'>Estado cuestionario</label>
        </div>

        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>graphic_eq</i>
            <input id='PuntajeObtenido' type='text' class='validate infoEstu' disabled value='<?php echo $ResultCuestEstu['puntaje_final'] ." / 5";?>'>
            <label for='PuntajeObtenido'>Puntaje final obtenido</label>
        </div>

        <div class='input-field col s12 m12 center'>
            <a href='<?php echo ROOT_MEDIA_USER;?>/student/resultados.php' class='ToolsticAzulC btn'>
                <i class='material-icons right'>poll</i>
                ver resultados detallados</a>
        </div>

    </div>

    
</div>