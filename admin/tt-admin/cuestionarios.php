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
        <title>Resultados | ToolsTic</title>        
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">     
        
        <link rel="stylesheet" href="../../css/valida-prg.css">
        <link rel="stylesheet" href="../../css/main.css">
        <link rel="stylesheet" href="../../css/materialize.css">
        <link rel="stylesheet" href="../../css/sweetalert2.css">
        <link rel="stylesheet" href="../../css/Chart.css">

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
            require_once './../conex.php';
            include_once './php/fetch_record.php';
            include_once './php/fetch_results.php';
        ?>
       
    <br>
    <main>
        <div class="row">   
            <?php
                if ( isset ( $_GET['codget'] ) && md5( $_GET['codget'] ) == $_GET['tokget'] ) 
                {
                    include_once ( './php/show_report_student.php');
                }
                else {
                    include_once ( './php/show_select_report.php');
                }
            ?>
        </div>    
    </main>
   
    <br><br>
    <?php include './../footer.php'; ?>
        
    <script src="../../js/jquery-341.js"></script>
    <script src="../../js/materialize.js"></script> 
    <script src="../../js/sweetalert2.all.js"></script> 
    <script src="../../js/Chart.js"></script>
    <script src="../../js/Chart.bundle.js"></script>
    <!-- <script src="./js/result-cuest.js"></script> -->
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