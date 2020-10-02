<?php 
    session_start();

    $id_tipo_tuser =  $_SESSION['user_docente']["id_tipo_usuario"];
    if(isset($_SESSION['user_docente']) && ($id_tipo_tuser == 1 || $id_tipo_tuser == 99)){
        $userlog = $_SESSION['user_docente'];
    }
    else{
        header('Location: /toolsticapp/admin');
    }
?>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Grupos | ToolsTic</title>     
        <link rel="icon" type="image/png" href="../../img/favUdenar.png">   
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">     
        
        <link rel="stylesheet" href="../../css/valida-prg.css">
        <link rel="stylesheet" href="../../css/main.css">
        <link rel="stylesheet" href="../../css/materialize.css">
        <link rel="stylesheet" href="../../css/sweetalert2.css">

    </head>
    <body class="ToolsticBlanco" >
    <div class="navbar-fixed">
    <nav class="ToolsTic_Verde z-depth-2">
        <div class="nav-wrapper">
            <a class="brand-logo center"><img src="../../img/logotipo.png" width="200px"></a> 
            <ul id="nav-mobile" class="left">
                <li><a data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a></li>                
            </ul>            
        </div>
    </nav>  
    </div>
        <?php 
            include 'menu_admin.php';
            require './../conex.php';
            include './php/fetch_record.php';
        ?>
       
    <br><br>
    <main>
    <div class="row">
        <div class="col s12 m12">
            <div class="card-panel">
                <div class="row">
                    <div class="col s12 right-align">                        
                        <a href="#NuevoGrupo" class="ToolsticAzul modal-trigger white-text btn">
                            <i class="material-icons left">add_box</i><b>Nuevo Grupo</b>  
                        </a>                        
                    </div>
                   
                </div> 
                <hr>
                <div class="row">
                    <table class="centered highlight responsive-table">
                        <thead >
                            <tr>
                                <th>No</th> 
                                <th>Grupo</th> 
                                <th>Prueba</th>
                                <th>F. Aplicación</th>
                                <th>Periodo</th>
                                <th>Aula</th>
                                <th>Horario</th> 
                                <th>F. Inscripción</th>   
                                <th>Cupos Libres</th> 
                                <th>Estado</th>                           
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $SqlGrupos = "SELECT * FROM grupo, prueba, estado_grupo, periodo WHERE grupo.id_prueba = prueba.id_prueba AND grupo.id_estado_grupo = estado_grupo.id_estado_grupo AND prueba.id_periodo = periodo.id_periodo ORDER BY prueba.fecha_aplicacion_prueba DESC, grupo.id_prueba DESC, grupo.id_estado_grupo, grupo.horario_grupo";

                                $ResultSql = $conex->query($SqlGrupos);  
                                
                                if($ResultSql->num_rows > 0){
                                    $NumRows = 0;

                                    while($datos = $ResultSql->fetch_assoc())
                                    {
                                        $NumRows ++;  
                                ?>
                                <tr>
                                    <td><?php echo $NumRows;?></td>
                                    <td><?php echo $datos['grupo']; ?></td> 
                                    <td><?php echo $datos['prueba']; ?></td> 
                                    <td><?php echo $datos['fecha_aplicacion_prueba']; ?></td>    
                                    <td><?php echo $datos['periodo']; ?> del <?php echo $datos['year_periodo']; ?> </td> 
                                    <td><?php echo $datos['aula_grupo']; ?></td> 
                                    <td><?php echo $datos['horario_grupo']; ?></td>
                                    <td><?php echo $datos['fecha_inscripcion_prueba']; ?></td>
                                    <td><?php echo ($datos['cupos_ofrecidos_grupo']-$datos['total_inscritos_grupo']); ?> de <?php echo $datos['cupos_ofrecidos_grupo']; ?></td>                      
                                    <td>
                                        <a class="btn <?php echo $datos['bgcolor_estado_grupo']; ?>" onclick="CambiarEstadoGrupo(<?php echo $datos['id_grupo']; ?>)"><b><?php echo $datos['estado_grupo']; ?></b></a>
                                    </td>                           
                                    <td>
                                        <?php 
                                            if($datos['id_estado_grupo'] == 4){ 
                                        ?>
                                            <a class="modal-trigger" disabled>
                                                <b><i class="material-icons grey-text">create</i></b>
                                            </a>
                                        <?php } else { ?>
                                            <a class="modal-trigger" href="#EditarGrupo_<?php echo $datos['id_grupo']; ?>">
                                            <b><i class="material-icons black-text">create</i></b>
                                        </a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                    <?php 
                                            if($datos['id_estado_grupo'] == 4){ 
                                        ?>
                                            <a class="btn_elimina">
                                                <b><i class="material-icons grey-text">delete</i></b>
                                            </a>
                                        <?php } else { ?>
                                            <a class="btn_elimina" onclick="DeleteGrupo(<?php echo $datos['id_grupo']; ?>)">
                                            <b><i class="material-icons red-text">delete</i></b>
                                            </a>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <!-- MODAL EDITAR EL  GRUPO -->
    <div id="EditarGrupo_<?php echo $datos['id_grupo']; ?>" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h5>Creación de nuevo grupo</h4> 
            <div class="row">
                <form class="col s12" method="POST" id="EditGrupo_<?php echo $datos['id_grupo'];?>">
                    <div class="row">
                        <div class="input-field col s12 m6 push-m3">
                            <input require id="FPEG_grupo_<?php echo $datos['id_grupo'];?>" type="text" class="validate tooltipped" data-position="bottom" data-tooltip="Descripcion del grupo" value="<?php echo $datos['grupo'];?>">
                            <label for="FPEG_grupo_<?php echo $datos['id_grupo'];?>">Nombre Grupo</label>
                            <span class="helper-text" data-error="Formato invalido" data-success="Muy bien">Nombre descriptivo del grupo</span>

                        </div>  
                    </div>

                    <div class="row">
                        <div class="input-field col s12 m6 ">
                            <select id="FPEG_prueba_<?php echo $datos['id_grupo'];?>" require>                           
                            <?php
                                $SqlLasPruebas = "SELECT * FROM prueba WHERE id_estado_prueba = '2'";
                                $ResultSqlPr = $conex->query($SqlLasPruebas);
                                if($ResultSqlPr->num_rows > 0){
                                    echo '<option value="0" disabled>Seleccione una prueba</option>';
                                    while($data = $ResultSqlPr->fetch_assoc()){ 
                                        if($datos['id_prueba'] == $data['id_prueba'] ) {?>
                                            <option selected value="<?php echo $data['id_prueba']?>"><?php echo $data['prueba']?></option>   
                                        <?php }
                                        else{ ?>
                                            <option value="<?php echo $data['id_prueba']?>"><?php echo $data['prueba']?></option>
                                        <?php
                                        } // fin else
                                    } // fin while
                                }
                                else {
                                    echo '<option value="0" selected disabled>No hay pruebas activas</option>';
                                }
                            ?>  
                            </select>
                            <label>Prueba del grupo</label>
                            <span class="helper-text" data-error="Formato invalido" data-success="Muy bien">Solo se veran las pruebas activas</span>
                        </div>
                        
                        <div class="input-field col s12 m6 ">
                            <select id="FPEG_aula_<?php echo $datos['id_grupo'];?>" require>
                                <option value="0" disabled >Seleccione una aula</option>
                                <option selected value="<?php echo $datos['aula_grupo'];?>"><?php echo $datos['aula_grupo'];?></option>
                                <option value="Aula de informática">Aula de informática</option>             
                                <option value="301">301</option> 
                                <option value="302">302</option> 
                                <option value="303">303</option>
                                <option value="304">304</option> 
                                <option value="305">305</option>

                                <option value="401">401</option>
                                <option value="402">402</option>     
                                <option value="403">403</option>     
                                <option value="404">404</option>     
                                <option value="405">405</option>     
                                <option value="406">406</option>     
                                <option value="407">407</option>     
                                <option value="408">408</option>     
                                <option value="409">409</option>     
                                <option value="410">410</option>     

                            </select>
                            <label>Aula donde se aplicará la prueba</label>
                        </div>

                    </div>   

                    <div class="row">
                    
                        <div class="input-field col s12 m6 ">
                        <select id="FPEG_horario_<?php echo $datos['id_grupo'];?>" require>
                                <option value="0" disabled >Seleccione horario</option>
                                <?php if($datos['horario_grupo'] == '8:00 a 10:00') {  ?>
                                <option selected value="8:00 a 10:00">8:00 a 10:00</option>                
                                <option value="10:00 a 12:00">10:00 a 12:00</option> 
                                <option value="2:00 a 4:00">2:00 a 4:00</option> 
                                <option value="4:00 a 6:00">4:00 a 6:00</option>     
                            <?php }
                                else if($datos['horario_grupo'] == '10:00 a 12:00') {  ?>
                                    <option value="8:00 a 10:00">8:00 a 10:00</option>                
                                    <option selected value="10:00 a 12:00">10:00 a 12:00</option> 
                                    <option value="2:00 a 4:00">2:00 a 4:00</option> 
                                    <option value="4:00 a 6:00">4:00 a 6:00</option>     
                            <?php } 
                                else if($datos['horario_grupo'] == '2:00 a 4:00') {  ?>
                                    <option value="8:00 a 10:00">8:00 a 10:00</option>                
                                    <option value="10:00 a 12:00">10:00 a 12:00</option> 
                                    <option selected value="2:00 a 4:00">2:00 a 4:00</option> 
                                    <option value="4:00 a 6:00">4:00 a 6:00</option>     
                            <?php } 
                                else{ ?>
                                    <option value="8:00 a 10:00">8:00 a 10:00</option>                
                                    <option value="10:00 a 12:00">10:00 a 12:00</option> 
                                    <option value="2:00 a 4:00">2:00 a 4:00</option> 
                                    <option selected value="4:00 a 6:00">4:00 a 6:00</option> 
                            <?php }                            
                            ?>
                        </select>
                        <label>Horario en el que se aplicará la prueba</label>
                        </div>
                        
                        <div class="input-field col s12 m6 ">
                            <input require id="FPEDG_cupos_ofrecidos_<?php echo $datos['id_grupo'];?>" type="text" onkeypress="return justNumbers2(event);" class="validate tooltipped" data-position="bottom" data-tooltip="Cupos ofrecidos en el grupo" value="<?php echo $datos['cupos_ofrecidos_grupo'];?>">
                            <label for="FPEDG_cupos_ofrecidos_<?php echo $datos['id_grupo'];?>">Cupos frecidos</label>
                            <span class="helper-text" data-error="Formato invalido" data-success="Muy bien">Cantidad de cupos habilitados para el grupo</span>
                        </div>

                    </div>     
                    
                    <div class="row">
                        <div class="input-field col s12 m6 ">
                            <select id="FPEG_estad_grupo_<?php echo $datos['id_grupo'];?>" require>
                                    <option value="0" disabled >Seleccione horario</option>
                                    <?php if($datos['id_estado_grupo'] == 1) { ?>
                                        <option value="1" selected>Inactivo</option>
                                        <option value="2" >Activo</option>
                                        <option value="3" >Completo</option>                                       

                                    <?php } else if($datos['id_estado_grupo'] == 2) { ?>
                                        <option value="1" >Inactivo</option>
                                        <option value="2" selected>Activo</option>
                                        <option value="3" >Completo</option>   
                                    <?php } 
                                    else if($datos['id_estado_grupo'] == 3)  { ?>
                                        <option value="1" >Inactivo</option>
                                        <option value="2" >Activo</option>
                                        <option value="3" selected>Completo</option>
                                    <?php } 
                                    else   { ?>
                                        <option value="1" >Inactivo</option>
                                        <option value="2" >Activo</option>
                                        <option value="3" >Completo</option>
                                        <option value="4" selected >Archivado</option>

                                    <?php }
                                        ?>    
                            </select>
                            <label>Estado del grupo</label>
                        </div>
                    </div>                
                
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat red  white-text left">Cerrar</a>                    
            <button class="btn waves-effect waves-light ToolsTic_Verde btnCard white-text" onclick="ReturnIdGrupo(<?php echo $datos['id_grupo'];?>)" type="submit" name="action" >Actualizar Grupo
                <i class="material-icons right">send</i>
            </button>
        </div>
        </form>
    </div>


    <!-- fin del modal de edirar grupo -->

                                <?php  } // FIN WHILE
                                }//FIN RESUL > 0 
                            ?>  
                        </tbody>
                    </table>
                </div>               
            </div>
        </div>
    </div>
     
    <!-- MODAL NUEVO GRUPO -->
    <div id="NuevoGrupo" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h5>Creación de nuevo grupo</h4> 
            <div class="row">
                <form class="col s12" method="POST" id="Form_NewGrupo">
                    <div class="row">
                        <div class="input-field col s12 m6 push-m3">
                            <input require id="FNewG_grupo" type="text" class="validate tooltipped" data-position="bottom" data-tooltip="Descripcion del grupo">
                            <label for="FNewG_grupo">Nombre Grupo</label>
                            <span class="helper-text" data-error="Formato invalido" data-success="Muy bien">Nombre descriptivo del grupo</span>

                        </div>  
                    </div>

                    <div class="row">
                        <div class="input-field col s12 m6 ">
                            <select id="FNewG_prueba" require>                           
                            <?php
                                $SqlLasPruebas = "SELECT * FROM prueba WHERE id_estado_prueba = '2'";
                                $ResultSqlPr = $conex->query($SqlLasPruebas);
                                if($ResultSqlPr->num_rows > 0){
                                    echo '<option value="0" disabled>Seleccione una prueba</option>';
                                    while($data = $ResultSqlPr->fetch_assoc()){ ?>
                                        <option value="<?php echo $data['id_prueba']?>"><?php echo $data['prueba']?></option>   
                                    <?php }
                                }
                                else {
                                    echo '<option value="0" selected disabled>No hay pruebas activas</option>';
                                }
                            ?>  
                            </select>
                            <label>Prueba del grupo</label>
                            <span class="helper-text" data-error="Formato invalido" data-success="Muy bien">Solo se veran las pruebas activas</span>
                        </div>
                        
                        <div class="input-field col s12 m6 ">
                            <select id="FNewG_aula" require>
                                <option value="0" disabled selected>Seleccione una aula</option>
                                <option value="Aula de informática">Aula de informática</option>             
                                <option value="301">301</option> 
                                <option value="302">302</option> 
                                <option value="303">303</option>
                                <option value="304">304</option> 
                                <option value="305">305</option>

                                <option value="401">401</option>
                                <option value="402">402</option>     
                                <option value="403">403</option>     
                                <option value="404">404</option>     
                                <option value="405">405</option>     
                                <option value="406">406</option>     
                                <option value="407">407</option>     
                                <option value="408">408</option>     
                                <option value="409">409</option>     
                                <option value="410">410</option>     

                            </select>
                            <label>Aula donde se aplicará la prueba</label>
                        </div>

                    </div>   

                    <div class="row">
                    
                        <div class="input-field col s12 m6 ">
                        <select id="FNewG_horario" require>
                            <option value="0" disabled selected>Seleccione horario</option>
                                <option value="8:00 a 10:00">8:00 a 10:00</option>                
                                <option value="10:00 a 12:00">10:00 a 12:00</option> 
                                <option value="2:00 a 4:00">2:00 a 4:00</option> 
                                <option value="4:00 a 6:00">4:00 a 6:00</option>      
                        </select>
                        <label>Horario en el que se aplicará la prueba</label>
                        </div>
                        
                        <div class="input-field col s12 m6 ">
                            <input require id="FNewG_cupos_ofrecidos" type="text" onkeypress="return justNumbers2(event);" class="validate tooltipped" data-position="bottom" data-tooltip="Cupos ofrecidos en el grupo">
                            <label for="FNewG_cupos_ofrecidos">Cupos frecidos</label>
                            <span class="helper-text" data-error="Formato invalido" data-success="Muy bien">Cantidad de cupos habilitados para el grupo</span>
                        </div>

                    </div>     
                    
                    <div class="row">
                        <div class="input-field col s12 m6 ">
                            <select id="FNewG_estad_grupo" require>
                                    <option value="0" disabled >Seleccione horario</option>
                                    <option value="1" selected>Inactivo</option>                
                                    <option value="2">Activo</option> 
                            </select>
                            <label>Estado del grupo</label>
                        </div>
                    </div>                
                
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat red   white-text left">Cerrar</a>                    
            <button class="btn waves-effect waves-light ToolsTic_Verde btnCard white-text" type="submit" name="action" id="BtnNewPrueba">Crear Nuevo Grupo
                <i class="material-icons right">send</i>
            </button>
        </div>
        </form>
    </div>
    


        
    
    </main>
   
    <br><br>
    <?php include './../footer.php'; ?>
        
    <script src="../../js/jquery-341.js"></script>
    <script src="../../js/materialize.js"></script> 
    <script src="../../js/sweetalert2.all.js"></script> 
    <script src="funciones.js"></script>  
    <script src="./js/new_grupo.js"></script> 
    <script src="./js/delete-grupo.js"></script> 
    <script src="./js/update-grupo.js"></script> 
    
    <script>
        $(document).ready(function(){
            M.AutoInit();

            Toast.fire({
              type: 'success',
              title: 'Ussuario Conectado'
            });
            
            mostrarDatos();
            agregaDatosEdicion(<?php echo $userlog['id_usuario']; ?>);
            
        });  
        
       
        
    </script>
    
      
    </body>
</html>