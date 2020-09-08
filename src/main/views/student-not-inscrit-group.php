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


<div class='row'>
    <div class="col s12 m12 center">
        <div class='chip ToolsTic_blue white-text'>
            <span><b>Puede consultar si hay inscripciones activas</b></span>
        </div> 
    </div>
    <br><br>
</div>

<br>
<div class="row">
    <div class='center'>
        <a href='<?php echo ROOT_MEDIA_USER;?>/student/pruebas.php' class='green btn'>
            <i class='material-icons right'>send</i>
            Inscribirse a una prueba
        </a>
    </div>
</div>