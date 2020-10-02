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
        <title>Reportes | ToolsTic</title>        
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
            </div>
        </nav> 
    </div>
        <?php            
            require './../conex.php';
            include_once './php/fetch_record.php';
            include_once './php/fetch_results.php';

        ?>
       
    <br>
    <main>
        <div class="row">
            <div class="col s12 m6 l2 push-l8 right-align">
                <a href="" class="col s12 btn ToolsTic_Verde" style="margin-top: 1rem;"> DESCARGAR JSON</a>
            </div>
            <div class="col s12 m6 l2 push-l8 left-align">
                <a href="" class="col s12 btn ToolsTic_Verde" style="margin-top: 1rem;"> DESCARGAR EXCEL</a>
            </div>
        </div>
        <br>
        <div class="row container">   
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quidem voluptatum distinctio quos placeat sunt facilis eius recusandae delectus. Perferendis quo nobis aperiam blanditiis nihil odio recusandae libero explicabo amet dolore.
        </div>   
        <br>
        <div class="row">
            <table>
                <tr> <td>lorem skdslj</td> </tr>
            </table>
        </div> 
    </main>
   
    <br><br>
    <?php //include './../footer.php'; ?>
        
    <script src="../../js/jquery-341.js"></script>
    <script src="../../js/materialize.js"></script> 
    <script src="../../js/sweetalert2.all.js"></script> 
    <script src="funciones.js"></script>   
    
    <script>
        $(document).ready(function(){            M.AutoInit();

            Toast.fire({
              type: 'success',
              title: 'Ussuario Conectado'
            });  
        });  
        
       
        
    </script>
    
      
    </body>
</html>