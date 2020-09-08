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

        <div class='chip green white-text'>
            <span><b>Cuestionario disponible</b></span>
        </div>

        <div class='chip orange white-text'>
            <span><b>Cuestionario en curso</b></span>
        </div>

    </div>
</div> 

<div class='row'>
    <div class='progress'>
        <div class='indeterminate'></div>
    </div> <br>
</div>

