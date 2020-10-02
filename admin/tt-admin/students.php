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
        <title>Estudiantes | ToolsTic</title>  
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
            <a class="brand-logo center"><img src="../../img/logotipo.png" width="230px"></a> 
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
   
    <main>

    
    <div class="row align-center">
        <!-- Número de estudiantes en la plataforma -->
        <?php $NumStudent = NumDeEstudiantes($conex); ?>
        <div class="col s12 m6 l4">  
            <div class="col dash z-depth-1">
                <div class="center white ">
                    <img src="https://raw.githubusercontent.com/f3rjara/MakeItReal/master/img/Post_blog_f3rjara.png" class="info_student" width="100%" alt="">
                </div>                
                <div class="card horizontal blue info_student_card">                
                    <div class="card-image">
                    <h1 style="margin-top: 10px;margin-left: 15px;" class="white-text"><b><?php echo $NumStudent['NumStudnet']?></b></h1>
                    </div>                
                    <div class="card-content">
                        <h5 style="margin-top: 5px;" class="white-text"><b>Estudiantes</b></h5>
                    </div>               
                </div>
            </div>          
            
        </div>   

        <!-- Número de estudiantes INSCRIPTS EN UN GRUPO -->
        <?php $NumStudentInscritos = NumDeEstudiantesInscritos($conex); ?>
        <div class="col s12 m6 l4">  
            <div class="col dash z-depth-1">
                <div class="center white ">
                    <img src="https://raw.githubusercontent.com/f3rjara/MakeItReal/master/img/Post_blog_f3rjara.png" class="info_student" width="100%" alt="">
                </div>                
                <div class="card horizontal yellow info_student_card">                
                    <div class="card-image">
                    <h1 style="margin-top: 10px;margin-left: 15px;" class="black-text"><b><?php echo $NumStudentInscritos['NumStudnetIns']?></b></h1>
                    </div>                
                    <div class="card-content" style="margin-left: 20px; margin-right: 0px; padding-right: 0px; padding-Left: 0px;">
                        <h5 style="margin-top: 5px; margin-left: 5px; margin-right: 0px;" class="black-text letreroDash"><b>Estudiantes inscritos</b></h5>
                    </div>               
                </div>
            </div>          
            
        </div>  

        <!-- Número de GRUPOS HBAILITADOS Y ACTIVOS  -->
        <?php $NumGruposHabilitados = NumDeGruposHabilitados($conex); ?> 
        <div class="col s12 m6 l4">  
            <div class="col dash z-depth-1">
                <div class="center white ">
                    <img src="https://raw.githubusercontent.com/f3rjara/MakeItReal/master/img/Post_blog_f3rjara.png" class="info_student" width="100%" alt="">
                </div>                
                <div class="card horizontal teal darken-3 info_student_card">                
                    <div class="card-image">
                    <h1 style="margin-top: 10px;margin-left: 15px;" class="yellow-text"><b><?php echo $NumGruposHabilitados['NumGrupos']?></b></h1>
                    </div>                
                    <div class="card-content">
                        <h5 style="margin-top: 5px;" class="yellow-text"><b>Grupos Habilitados</b></h5>
                    </div>               
                </div>
            </div>          
            
        </div>              
    </div>
    
    </div>

    <br>
    <br>

    <div class="row container">
    
        <div class="col s12 m4 l2" style="margin-bottom: 25px;">
            <a onclick="ocultar_busqueda_estu()" href="#modalRegStudent" class="modal-trigger tooltipped" data-position="bottom" data-tooltip="Registrar un estudiante">
                <img class="img_estu" src="../../img/registro.svg" width="100%" alt="">
            </a>
        </div>

        <div class="col s12 m4 l2 " style="margin-bottom: 25px;">
            <a onclick="ocultar_busqueda_estu()" href="#modalMatriStudent" class="modal-trigger tooltipped" data-position="bottom" data-tooltip="Registrar estudiantes">
                <img class="img_estu" src="../../img/anadir.svg" width="100%" alt="">
            </a>
        </div>
        <div class="col s12 m4 l2 " style="margin-bottom: 25px;">
            <a onclick="ocultar_busqueda_estu(), InscribirGrupoEstu()"  class="tooltipped" data-position="bottom" data-tooltip="Inscribir estudiantes a un grupo">
                <img class="img_estu" src="../../img/grupo.svg" width="100%" alt="">
            </a>
        </div>
        <div class="col s12 m4 l2 " style="margin-bottom: 25px;">
            <a onclick="ocultar_busqueda_estu()" href="#modalListGroup" class="modal-trigger tooltipped" data-position="bottom" data-tooltip="Generar listas por grupo">
                <img class="img_estu" src="../../img/listas.svg" width="100%" alt="">
            </a>
        </div>
        <div class="col s12 m4 l2 " style="margin-bottom: 25px;">
            <a onclick="ShearStudent()" class="tooltipped" data-position="bottom" data-tooltip="Buscar un estudiante">
                <img class="img_estu" src="../../img/buscar.svg" width="100%" alt="">
            </a>
        </div>
        <div class="col s12 m4 l2 " style="margin-bottom: 25px;">
            <a onclick="ocultar_busqueda_estu()" href="#modalStudentNoInsc" class="modal-trigger tooltipped" data-position="bottom" data-tooltip="Estudiantes no inscritos">
                <img class="img_estu" src="../../img/no_inscrito.svg" width="100%" alt="">
            </a>
        </div>
    </div>

    <div class="row" id="busqueda_estu">
        <p class="center">Busque estudiante por código estudiantil, número de documento o correo electronico</p>
        <div class="input-field col s12 m8 push-m2">            
            <i class="material-icons prefix">search</i>
            <input id="icon_prefix" type="text" class="validate" onkeyup="mostrar_Res(this)"  id="caja_busqueda">
            <label for="icon_prefix">Buscar un estudiante</label>
        </div>
               

        <div class="col s12 m10 push-m1" id="datos">
            
        </div>
    
    
    </div>

    
    


         
    <?php include './php/adminStudnet.php'; ?>       
    
    </main>
    <br><br>
    <?php include './../footer.php'; ?>
        
    <script src="../../js/jquery-341.js"></script>
    <script src="../../js/materialize.js"></script> 
    <script src="../../js/sweetalert2.all.js"></script> 
    <script src="funciones.js"></script>
    <script src="./js/registrar_estudiantes.js"></script>   
    <script src="./js/InscribirGrupoEstu.js"></script>   
    <script src="./js/MostrarListaGrupo.js"></script>   
    <script src="./js/PrintListGroup.js"></script>   
    <script src="./js/Nuevo_reg_estu.js"></script> 
    <script src="./js/Buscar_estudiante.js"></script> 
    
    <script>
        $(document).ready(function(){
            M.AutoInit();
            $('.collapsible').collapsible();

            Toast.fire({
              type: 'success',
              title: 'Ussuario Conectado'
            });
            
            mostrarDatos();
            agregaDatosEdicion(<?php echo $userlog['id_usuario']; ?>);
            
            function ocultar_busqueda_estu(){
                $('#busqueda_estu').hide('slow');
            };

            
        });  
        
       
        
    </script>
    
      
    </body>
</html>