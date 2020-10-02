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
        <title>Usuarios | ToolsTic</title>      
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
                        <a href="#ModalNuevoUsuario" class="ToolsticAzul modal-trigger white-text btn">
                            <i class="material-icons left">add_box</i><b>Nuevo usuario</b>  
                        </a>                        
                    </div>
                   
                </div> 
                <hr>
                <div class="row">
                <table class="centered highlight responsive-table">
                    <thead >
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>                            
                            <th>Tipo</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php 
                    $SqlUsers = "SELECT * FROM usuario, tipo_usuario  WHERE usuario.id_tipo_usuario = tipo_usuario.id_tipo_usuario AND usuario.id_tipo_usuario != 99 ORDER BY usuario.id_tipo_usuario";

                    $ResultSql = $conex->query($SqlUsers);

                    if($ResultSql->num_rows > 0)
                    {
                        $cuenta = 0;
                        while($datosUSUARIOS = $ResultSql->fetch_assoc())
                        {
                            $cuenta ++;
                            ?>
                        <tr>
                            <td><?php echo $cuenta;?></td>
                            <td><?php echo $datosUSUARIOS['id_usuario']; ?></td>
                            <td><?php echo utf8_encode($datosUSUARIOS['nombres_usuario']); ?></td>
                            <td><?php echo utf8_encode($datosUSUARIOS['apellidos_usuario']); ?></td> 
                            <td>
                                <a class="btn <?php echo $datosUSUARIOS['bgcolor_tipo_usuario']; ?>"><b><?php echo utf8_encode($datosUSUARIOS['tipo_usuario']); ?></b></a>
                            </td>
                            <td>
                            <a class="modal-trigger" href="#EditarUsuario<?php echo $datosUSUARIOS['id_usuario']; ?>" onclick="Idclickeado(<?php echo $datosUSUARIOS['id_usuario']; ?>)">
                                    <b><i class="material-icons black-text">create</i></b>
                                </a>
                            </td>
                            <td>
                                <a class="btn_elimina" onclick="DeleteUsuario(<?php echo $datosUSUARIOS['id_usuario']; ?>)">
                                    <b><i class="material-icons red-text">delete</i></b>
                                </a>
                            </td>
                        </tr>


                        <!-- MODAL DE EDICIÓN DE USUARIO -->
                            <!-- MODAL EDITANDO USUARIO -->
                        <div id="EditarUsuario<?php echo $datosUSUARIOS['id_usuario']; ?>" class="modal modal-fixed-footer">
                            <div class="modal-content ">
                                <h5>Edición de usuario</h4> 
                                <div class="rows">

                            <form class="col s12 ActualizaDatos" method="POST" id="ActualizaDatos<?php echo $datosUSUARIOS['id_usuario'];?>">
                                <div class="row">
                                    <div class="input-field col s12 m6 push-m3">
                                        <input pattern="[0-9]{1,12}" require min="0" onkeypress="return justNumbers2(event);" placeholder="Esté será su nombre de usuario"  id="Actualiza_id_user_<?php echo $datosUSUARIOS['id_usuario'];?>" type="text" class="validate tooltipped" data-position="bottom" disabled data-tooltip="Número de documento"  value="<?php echo $datosUSUARIOS['id_usuario'];?>">
                                        <label for="Actualiza_id_user_<?php echo $datosUSUARIOS['id_usuario'];?>">Número de Documento</label> 
                                        <span class="helper-text" data-error="formato invalido" data-success="Muy bien">Usuario registrado en el sistema</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m6 ">
                                        <input require id="Actualiza_name_<?php echo $datosUSUARIOS['id_usuario'];?>" onkeypress="return justWord2(event)" type="text" class="validate tooltipped" data-position="bottom" data-tooltip="Nombres del usuario" name="Actualiza_name" value="<?php echo utf8_encode($datosUSUARIOS['nombres_usuario']); ?>">
                                        <label for="Actualiza_name_<?php echo $datosUSUARIOS['id_usuario'];?>">Nombres completos</label>
                                    </div>

                                    <div class="input-field col s12 m6 ">
                                        <input require id="Actualiza_apellido_<?php echo $datosUSUARIOS['id_usuario'];?>" onkeypress="return justWord2(event)" type="text" class="validate tooltipped" data-position="bottom" data-tooltip="Apellidos del usuario" value="<?php echo utf8_encode($datosUSUARIOS['apellidos_usuario']); ?>">
                                        <label for="Actualiza_apellido_<?php echo $datosUSUARIOS['id_usuario'];?>">Apellidos completos</label>
                                    </div>
                                </div>   

                                <div class="row">
                                    <div class="input-field col s12 m6">
                                    <select  id="Actualiza_tipo_user_<?php echo $datosUSUARIOS['id_usuario'];?>" require>
                                        <option value="0" disabled >Seleccione una opción</option>
                                        <?php if($datosUSUARIOS['id_tipo_usuario'] == 1) { ?>
                                            <option value="1" selected>Administrador</option> 
                                            <option value="2"> Docente</option>
                                            <option value="3">Docente Experto Temático</option>
                                        <?php } 
                                        else if($datosUSUARIOS['id_tipo_usuario'] == 2) { ?>
                                            <option value="1">Administrador</option> 
                                            <option value="2" selected> Docente</option>
                                            <option value="3">Docente Experto Temático</option>
                                        <?php } 
                                        else{ ?>
                                            <option value="1">Administrador</option> 
                                            <option value="2"> Docente</option>
                                            <option value="3" selected>Docente Experto Temático</option>
                                        <?php } ?>
                                        
                                    </select>
                                    <label>Seleccione el tipo de usuario</label>
                                    </div>
                                    <div class="input-field col s12 m6">
                                            <input id="Actualiza_correo_user_<?php echo $datosUSUARIOS['id_usuario'];?>" require type="email" class="validate tooltipped" data-position="bottom" data-tooltip="Correo del usuario" value="<?php echo $datosUSUARIOS['correo_usuario']; ?>">
                                            <label for="Actualiza_correo_user_<?php echo $datosUSUARIOS['id_usuario'];?>">Correo electronico</label>
                                            <span class="helper-text" data-error="Formato invalido" data-success="Muy bien">Digite un email valido</span>
                                    </div>
                                </div> 

                                <div class="row center">                                 
                                    <div class="input-field col s12 m6 push-m3">
                                        <div class="input-field col s12 ">                
                                            <label for="Actualiza_reset_pw_<?php echo $datosUSUARIOS['id_usuario'];?>">¿Reestablecer Contraseña?</label> 
                                            <br>
                                        </div>
                                        
                                        <div class="input-field col s12"> 
                                            <div class="switch">
                                                <label>
                                                Off
                                                <input id="Actualiza_reset_pw_<?php echo $datosUSUARIOS['id_usuario'];?>" type="checkbox">
                                                <span class="lever"></span>
                                                On
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="#!" class="modal-close waves-effect waves-green btn-flat red  white-text left">Cerrar</a>
                                        
                                <button class="btn waves-effect waves-light ToolsTic_Verde btnCard white-text" type="submit" name="action" id="BtnActualizaUser_<?php echo $datosUSUARIOS['id_usuario'];?>">Actualizar usuario
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                            </form>
                        </div>

                        

                    <?php };                                                 
                    }
                    else{ ?>
                        <tr>
                            <td colspan="8">
                                <a class="btn red">No hay usuarios por mostrar</a>
                            </td>
                        </tr>
                        
                   <?php }


                    ?>
                        

                        
                    </tbody>
                </table>
                </div>               
            </div>
        </div>

        
    </div>
        <!-- LISTA DE USUARIOS ACTUALES -->
        
    <!-- Modal NUEVO USUARIO -->
    <div id="ModalNuevoUsuario" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h5>Creación de nuevo usuario</h4>  <br>
        <div class="row">
        <form class="col s12" method="POST" id="FNew_User">
        <div class="row">
            <div class="input-field col s12 m6 push-m3">
                <input pattern="[0-9]{1,12}" require min="0" onkeypress="return justNumbers2(event);" placeholder="Esté será su nombre de usuario"  id="FNewUs_id_user" type="text" class="validate tooltipped" data-position="bottom" data-tooltip="Número de documento" >
                <label for="FNewUs_id_user">Número de Documento</label>
                <span class="helper-text" data-error="Formato invalido" data-success="Muy bien">Usuario, este campo debe ser númerico</span>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 m6 ">
                <input require id="FNewUs_name" onkeypress="return justWord2(event)" type="text" class="validate tooltipped" data-position="bottom" data-tooltip="Nombres del usuario" name="FNewUs_name">
                <label for="FNU_name">Nombres completos</label>
            </div>

            <div class="input-field col s12 m6 ">
                <input require id="FNewUs_apellido" onkeypress="return justWord2(event)" type="text" class="validate tooltipped" data-position="bottom" data-tooltip="Apellidos del usuario" >
                <label for="FNewUs_apellido">Apellidos completos</label>
            </div>
        </div>   

        <div class="row">

            <div class="input-field col s12 m6 ">
                <input require id="FNewUs_correo" type="email" class="validate tooltipped" data-position="bottom" data-tooltip="Correo" name="FNU_correo">
                <label for="FNewUs_correo">Correo Electronico</label>
                <span class="helper-text" data-error="Formato invalido" data-success="Muy bien">Digite un email valido</span>
            </div>


            <div class="input-field col s12 m6">
            <select id="FNewUs_tipo_user" require>
                <option value="0" disabled selected>Seleccione una opción</option>
                <option value="2">Docente</option>                
                <option value="3">Docente Experto Temático</option>
                <option value="1">Administrador</option>
            </select>
            <label>Seleccione el tipo de usuario</label>
            </div>
        </div> 

        <div class="row">         
            <div class="col s12 m8 push-m2">
                <p style="text-align: justify;">
                    Al momento de crear un nuevo usuario este tendrá como contraseña por defecto. El usuario debera cambiar su contraseña al primer ingreso, en la plataforma.     </p> <br>
                        
                        <label>Contraseña por defecto</label>
                        <input id="password" disabled type="password" value="TTuser" /><br />
                        
                        <label>
                            <input type="checkbox" id="show_password" />
                            <span>Mostrar contraseña</span>
                        </label>
                        
            </div>
            
        
        </div>
        
        
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat red   white-text left">Cerrar</a> 
        <button class="btn waves-effect waves-light ToolsTic_Verde btnCard white-text" type="submit" name="action" >Crear Nuevo usuario
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
    <script src="./js/deleted-user.js"></script>
    <script src="./js/new_user.js"></script> 
    <script src="./js/update-user.js"></script>
    
    
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
        
        $('#show_password').on('change',function(event){
        // Si el checkbox esta "checkeado"
        if($('#show_password').is(':checked')){
            // Convertimos el input de contraseña a texto.
            $('#password').get(0).type='text';
        // En caso contrario..
        } else {
            // Lo convertimos a contraseña.
            $('#password').get(0).type='password';
        }
        });
        
    </script>
    
      
    </body>
</html>