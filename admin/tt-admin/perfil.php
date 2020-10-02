<?php 
    session_start();

    $id_tipo_tuser =  $_SESSION['user_docente']["id_tipo_usuario"];
    
    if(isset($_SESSION['user_docente']) && ($id_tipo_tuser == 1 || $id_tipo_tuser == 99)){
        $userlog = $_SESSION['user_docente'];       
        $CambioPass = 'false';
        if($userlog['password_usuario'] == '5309465306180a6a0de5def13b5347c7'){
            $CambioPass = 'true';  
        }
    }
    else{
        header('Location: /toolsticapp/admin');
    }


?>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Mi Perfil | ToolsTic</title>
        <link rel="icon" type="image/png" href="../../img/favUdenar.png">
        <link rel="stylesheet" href="../../css/valida-prg.css">
        <link rel="stylesheet" href="../../css/materialize.css">
        <link rel="stylesheet" href="../../css/sweetalert2.css">

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">        
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
        ?>
       
    <br><br>
    <main>        
        <div class="row">
            <div class="col s12 m12">
                <div class="row">
                    <div class="card-content container center">
                        <div class="row" >
                            <div class="col s12 m8 push-m2 l6 push-l3">
                                <div class="card" id="InformaUsuario"></div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
        
    <!-- Modal PARA ACTUALZIAR DATOS -->
    <div id="modalActualiza" class="modal modal-fixed-footer">
        <div class="modal-content center">
          <h5><b>Actualización de datos</b></h5> <br>
            <div class="row">
                <form class="col s12" id="FRActualizaDatos" autocomplete="off"> 
                    <input type="text" id="FAiduser" value="<?php echo $userlog['id_user']; ?>" hidden>  
                    <div class="row">
                        <div class="input-field col s12 m6">
                          <input id="FAnombre" value=" " min="1" type="text" required name="FAnombre" class="validate active" >
                          <label for="FAnombre">Nombres del usuario</label>
                        </div>

                        <div class="input-field col s12 m6">
                          <input id="FAapellido" type="text"  value=" " pattern="[A-Za-z ]+" min="1" required name="FAapellido" class="validate" >
                          <label for="FAapellido">Apellidos del usuario</label>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="input-field col s12">
                          <input id="FApassword" pattern="[A-Za-z0-9_-]{1,15}" type="password" autocomplete="off"  name="FApassword" required class="validate">
                          <label for="FApassword">Contraseña Actual</label>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="input-field col s12 m6">
                          <input id="FAnewpassword1" pattern="[A-Za-z0-9_-]{1,15}" type="password" autocomplete="off" name="FAnewpassword1" class="validate" min="1">
                          <label for="FAnewpassword1">Nueva Contraseña</label>
                        </div>                   


                        <div class="input-field col s12 m6">
                          <input id="FAnewpassword2" pattern="[A-Za-z0-9_-]{1,15}" type="password" autocomplete="off" name="FAnewpassword2" min="1" class="validate">
                          <label for="FAnewpassword2">Repita Contraseña</label>
                        </div>
                    </div>
                    
                    
                    <div class="row">
                        <div class="input-field col s12 m6 ">
                          <input id="FAcorreo" type="email" required name="FAcorreo" class="validate" >
                          <label for="FAcorreo">Correo electrónico</label>
                        </div>

                        <div class="input-field col s12 m6 ">
                          <input id="FAtelefono" value=" " pattern="[0-9]{1,15}" type="text" name="FAtelefono" class="validate">
                          <label for="FAtelefono">Teléfono Celular</label>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat red white-text left">Cerrar</a>
                
            <button class="btn waves-effect waves-light ToolsTic_Verde btnCard white-text" type="submit" name="action" id="BTNActualizaDatos" onclick="ActualizaDatos()">Actualizar Datos
                <i class="material-icons right">send</i>
            </button>
       
        </div>
    </div>
   
   
    </main>
   
    <br><br>
    <?php include './../footer.php'; ?>
        
    <script src="../../js/jquery-341.js"></script>
    <script src="../../js/materialize.js"></script> 
    <script src="../../js/sweetalert2.all.js"></script>  
    <script src="funciones.js"></script> 

    <script>
        $(document).ready(function(){
            M.AutoInit();
            Toast.fire({
              type: 'success',
              title: 'Ussuario Conectado'
            })
            
            mostrarDatos();
            agregaDatosEdicion(<?php echo $userlog['id_usuario']; ?>);            
            var BanderaCambioPW = '<?php echo $CambioPass; ?>';
            console.log(BanderaCambioPW);
            if(BanderaCambioPW == 'true'){
                setTimeout(function(){
                let timerInterval
                Swal.fire({
                title: 'Debes cambiar tu contraseña!',
                type: 'warning',
                html: 'Da clic en el boton rojo y edita tu contraseña <hr> <b></b>',
                allowOutsideClick: false,
                allowEscapeKey: false,
                timer: 3500,
                onBeforeOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {
                    Swal.getContent().querySelector('b')
                        .textContent = Swal.getTimerLeft()
                    }, 100)
                },
                onClose: () => {
                    clearInterval(timerInterval)
                }
                }).then((result) => {
                    if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.timer
                    ) {
                        console.log('cambio de contraseña obligatorio');
                        //setTimeout(function(){ window.location='./perfil.php'; }, 600); 
                    }
                })//FIN THEN RESULT
                }, 800); //FIN SETTIME
            }//fin if
            
        });  
               

        
        document.addEventListener('DOMContentLoaded', function() {
            M.AutoInit();
            M.updateTextFields();
        });
        
    </script>
    
      
    </body>
</html>