<!-- Modal REGISTRAR ESTUDIANTE POR CSV  -->
<div id="modalMatriStudent" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4>Registar estudiantes en la plataforma</h4>
      <br>
      <p>Descargue a continuación la plantilla para registrar estudiantes en la plataforma, recuerde completar todos los campos, ademas de identificar muy bien el identificador del programa (id_programa) para cada estudiante.</p>

      <div class="row">
          <form class="col s12" enctype="multipart/form-data" method="POST" id="FMatriStudent">
            <div class="row center">
                <div class="input-field-col-s12 m6">
                    <a style="margin-bottom: 15px;" href="./../plantilla_estudiante.csv" class="waves-effect waves-light btn green">
                        <i class="material-icons right">arrow_downward</i>
                        Descargar plantilla
                    </a>

                    <a style="margin-bottom: 15px;" href="./../programas_academicos.xlsx"  class="waves-effect waves-light btn blue">
                        <i class="material-icons right">arrow_downward</i>
                        Ver programas academicos
                    </a>
                </div>
            </div>
          <br>
          <div class="row center">
              <div class="file-field input-field s12 m6">
                  <div class="btn ToolsticAzul">
                      <span>SUBIR PLANTILLA SCV</span>
                      <input required id="FRE_ArchivoCSV" name="FRE_ArchivoCSV" type="file" accept=".csv">
                  </div>
                  <div class="file-path-wrapper">
                      <input required id="FRE_LabelArchivoCSV" name="FRE_LabelArchivoCSV" class="file-path validate" placeholder="Suba el archivo SCV separados por coma" type="text">
                  </div>
                  <small id="fileHelp" class="form-text text-muted red-text left">
                      Archivos permitidos (.CSV)
                  </small>
              </div>
              <br>
              <div class="file-field input-field s12 m6">
                  <p>
                      Los estudiantes que se registren por este medio están habilitados para realizar la prueba de Homologación de Herramientas Informáticas, y hasta la fecha no han realizado dicha prueba. <b>El estudiante registrado podrá acceder al sistema con su código estudiante como usuario y este mismo como contraseña, que debera cambiar en su primer inicio de sesión.</b>
                  </p>
              </div>            
          </div> 
      </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close left btn red">Cerrar</a>   
        <button class="btn blue" type="submit" name="action">Registrar estudiantes
            <i class="material-icons right">send</i>
        </button>  
    </div>
        </form>
