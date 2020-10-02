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
        <title>Periodos | ToolsTic</title>  
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
        ?>
       
    <br><br>
    <main>
        <div class="row">
        <div class="col s12 m10 push-m1">
            <div class="card-panel">
                <div class="row">
                    <div class="col s12 right-align">                        
                        <a href="#NuevoPeriodo" class="ToolsticAzul modal-trigger white-text btn">
                            <i class="material-icons left">add_box</i><b>Nuevo periodo</b>  
                        </a>                        
                    </div>
                   
                </div> 
                <hr>
                <div class="row">
                    <table class="centered highlight responsive-table">
                        <thead >
                            <tr>
                                <th>No</th>                            
                                <th>Año</th>
                                <th>Periodo</th>
                                <th>Estado</th>                            
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $SqlPeriodos = "SELECT * FROM periodo, estado_periodo WHERE periodo.id_estado_periodo = estado_periodo.id_estado_periodo ORDER BY periodo.id_estado_periodo";

                            $ResultSql = $conex->query($SqlPeriodos);

                            if($ResultSql->num_rows > 0)
                            {
                                $CuentaRows = 0;
                                while($datos= $ResultSql->fetch_assoc())
                                {
                                    $CuentaRows ++;                                    
                                ?>
                                <tr>
                                    <td><?php echo $CuentaRows; ?></td>
                                    <td><?php echo $datos['year_periodo'];?></td>
                                    <td><?php echo utf8_encode($datos['periodo']);?></td>                            
                                    <td>
                                        <a class="btn <?php echo $datos['bgcolor_estado_periodo'];?>" onclick="CambiarEstado(<?php echo $datos['id_periodo'];?>)"><b><?php echo $datos['estado_periodo'];?></b></a>
                                    </td>                           
                                    <td>
                                        <a class="modal-trigger"    href="#EditarPeriodo<?php echo $datos['id_periodo'];?>">
                                            <b><i class="material-icons black-text">create</i></b>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn_elimina" onclick="DeletePeriodo(<?php echo $datos['id_periodo'];?>)">
                                            <b><i class="material-icons red-text">delete</i></b>
                                        </a>
                                    </td>
                                </tr>
                                
                                <!-- MODAL EDITAR PERIODO -->
                                <!-- MODAL EDITAR Y ACTUALIZAR EL PERIODO -->
                                <div id="EditarPeriodo<?php echo $datos['id_periodo'];?>" class="modal modal-fixed-footer">
                                    <div class="modal-content">
                                        <h5>Edición del periodo</h4> 
                                        <div class="row">
                                        <form class="col s12" method="POST" id="FPE_Periodo_<?php echo $datos['id_periodo'];?>">
                                        <div class="row">
                                            <div class="input-field col s12 m6 push-m3">
                                                <input pattern="[0-9]{1,12}" require min="0" onkeypress="return justNumbers(event);" id="FUP_year_<?php echo $datos['id_periodo'];?>" type="text" class="validate tooltipped" data-position="bottom" data-tooltip="Dígite un año valido" name="FUP_year" value="<?php echo $datos['year_periodo'];?>">
                                                <label for="FUP_year">Año del periodo</label>
                                            </div>        
                                            
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12 m6 push-m3">
                                                <input require id="FUP_periodo_<?php echo $datos['id_periodo'];?>" type="text" class="validate tooltipped" data-position="bottom" data-tooltip="Descripcion del periodo" name="FUP_periodo" value="<?php echo utf8_encode($datos['periodo']);?>">
                                                <label for="FUP_periodo">Periodo</label>
                                            </div>
                                        </div>   

                                        <div class="row">
                                            <div class="input-field col s12 m6 push-m3">
                                            <select id="FUP_estado_periodo_<?php echo $datos['id_periodo'];?>" require>
                                                <option value="0" disabled >Seleccione una opción</option>
                                                <?php
                                                if($datos['id_estado_periodo'] == 1)  { ?>
                                                        <option value="1" selected>Activo</option>                
                                                        <option value="2">Inactivo</option>   
                                                <?php }
                                                else { ?>
                                                    <option value="1">Activo</option>                
                                                    <option value="2" selected>Inactivo</option>   
                                                <?php } ?>
                                                 
                                            </select>
                                            <label>Estado del periodo</label>
                                            </div>
                                        </div>                                        
                                        
                                        
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#!" class="modal-close waves-effect waves-green btn-flat red   white-text left">Cerrar</a>
                                                
                                        <button class="btn waves-effect waves-light ToolsTic_Verde btnCard white-text" type="submit" name="action" onclick="GetIdPeriodo(<?php echo $datos['id_periodo'];?>)">Actualizar Periodo
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>

                                    </form>
                                </div>


                            <?PHP }
                            }

                            ?>
                            
                        </tbody>
                    </table>
                </div>               
            </div>
        </div>
        </div>

        
    <!-- MODAL NUEVO PERIODO -->
    <div id="NuevoPeriodo" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h5>Creación de nuevo periodo</h4> 
        <div class="row">
        <form class="col s12" method="POST" id="Fnew_Periodo">
        <div class="row">
            <div class="input-field col s12 m6 push-m3">
                <input pattern="[0-9]{1,12}" require min="0" onkeypress="return justNumbers(event);" id="FNP_year" type="text" class="validate tooltipped" data-position="bottom" data-tooltip="Dígite un año valido" name="FNP_year">
                <label for="FNP_year">Año del periodo</label>
                <span class="helper-text" data-error="Formato invalido" data-success="Muy bien">Ingrese un año valido</span>
            </div>        
            
        </div>
        <div class="row">
            <div class="input-field col s12 m6 push-m3">
                <input require id="FNP_periodo" type="text" class="validate tooltipped" data-position="bottom" data-tooltip="Descripcion del periodo" name="FNP_periodo">
                <label for="FNP_periodo">Periodo</label>
                <span class="helper-text" data-error="Formato invalido" data-success="Muy bien">Ingrese un nombre valido</span>
            </div>
        </div>   

        <div class="row">
            <div class="input-field col s12 m6 push-m3">
            <select id="FNP_estado_periodo" require>
                <option value="0" disabled>Seleccione una opción</option>
                <option value="1">Activo</option>                
                <option value="2" selected>Inactivo</option>    
            </select>
            <label>Estado del periodo</label>
            </div>
        </div>        
        
        
        </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat red   white-text left">Cerrar</a>
                    
            <button class="btn waves-effect waves-light ToolsTic_Verde btnCard white-text" type="submit" name="action" id="BtnNewPeriodo">Crear Nuevo Periodo
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
    <script src="./js/update-periodo.js"></script> 
    <script src="./js/deleted-periodo.js"></script> 
    <script src="./js/valida-number.js"></script> 
    <script src="./js/new-periodo.js"></script> 
    <script src="./js/edit-periodo.js"></script> 
    

   
    <script src="funciones.js"></script>   
    
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