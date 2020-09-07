 <!-- ********* INTRUCCION AL EXAMEN  INFO Y TIEMPO -->
 <div class="container center">

<div class='row'>
    <div class='col s12 center'>
        <i class='material-icons large'>person_pin</i><br>
        <h5><b><?php echo utf8_decode($StudneReload['nombres_estudiante'])." ".utf8_decode($StudneReload['apellidos_estudiante'])?></b></h5>
        <h6><b id="CodEstuPruebas"><?php echo $StudneReload['cod_estudiante'] ?></b></h6> <br>

        <div class='chip ToolsTic_Verde white-text'>
            <span><b>Estudiante habilitado</b></span>
        </div>

        <div class='chip orange white-text'>
            <span><b>Cuestionario en curso</b></span>
        </div>  

        <div class='chip ToolsTic_Verde white-text'>
            <span><b>Conectado desde | <?php echo $IpUsuario; ?></b></span>
        </div> 
    </div>
</div> 

<div class="progress">
    <div class="indeterminate"></div>
</div>

<div class="row">
    <div class="card-panel white black-text">
        <div class="row">
            <div class="col s12 m8 push-m2 center">
                <h6><b>Prueba de Homologación</b> <br>
                <b>Lenguaje y Herramientas Informáticas</b> <br>
                <b>Universidad de Nariño</b> </h5>
            </div>
        </div>
        <p>
            A continuación se presentan las 50 preguntas correspondientes a evaluar las 4 competencias
            del módulo de lenguaje y herramientas informáticas.<br> <br>  seleccione la opción de respuesta que
            considere correcta en cada pregunta y <b>guarde</b> su respuesta. <br> Envie su cuestionario una vez
            finalice el tiempo limite.
            <br> <b>¡Mucha Suerte...! </b> 
        </p>
    </div>
</div>
    
</div>
