<?php

require './../../conex.php';
require './fetch_record.php';

$salida ="";
$query ="SELECT * FROM estudiante LIMIT 0";
if(isset($_POST['consulta'])){
    $datar = $conex->real_escape_string($_POST['consulta']);

    $query ="SELECT * FROM estudiante WHERE cod_estudiante LIKE '%".$datar."%' OR num_documento LIKE '%".$datar."%' OR correo_estudiante LIKE '%".$datar."%' LIMIT 10";
}

$resultado = $conex->query($query);

if($resultado->num_rows > 0 ){
    $No_datos  = $resultado->num_rows ;
    $salida.= "<span class='badge' data-badge-caption='Registros encontrados' id='reg_encontrados'>".$No_datos."</span>
    <table class='highlight responsive-table'>
    <thead>
      <tr>
          <th>No</th>
          <th>Código</th>
          <th>Nombres</th>
          <th>Apellidos</th>
          <th>No. Identificación</th>
          <th>Correo electronico</th>
          <th>Ver</th>                      
      </tr>
    </thead>
    <tbody> ";
        
            $count = 0;
            while($fila = $resultado->fetch_assoc()){
                $count++;

                //Array Informacion personal.
                $InfoEstuBus = EstudiantesInfo($conex, $fila['cod_estudiante']);
                
                
                //ARRAY FULL DATOS DE INSCRIPCION DE UN ESTUDIANTE
                $InfoInscEstu = FullDataInscEstu($conex, $fila['cod_estudiante']);

                
                // ARRAY FULL DATOS DE RESULTADOS DE UN ESTUDIANTE 
                $ResultCuestEstu = FullDataResulCuestEstu($conex, $fila['cod_estudiante']);

                $salida.= "                
                <tr>
                    <td>".$count."</td>
                    <td>".$fila['cod_estudiante']."</td>
                    <td>".$fila['nombres_estudiante']."</td>
                    <td>".$fila['apellidos_estudiante']."</td>
                    <td>".$fila['num_documento']."</td>
                    <td>".$fila['correo_estudiante']."</td>
                    <td><a onclick='cargar_modal()' href='#".$count."_".$fila['cod_estudiante']."' class='modal-trigger'><i class='material-icons green-text'>remove_red_eye</i></a></td>
                </tr>

                <div id='".$count."_".$fila['cod_estudiante']."' class='modal modal-fixed-footer'>
                    <div class='modal-content'>
                        <h4>Información del estudiante</h4> 
                        <hr>                         
    <div class='row '>

    <div class='row'>
        <div class='col s12 center'>
            <i class='material-icons large'>person_pin</i><br>
            <span><b>".$InfoEstuBus['nombres_estudiante']." ".$InfoEstuBus['apellidos_estudiante']."</b></span><br>
            <span><b>".$InfoEstuBus['cod_estudiante']."</b></span>
        </div>
    </div>
    
    <div class='row'>
    <div class='progress'>
        <div class='indeterminate'></div>
    </div>

    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>subtitles</i>
        <input id='icon_prefix' type='text' class='validate' disabled value='".$InfoEstuBus['tipo_documento']."'>
        <label for='icon_prefix'>Tipo de documento</label>
    </div>

    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>chrome_reader_mode</i>
        <input id='icon_prefix' type='text' class='validate' disabled value='".$InfoEstuBus['num_documento']."'>
        <label for='icon_prefix'>Número de documento</label>
    </div>

    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>school</i>
        <input id='icon_prefix' type='text' class='validate' disabled value='".$InfoEstuBus['programa']."'>
        <label for='icon_prefix'>Programa académico</label>
    </div>

    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>grade</i>
        <input id='icon_prefix' type='text' class='validate' disabled value='".$InfoEstuBus['semestre_estudiante']." Semestre'>
        <label for='icon_prefix'>Semestre</label>
    </div>

    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>email</i>
        <input id='icon_prefix' type='text' class='validate' disabled value='".$InfoEstuBus['correo_estudiante']."'>
        <label for='icon_prefix'>Correo electrónico</label>
    </div>

    <div class='input-field col s12 m6'>
        <i class='material-icons prefix'>phone</i>
        <input id='icon_prefix' type='text' class='validate' disabled value='".$InfoEstuBus['telefono_estudiante']."'>
        <label for='icon_prefix'>Número de contacto</label>
    </div>
    

    <div class='col s12 m6'>
        <br>
        <div class='switch' id='icon_prefix'>
            <label>
              No
              <input type='checkbox' id='Chk_ResetPass' onchange='ResetPassEst(".$InfoEstuBus['cod_estudiante'].");'>
              <span class='lever'></span>
              Resetear contraseña por defecto
            </label>
        </div>  
    </div>
    </div>
    <br>
    <div class='row'>
        <ul class='collapsible'>
            <li>";            
            if($InfoInscEstu == null || !is_array($InfoInscEstu) && count($InfoInscEstu) == 0 ){
                $salida.= "<div class='collapsible-header'>
                    <i class='material-icons'>arrow_drop_down_circle</i>
                    ¿El estudiante esta inscrito en un grupo? <hr>
                    <span class='badge red white-text'><b>No</b></span>
                    </div>

                <div class='collapsible-body'>
                    <div class='row'>
                        <a class='btn red white-text'>No hay datos que mostrar</a>
                    </div>
                </div> ";

            }
            else{ 
                $salida.= "<div class='collapsible-header'>
                <i class='material-icons'>arrow_drop_down_circle</i>
                ¿El estudiante esta inscrito en un grupo? <hr>
                <span class='badge green white-text'><b>Si</b> </span>
                </div>
                <div class='collapsible-body'>
                <div class='row'>                     
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>language</i>
                        <input id='icon_prefix' type='text' class='validate' disabled value='".$InfoInscEstu['prueba']."'>
                        <label for='icon_prefix'>Prueba</label>
                    </div>

                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>timelapse</i>
                        <input id='icon_prefix' type='text' class='validate' disabled value='".$InfoInscEstu['periodo']." - ".$InfoInscEstu['year_periodo']."'>
                        <label for='icon_prefix'>Periodo</label>
                    </div>

                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>location_on</i>
                        <input id='icon_prefix' type='text' class='validate' disabled value='".$InfoInscEstu['sede']."'>
                        <label for='icon_prefix'>Sede</label>
                    </div>                        
            
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>map</i>
                        <input id='icon_prefix' type='text' class='validate' disabled value='".$InfoInscEstu['lugar_sede']."'>
                        <label for='icon_prefix'>Lugar de presentación</label>
                    </div>

                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>supervisor_account</i>
                        <input id='icon_prefix' type='text' class='validate' disabled value='".$InfoInscEstu['grupo']."'>
                        <label for='icon_prefix'>Grupo inscrito</label>
                    </div>

                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>location_searching</i>
                        <input id='icon_prefix' type='text' class='validate' disabled value='".$InfoInscEstu['aula_grupo']."'>
                        <label for='icon_prefix'>Aula de presentación</label>
                    </div>

                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>watch_later</i>
                        <input id='icon_prefix' type='text' class='validate' disabled value='".$InfoInscEstu['horario_grupo']."'>
                        <label for='icon_prefix'>Hora de presentación</label>
                    </div>

                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>date_range</i>
                        <input id='icon_prefix' type='text' class='validate' disabled value='".$InfoInscEstu['fecha_aplicacion_prueba']."'>
                        <label for='icon_prefix'>Fecha de aplicación</label>
                    </div>
                    
                    <div class='input-field col s12 m6'>
                        <i class='material-icons prefix'>date_range</i>
                        <input id='icon_prefix' type='text' class='validate' disabled value='".$InfoInscEstu['fecha_inscripcion']."'>
                        <label for='icon_prefix'>Fecha de inscripción</label>
                    </div>

                    <div class='col s12 m12'>
                        <br> 
                        <div class='switch' id='icon_prefix'>
                            <label>
                                No
                                <input type='checkbox' id='Chk_CanIns' onchange='CanInscEst(".$InfoInscEstu['cod_estudiante'].");'>
                                <span class='lever'></span>
                                Cancelar la inscripción del estudiante
                            </label>
                        </div>  
                    </div>
                </div> 
               </div>
            ";
                
            }

            
            $salida.= " </li>  <li>";
            
        if($ResultCuestEstu == null || !is_array($ResultCuestEstu) && count($ResultCuestEstu) == 0 ){ 
            $salida.= "<div class='collapsible-header'>
                <i class='material-icons'>arrow_drop_down_circle</i>
                ¿El estudiante presentó la prueba de homologación? <hr>
                <span class='badge red white-text'><b>No</b></span>
                </div>

            <div class='collapsible-body'>
                <div class='row'>
                    <a class='btn red white-text'>No hay datos que mostrar</a>
                </div>
            </div> ";

        }
        else{ 
            $salida.= "<div class='collapsible-header'><i class='material-icons'>arrow_drop_down_circle</i>¿El estudiante presentó la prueba de homologación? <hr><span class='badge green white-text'><b>Si</b> </span></div>
                <div class='collapsible-body'>
                    <div class='row'>

                        <div class='input-field col s12 m6'>
                            <i class='material-icons prefix'>description</i>
                            <input id='icon_prefix' type='text' class='validate' disabled value='".$ResultCuestEstu['estado_cuestionario']."'>
                            <label for='icon_prefix'>Estado cuestionario</label>
                        </div>


                        <div class='input-field col s12 m6'>
                            <i class='material-icons prefix'>date_range</i>
                            <input id='icon_prefix' type='text' class='validate' disabled value='".$ResultCuestEstu['inicio_cuestionario']."'>
                            <label for='icon_prefix'>Inicio del cuestionario</label>
                        </div>                            

                        <div class='input-field col s12 m6'>
                            <i class='material-icons prefix'>date_range</i>
                            <input id='icon_prefix' type='text' class='validate' disabled value='".$ResultCuestEstu['fin_cuestionario']."'>
                            <label for='icon_prefix'>Fin del cuestionario</label>
                        </div>
                        
                        <div class='input-field col s12 m6'>
                            <i class='material-icons prefix'>graphic_eq</i>
                            <input id='icon_prefix' type='text' class='validate' disabled value='".$ResultCuestEstu['puntaje_final']." / 5'>
                            <label for='icon_prefix'>Puntaje final obtenido</label>
                        </div>

                        <div class='input-field col s12 m12 center'>
                            <a href='./cuestionarios.php?codget=".$InfoEstuBus['cod_estudiante']."&tokget=".md5($InfoEstuBus['cod_estudiante'])."' target='_blank' class='waves-effect waves-light btn'>
                                <i class='material-icons right'>poll</i>
                                ver resultados detallados</a>
                        </div>

                        <div class='col s12 m6'>
                            <br>
                            <div class='switch' id='icon_prefix'>
                                <label>
                                    No
                                    <input type='checkbox' id='Chk_NewCues' onchange='NewCuesEst(".$ResultCuestEstu['cod_estudiante'].");'>
                                    <span class='lever'></span>
                                    Nuevo intento para resolver el cuestioanrio
                                </label>
                            </div>  
                        </div>

                    </div>
                </div>
            
            ";  }  $salida.= " </li>
        </ul>

    </div>
    
</div>




            </div>
            <div class='modal-footer'>
                <a href='#!' class='modal-close waves-effect waves-green btn-flat red white-text'>Cerrar</a>
            </div>
        </div>";

            }
        
     $salida.="</tbody></table>";



 } else{
    $salida.="<table class='highlight responsive-table'>
    <thead>
      <tr>
          <th>No</th>
          <th>Código</th>
          <th>Nombres</th>
          <th>Apellidos</th>
          <th>No. Identificación</th>
          <th>Correo electronico</th>
          <th>Ver</th>                      
      </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan='7'><b class='center red-text'>No hay estudiantes por mostrar</b></td>
        </tr>
    </tbody></table>";
}

echo $salida;
$conex->close();

?>