</div>

 <!-- MODAL  DE REGISTRAR  A UN SOLO ESTUDIANTE A LA PLATAFORMA -->
      
 <div id="modalRegStudent" class="modal modal-fixed-footer">
    <div class="modal-content white">
        <h5>Nuevo Estudiante</h4>         
        <p>Todos los campos son obligatorios</p><hr><br>
        <div class="row">
        <form class="col s12" method="POST" id="FormRegistroNewStudent">
        <div class="row">
            <div class="input-field col s12 m6">
                <input pattern="[0-9]{1,12}" require min="0" onkeypress="return justNumbers(event);" placeholder="Este será su nombre de usuario"  id="FRNE_cod_estudiante" type="text" class="validate tooltipped" data-position="bottom" data-tooltip="Código Estudiantil" name="FRNE_cod_estudiante">
                <label for="FRNE_cod_estudiante">Código Estudiantil</label>
            </div>

            <div class="input-field col s12 m6 ">
                <input require id="FRNE_correo" type="email" class="validate tooltipped" data-position="bottom" data-tooltip="Correo Electronico" name="FRNE_correo">
                <label for="FRNE_correo">Correo Electronico</label>
            </div>


            <div class="input-field col s12 m6">
                <select id="FRNE_tipo_doc" name="FRNE_tipo_doc"  class="validate tooltipped" data-position="bottom"  data-tooltip="Tipo de documento">
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="CC">CC</option>
                    <option value="TI">TI</option>
                    <option value="OTRO">Otro</option>
                    </select>
                <label>Tipo de documento</label>
            </div>



            <div class="input-field col s12 m6">
                <input pattern="[0-9]{1,16}" require min="0" onkeypress="return justNumbers(event);" placeholder="Número de identificación"  id="FRNE_num_identificacion" type="text" class="validate tooltipped" data-position="bottom" data-tooltip="Num. Documento de identificación" name="FRNE_num_identificacion">
                <label for="FRNE_num_identificacion">Documento de identidad</label>
            </div>
          


        </div>
        <div class="row">
            <div class="input-field col s12 m6 ">
                <input require id="FRNE_name" type="text" class="validate tooltipped" data-position="bottom" data-tooltip="Nombres del usuario" name="FRNE_name">
                <label for="FRNE_name">Nombres completos</label>
            </div>

            <div class="input-field col s12 m6 ">
                <input require id="FRNE_apellido" type="text" class="validate tooltipped" data-position="bottom" data-tooltip="Apellidos del usuario" name="FRNE_apellido">
                <label for="FRNE_apellido">Apellidos completos</label>
            </div>
        </div> 
        
        <div class="row">
            <div class="input-field col s12 m6 ">
                <input require id="FRNE_password" type="password" class="validate tooltipped" data-position="bottom" autocomplete="false" data-tooltip="Contraseña" name="FRNE_password">
                <label for="FRNE_password">Contraseña</label>
            </div>

            <div class="input-field col s12 m6 ">
                <input require id="FRNE_conpassword" type="password" class="validate tooltipped" data-position="bottom" autocomplete="false" data-tooltip="Repita la contraseña" name="FRNE_conpassword">
                <label for="FRNE_conpassword">Repita Contraseña</label>
            </div>
        </div> 


        <div class="row">
            <div class="input-field col s12 m6">                 
                <select id="FRNE_programa" name="FRNE_programa"  class="validate tooltipped" data-position="bottom"  data-tooltip="programa Academico" >
                <option value="0" disabled selected>Escoja su programa académico</option>
                <optgroup label="PASTO">
                    <?php
                    
                        $progrmas = ProgramasXsede($conex, 1);

                        for($i = 0; $i < count($progrmas); $i++){
                            echo  "<option value='".$progrmas[$i]['id_programa']."'>".$progrmas[$i]['programa']."</option>";
                        }
                    ?>
                </optgroup>

                <optgroup label="IPIALES">
                    <?php
                        $progrmasI = ProgramasXsede($conex, 2);

                        for($i = 0; $i < count($progrmasI); $i++){
                            echo  "<option value='".$progrmasI[$i]['id_programa']."'>".$progrmasI[$i]['programa']."</option>";
                        }
                    ?>
                </optgroup>

                <optgroup label="TUMACO">
                    <?php
                        $progrmasT = ProgramasXsede($conex, 3);

                        for($i = 0; $i < count($progrmasT); $i++){
                            echo  "<option value='".$progrmasT[$i]['id_programa']."'>".$progrmasT[$i]['programa']."</option>";
                        }
                    ?>
                </optgroup>


                <optgroup label="TUQUERRES">
                    <?php
                        $progrmasTu = ProgramasXsede($conex, 4);

                        for($i = 0; $i < count($progrmasTu); $i++){
                            echo  "<option value='".$progrmasTu[$i]['id_programa']."'>".$progrmasTu[$i]['programa']."</option>";
                        }
                    ?>
                </optgroup>

                </select>
                <label>Seleccione un programa</label>
            </div>
        


            <div class="input-field col s12 m6">
                <label for="FRNE_semestre">Semestre Actual</label>
                <br>
                <div class="col s10 m10">
                    <p class="range-field">
                        <input type="range" required id="FRNE_semestre" name="FRNE_semestre" value="1" min="1" max="10" />
                    </p> 
                </div>
                <div class="col s2 m2">
                    <a class="btn ToolsTic_Blue darken-2" id="NumSemestre"></a>
                </div>                          
                
            </div>

        </div> 
                
        
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat red white-text left">Cerrar</a>      

        <button class="btn waves-effect waves-light ToolsTic_Verde btnCard white-text" type="submit" name="action" id="BtnNewStudent">Crear mi cuenta
            <i class="material-icons right">send</i>
        </button>
    </div>
    </form>
    </div>




<!-- ****** FIN MODAL **********  -->

 

<?php   
    $pasto = MostrarGruposXSede($conex,1); 
    $ipiales = MostrarGruposXSede($conex,2); 
    $tumaco = MostrarGruposXSede($conex,3); 
    $tuquerres = MostrarGruposXSede($conex,4);     
