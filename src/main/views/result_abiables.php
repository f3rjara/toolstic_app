
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
            <span><b>Resultados  disponibles</b></span>
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

<div class='row'>
    <div class="col s12 m12 center">
        <?php
            $datosCues = $checkCuest['data'];            
            $DataResul = SaveResultCuestionario($userlog['cod_estudiante'], $datosCues['id_cuestionario'], $conex); 
            include_once (ROOT_MAIN.'/views/resu_data.php'); 
        
            $insEstu = EstudianteInscrito($userlog['cod_estudiante'], $conex); 
            $id_inscripcion = $insEstu['data']['id_inscripcion_prueba'];
            $id_grupo = $insEstu['data']['id_grupo'];
            $PrueEstu = FullDatosInsctipcion($id_grupo, $conex);
            $FullCuestionario = EstudianteFullCuestionario($id_inscripcion, $userlog['cod_estudiante'], $conex);

            include_once (ROOT_MAIN.'/views/show_result_student.php'); 

        ?>
    </div>
    <br><br>
</div>
 <br>


