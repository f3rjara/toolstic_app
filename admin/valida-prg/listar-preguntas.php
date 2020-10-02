<?php 
    session_start();
    if(isset($_SESSION['user_docente'])){
        $userlog = $_SESSION['user_docente'];
    }
    else{
        header('Location: ../../logout.php');
    }

    require "./../conex.php";   
?>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Listado de Preguntas | ToolsTIC</title>
        <link rel="icon" type="image/png" href="../../img/favUdenar.png">
        <link rel="stylesheet" href="../../css/valida-prg.css">
        <link rel="stylesheet" href="../../css/materialize.css">
        <link rel="stylesheet" href="../../css/sweetalert2.css">
        <link rel="stylesheet" href="../../css/Chart.css">

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">    

        <script src="../../js/jquery-341.js"></script>
        <script src="../../js/Chart.js"></script>
        <script src="../../js/Chart.bundle.js"></script>
        <script src="../../js/chartjs-plugin-datalabels.js"></script>
        <script src="../../js/phpjs.js"></script>
        


    </head>
    
    <body class="ToolsticBlanco" >

    <div class="navbar-fixed">
    <nav class="ToolsTic_Verde z-depth-2">
        <div class="nav-wrapper">
            <a class="brand-logo center"><img src="../../img/logotipo.png" width="230px"></a> 
            <ul id="nav-mobile" class="left">
                <li><a data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a></li>                
            </ul>            
        </div>
    </nav> 
    </div>
    
    <?php 
        include 'menu_Docente.php';
        include "./php/fetch_records.php";
    ?>       
    
    <main>  

        <?php include './grapre.php' ?>

        <?php include './lpac.php' ?>
        
        <?php include './lparchi.php' ?>

        <?php include './buspre.php' ?>

        <?php include './php/modalFullPre.php' ?>


        <script>
            
            var texto = "diseñar.";
            var textoUtf8 = utf8_encode(texto);   

        </script>
    </main>
   
    <br><br>
    <?php include './../footer.php'; ?>
        
    
    <script src="../../js/materialize.js"></script> 
    <script src="../../js/sweetalert2.all.js"></script>      
    <script src="./js/delete-prg.js"></script>
    <script src="./js/grafipre.js"></script>
    <script src="funciones.js"></script> 
    <script src="./js/shearquestion.js"></script>
    <script src="./js/ModPreFull.js"></script>

    <script>
        $(document).ready(function(){
            M.AutoInit();
            Toast.fire({
              type: 'success',
              title: 'Ussuario Conectado'
            })
            
            mostrarDatos();
            agregaDatosEdicion(<?php echo $userlog['id_usuario']; ?>);
            
            AutocompletarShear();
            ShearQuestion(1);
            $('.chips').chips();

            FirstGrafic(<?php echo intval($TotalesPre[0]['TotalPre']); ?>,<?php echo intval($TotalesPre[0]['TotalPreVyA']); ?>,<?php echo intval($TotalesPre[0]['TotalPreAySV']); ?>,<?php echo intval($TotalesPre[0]['TotalPreNoAc']); ?>);
                    
            var PrgDoc =  <?php echo intval($TotalesUser[0]['TotalPre']); ?> ;
            console.log(PrgDoc);
            if(PrgDoc > 0){
            MyPreGrafic(<?php echo intval($TotalesUser[0]['TotalPre']); ?>,<?php echo intval($TotalesUser[0]['TotalPreVyA']); ?>,<?php echo intval($TotalesUser[0]['TotalPreAySV']); ?>,<?php echo intval($TotalesUser[0]['TotalPreNoAc']); ?>);
            }
                
           

        });  
        
        
        
        

        
        
    </script>
    
      
    </body>
</html>