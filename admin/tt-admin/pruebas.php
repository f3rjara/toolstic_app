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
        <title>Pruebas | ToolsTic</title>      
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
        <div class="col s12 m10 push-m1">
            <div class="card-panel">
                <div class="row">
                    <div class="col s12 right-align">                        
                        <a href="#NuevaPrueba" class="ToolsticAzul modal-trigger white-text btn">
                            <i class="material-icons left">add_box</i><b>Nueva prueba</b>  
                        </a>                        
                    </div>
                   
                </div> 
                <hr>
                <div class="row">
                    <table class="centered highlight responsive-table">
                        <thead >
                            <tr>
                                <th>No</th> 
                                <th>Prueba</th>
                                <th>F. Apliación</th>
                                <th>Periodo</th>
                                <th>Sede</th>
                                <th>F. Inscripción</th>
                                <th>Estado</th>                            
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $SqlPruebas ="SELECT * FROM prueba, estado_prueba, sede, periodo WHERE prueba.id_estado_prueba = estado_prueba.id_estado_prueba AND prueba.id_sede = sede.id_sede AND prueba.id_periodo = periodo.id_periodo ORDER BY prueba.id_estado_prueba,prueba.id_periodo";

                            $ResultSql = $conex->query($SqlPruebas);

                            if($ResultSql->num_rows > 0){
                                $CuentaRows = 0;
                                while($datos = $ResultSql->fetch_assoc())
                                {
                                    $CuentaRows ++;                                   
                                ?>
                                <tr>
                                    <td><?php echo $CuentaRows;?></td>                                
                                    <td><?php echo utf8_encode($datos['prueba']);?></td>
                                    <td><?php echo $datos['fecha_aplicacion_prueba'];?></td>     
                                    <td><?php echo $datos['periodo'];?> - <?php echo $datos['year_periodo'];?> </td>  
                                    <td><?php echo $datos['sede'];?></td>    
                                    <td><?php echo $datos['fecha_inscripcion_prueba'];?></td>                  
                                    <td>
                                        <?php
                                            if($datos['id_estado_prueba'] == 5){
                                                echo "<a class='btn grey'><b>".$datos['estado_prueba']."</b></a>";
                                            }
                                            else{
                                        ?>
                                        <a class="btn <?php echo $datos['bgcolor_estado_prueba'];?>" onclick="CambiarEstadoPrueba(<?php echo $datos['id_prueba'];?>)"><b><?php echo $datos['estado_prueba'];?></b></a>
                                        <?php }; ?>
                                    </td>                           
                                    <td>
                                        <?php
                                            if($datos['id_estado_prueba'] == 5){
                                                echo '<a class="modal-trigger" disabled >
                                                 <b><i class="material-icons grey-text">create</i></b>
                                                </a>';
                                            }
                                            else{
                                        ?>
                                        <a class="modal-trigger"  href="#EditarPrueba<?php echo $datos['id_prueba'];?>">
                                            <b><i class="material-icons black-text">create</i></b>
                                        </a>
                                        <?php }; ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($datos['id_estado_prueba'] == 5){
                                                echo '<a class="btn_elimina" disabled>
                                                <b><i class="material-icons grey-text">delete</i></b>
                                                </a>';
                                            }
                                            else{
                                        ?>
                                        <a class="btn_elimina" onclick="DeletePrueba(<?php echo $datos['id_prueba'];?>)">
                                            <b><i class="material-icons red-text">delete</i></b>
                                        </a>
                                        <?php }; ?>
                                    </td>
                                </tr>
                                
                                <!-- MODAL EDITAR Y ACTUALIZAR PRUEBA -->
                                <div id="EditarPrueba<?php echo $datos['id_prueba'];?>" class="modal modal-fixed-footer">
                                    <div class="modal-content">
                                        <h5>Actualizar prueba</h4> 
                                        <div class="row">
                                            <form class="col s12" method="POST" id="FPE_Prueba_<?php echo $datos['id_prueba'];?>">
                                                <div class="row">                                                    
                                                <div class="input-field col s12 m6 push-m3">
                                                        <input require id="FPE_prueba_<?php echo $datos['id_prueba'];?>" type="text" class="validate tooltipped" data-position="bottom" data-tooltip="Descripcion de la prueba" name="FNPR_prueba" value="<?php echo utf8_encode($datos['prueba']);?>">
                                                        <label for="FPE_prueba_<?php echo $datos['id_prueba'];?>">Prueba</label>
                                                    </div>  
                                                </div>

                                                <div class="row">
                                                    <div class="input-field col s12 m6 ">
                                                        <input require type="date" id="FPE_fecha_aplicacion_<?php echo $datos['id_prueba'];?>" class="tooltipped" data-position="bottom" data-tooltip="Fecha de aplicación de la prueba" value="<?php echo $datos['fecha_aplicacion_prueba'];?>">  
                                                        <label for="FPE_fecha_aplicacion_<?php echo $datos['id_prueba'];?>">Fecha de aplicación</label>
                                                    </div>

                                                    <div class="input-field col s12 m6 ">
                                                        <input require type="date" id="FPE_fecha_inscripcion_<?php echo $datos['id_prueba'];?>" class="tooltipped" data-position="bottom" data-tooltip="Fecha limite de inscripción a la prueba" value="<?php echo $datos['fecha_inscripcion_prueba'];?>">  
                                                        <label for="FPE_fecha_inscripcion_<?php echo $datos['id_prueba'];?>">Fecha limite de Inscripción</label>
                                                    </div>

                                                </div>   

                                                <div class="row">

                                                    <div class="input-field col s12 m6 ">
                                                    <select id="FPE_sede_<?php echo $datos['id_prueba'];?>" require>
                                                        <option value="0" disabled >Seleccione una sede</option>
                                                    <?php if($datos['id_sede'] == 1) { ?>
                                                        <option value="1" selected>Pasto</option>                
                                                        <option value="2">Ipiales</option> 
                                                        <option value="3">Tumaco</option> 
                                                        <option value="4">Tuquerres</option> 
                                                    <?php } 
                                                    else if($datos['id_sede'] == 2) { ?>
                                                        <option value="1">Pasto</option>                
                                                        <option value="2" selected>Ipiales</option> 
                                                        <option value="3">Tumaco</option> 
                                                        <option value="4">Tuquerres</option> 
                                                    <?php } 
                                                     else if($datos['id_sede'] == 3) { ?>
                                                        <option value="1">Pasto</option>                
                                                        <option value="2">Ipiales</option> 
                                                        <option value="3" selected>Tumaco</option> 
                                                        <option value="4">Tuquerres</option> 
                                                    <?php } 
                                                     else { ?>
                                                        <option value="1">Pasto</option>                
                                                        <option value="2">Ipiales</option> 
                                                        <option value="3">Tumaco</option> 
                                                        <option value="4" selected>Tuquerres</option> 
                                                    <?php } ?>
                                                    

                                                    </select>
                                                    <label>Sede donde se aplicara la prueba</label>
                                                    </div>
                                                    

                                                    <div class="input-field col s12 m6 ">
                                                    <select id="FPE_periodo_<?php echo $datos['id_prueba'];?>" require>
                                                        <option value="0" disabled >Seleccione un periodo</option>
                                                        <?php
                                                            $SqlPeriodos1 = "SELECT * FROM periodo WHERE id_estado_periodo='1'";
                                                            $ResultSql2 = $conex->query($SqlPeriodos1);
                                                            if($ResultSql2->num_rows > 0){
                                                                while($datosPeriodos = $ResultSql2->fetch_assoc()){  
                                                                    if($datosPeriodos['id_periodo'] == $datos['id_periodo']){ ?>
                                                                        <option selected value="<?php echo $datosPeriodos['id_periodo']?>" ><?php echo $datosPeriodos['periodo']?> - <?php echo $datosPeriodos['year_periodo']?> </option> 
                                                                    <?php } else {?>
                                                                        <option value="<?php echo $datosPeriodos['id_periodo']?>" ><?php echo $datosPeriodos['periodo']?> - <?php echo $datosPeriodos['year_periodo']?> </option>                      
                                                                    <?php
                                                                    }//fin if
                                                                } //fin while
                                                            } //fin result
                                                        ?>   
                                                    </select>
                                                    <label>Periodo de la prueba</label>
                                                    </div>



                                                </div>   
                                                
                                                <div class="row">
                                                <div class="input-field col s12 m6 ">
                                                    <select id="FPE_estado_prueba_<?php echo $datos['id_prueba'];?>" require> 
                                                        <option value="0" disabled >Seleccione una opción</option>
                                                    <?php if($datos['id_estado_prueba'] == 1) { ?>
                                                        <option value="1" selected>Inactivo</option> 
                                                        <option value="2">Activo</option> 
                                                        <option value="3">En curso</option> 
                                                        <option value="4">Finalizada</option> 
                                                        <option value="5">Archivar</option>
                                                    <?php } 
                                                    else if($datos['id_estado_prueba'] == 2) { ?>
                                                        <option value="1">Inactivo</option>                
                                                        <option value="2" selected>Activo</option> 
                                                        <option value="3">En curso</option> 
                                                        <option value="4">Finalizada</option> 
                                                        <option value="5">Archivar</option>
                                                    <?php } 
                                                     else if($datos['id_estado_prueba'] == 3) { ?>
                                                        <option value="1">Inactivo</option>                
                                                        <option value="2">Activo</option> 
                                                        <option value="3" selected>En curso</option> 
                                                        <option value="4">Finalizada</option> 
                                                        <option value="5">Archivar</option>
                                                    <?php } 
                                                     else if($datos['id_estado_prueba'] == 4) { ?>
                                                        <option value="1">Inactivo</option>                
                                                        <option value="2">Activo</option> 
                                                        <option value="3">En curso</option> 
                                                        <option value="4" selected>Finalizada</option> 
                                                        <option value="5">Archivar</option>
                                                    <?php } 
                                                    else { ?>
                                                        <option value="1">Inactivo</option>                
                                                        <option value="2">Activo</option> 
                                                        <option value="3">En curso</option> 
                                                        <option value="4">Finalizada</option> 
                                                        <option value="5" selected>Archivar</option>
                                                    <?php } ?>

                                                    </select>
                                                    <label>Estado de la prueba</label>
                                                    </div>
                                                </div>
                                            
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#!" class="modal-close waves-effect waves-green btn-flat red   white-text left">Cerrar</a>
                                                
                                        <button class="btn waves-effect waves-light ToolsTic_Verde btnCard white-text" type="submit" name="action" onclick="ObtenerIdPrueba(<?php echo $datos['id_prueba'];?>)">Actualizar Prueba
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>
                                    </form>
                                </div>

                            <?php }
                            }



                            ?>

                            
                            

                        </tbody>
                    </table>
                </div>               
            </div>
        </div>
    </div>
     
    
    
    <!-- MODAL NUEVO PRUEBA -->
    <div id="NuevaPrueba" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h5>Creación de nueva prueba</h4>
            <?php 
            date_default_timezone_set('America/Bogota');
            $fechaHoy = ObtenerDateTime(); 
            ?> 
            <div class="row">
                <form class="col s12" method="POST" id="FPCN_Prueba">
                    <div class="row">
                        <div class="input-field col s12 m6 push-m3">
                            <input require id="FNPR_prueba" type="text" class="validate tooltipped" data-position="bottom" data-tooltip="Descripcion de la prueba" name="FNPR_prueba">
                            <label for="FNPR_prueba">Prueba</label>
                            <span class="helper-text" data-error="Formato invalido" data-success="Muy bien">Nombre para identificar la prueba</span>
                        </div>  
                    </div>

                    <div class="row">
                        <div class="input-field col s12 m6 ">
                            <input require type="date" id="FNPR_fecha_aplicacion" name="FNPR_fecha_aplicacion" class="tooltipped" data-position="bottom" data-tooltip="Fecha de aplicación de la prueba" min="<?php echo $fechaHoy['fecha'];?>" value="<?php echo $fechaHoy['fecha'];?>">  

                            <label for="FNPR_fecha_aplicacion">Fecha de aplicación</label>
                            <span class="helper-text" data-error="Formato invalido" data-success="Muy bien">Seleccione una fecha valida</span>
                        </div>

                        <div class="input-field col s12 m6 ">
                            <input require type="date" id="FNPR_fecha_inscripcion" name="FNPR_fecha_inscripcion" class="tooltipped" data-position="bottom" data-tooltip="Fecha limite de inscripción a la prueba" min="<?php echo $fechaHoy['fecha'];?>" value="<?php echo $fechaHoy['fecha'];?>">  

                            <label for="FNPR_fecha_inscripcion">Fecha limite de Inscripción</label>
                            <span class="helper-text" data-error="Formato invalido" data-success="Muy bien">Esta fecha no puede ser mayor a la fecha de aplicación</span>
                        </div>

                    </div>   

                    <div class="row">

                        <div class="input-field col s12 m6 ">
                        <select id="FNPR_sede" require>
                            <option value="0" disabled selected>Seleccione una sede</option>
                            <option value="1">Pasto</option>                
                            <option value="2">Ipiales</option> 
                            <option value="3">Tumaco</option> 
                            <option value="4">Tuquerres</option>    
                        </select>
                        <label>Sede donde se aplicará la prueba</label>
                        </div>

                        <div class="input-field col s12 m6 ">
                        <select id="FNPR_periodo" require>
                            <option value="0" disabled selected>Seleccione un periodo</option>
                            <?php
                                $SqlLosPeriodos = "SELECT * FROM periodo WHERE id_estado_periodo='1'";
                                $ResultSqlPeriodos = $conex->query($SqlLosPeriodos);
                                if($ResultSqlPeriodos->num_rows > 0){
                                    while($datosPeriodos = $ResultSqlPeriodos->fetch_assoc()){  ?>
                                            <option value="<?php echo $datosPeriodos['id_periodo']?>" ><?php echo $datosPeriodos['periodo']?> - <?php echo $datosPeriodos['year_periodo']?> </option>                      
                                        <?php
                                    }
                                }
                            ?>

                        </select>
                        <label>Periodo de la prueba</label>
                        </div>

                    </div> 
                    
                    <div class="row">
                        <div class="input-field col s12 m6 ">
                        <select id="FNPR_estado_prueba" require>
                            <option value="0" disabled >Seleccione una opción</option>
                            <option value="1" selected>Inactivo</option>    
                            <option value="2">Activo</option>  
                        </select>
                        <label>Estado de la prueba</label>
                        </div>
                    </div>
                
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat red   white-text left">Cerrar</a>
                    
            <button class="btn waves-effect waves-light ToolsTic_Verde btnCard white-text" type="submit" name="action" >Crear Nueva Prueba
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
    <script src="./js/update-prueba.js"></script> 
    <script src="./js/deleted-prueba.js"></script> 
    <script src="./js/new-prueba.js"></script> 
    <script src="funciones.js"></script>   
    
    <script>
        $(document).ready(function(){
            $('.datepicker').datepicker();
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