?>


  <!-- Modal DE LISTAR ESTUDIANTES INSCRITOS POR GRUPO -->
  <div id="modalListGroup" class="modal modal-fixed-footer">
      <div class="modal-content">
        <h4>Generar listas de grupos</h4>
        <p>Seleccione un grupo, visualice los estudiantes e imprima su reporte</p> 
        <br>
          <div class="row">

            <form class="col s12" method="POST" id="Form_Grupos">
              <div class="row">
                <div class="input-field col s12 m6 l8 push-l2">
                  <select id="GrupoSelect" name="GrupoSelect" onchange="MoEstInsGru()" >  
                    <option value="" disabled selected>Seleccione un grupo</option>

                    <optgroup label="PASTO">
                      <?php
                        for($i = 0; $i < count($pasto); $i++){     
                            echo "<option value='".$pasto[$i]['id_grupo']."'>".$pasto[$i]['grupo']." | ".$pasto[$i]['prueba']."</option>";
                        }
                      ?>
                    </optgroup>

                    <optgroup label="IPIALES">
                      <?php
                        for($i = 0; $i < count($ipiales); $i++){     
                            echo "<option value='".$ipiales[$i]['id_grupo']."'>".$ipiales[$i]['grupo']." | ".$ipiales[$i]['prueba']."</option>";
                        }
                      ?>
                    </optgroup>

                    <optgroup label="TUMACO">
                        <?php
                          for($i = 0; $i < count($tumaco); $i++){     
                              echo "<option value='".$tumaco[$i]['id_grupo']."'>".$tumaco[$i]['grupo']." | ".$tumaco[$i]['prueba']."</option>";
                          }
                        ?>
                      </optgroup>

                      <optgroup label="TUQUERRES">
                        <?php
                          for($i = 0; $i < count($tuquerres); $i++){     
                              echo "<option value='".$tuquerres[$i]['id_grupo']."'>".$tuquerres[$i]['grupo']." | ".$tuquerres[$i]['prueba']."</option>";
                            }
                        ?>
                      </optgroup>
                  </select>
                  <label>Seleccione un grupo</label>
                </div> 
              </div>       
              
              <div class="row">
                  <table>
                      <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Código</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Programa</th>
                        </tr>
                      </thead>
              
                      <tbody id="TBODY_Estudiantes" >
                        
                      </tbody>
                  </table>
              </div>
        </div>
      </div>

      <div class="modal-footer">
          <a class="modal-close left btn red">Cerrar</a> 
          
          <button class="btn waves-effect waves-light green white-text" type="submit" name="action" >Imprimir Lista
              <i class="material-icons right">local_printshop</i>
          </button>

      </div>
      </form>
    
  </div>
  <!--****** FIN MODAL **********  -->

  <!-- Modal MODAL PARA BUSCAR ESTUDIANTES Y GENERAR FICHA -->
  <div id="modalSearchStudent" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4>Buscar estudiante</h4>
      <p>Digite el código del estudiante</p>      

       </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close left btn red">Cerrar</a>      
        <a href="#!" class="modal-close btn blue">Imprimir reporte</a>
    </div>
  </div>
<!--****** FIN MODAL **********  -->



  <!-- Modal MODAL PARA MOSTRAR ESTUDIANTES NO INSCRITOS EN UN GRUPO -->
  <div id="modalStudentNoInsc" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4>Estudiantes no inscritos</h4>
        <p>Listado de estudiantes que aún no están inscritos en un grupo, no han realizado la prueba de homologación y se encuentran habilitados para presentarla.</p>
        <hr>
        <?php 
        $data_Estu = EstudiantesNoInscritos($conex); 
        $count_reg_enc = count(EstudiantesNoInscritos($conex)); 
        ?>

        <span class='badge' data-badge-caption='Registros encontrados' id='reg_encontrados'><b><?php echo $count_reg_enc; ?></b></span>

        <table class='highlight responsive-table'>
            <thead>
            <tr>
                <th>No</th>
                <th>Código</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>No. Identificación</th>
                <th>Programa</th>                                     
            </tr>
            </thead>
            <tbody>
                
                <?php 
                //var_dump($data_Estu);
                $count_r = 0;
                foreach ($data_Estu as $key => $value) {
                    $count_r ++;
                    $dataInfoEs = EstudiantesInfo($conex, $data_Estu[$key]);
                    ?>
                    <tr>
                        <td><?php echo $count_r; ?></td>
                        <td><?php echo $dataInfoEs['cod_estudiante'] ?></td>
                        <td><?php echo $dataInfoEs['nombres_estudiante'] ?></td>
                        <td><?php echo $dataInfoEs['apellidos_estudiante'] ?></td>
                        <td><?php echo $dataInfoEs['num_documento'] ?></td>
                        <td><?php echo $dataInfoEs['programa'] ?></td>
                    </tr>
                <?php   }  ?>

                        
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close btn red">Cerrar</a>  
    </div>
  </div>
<!--****** FIN MODAL **********  -->