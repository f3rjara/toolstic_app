<?php 
    session_start();

    if(isset($_SESSION['user_docente'])){
        $userlog = $_SESSION['user_docente'];
        $userlog = $_SESSION['user_docente'];       
        $CambioPass = 'false';
        if($userlog['password_usuario'] == '5309465306180a6a0de5def13b5347c7'){
            $CambioPass = 'true';  
        }
    }
    else{
        header('Location: ./../');
    }


?>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Dashboard | ToolsTic</title>        
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">     
        <script src="../../js/jquery-341.js"></script>
        
        <link rel="stylesheet" href="../../css/valida-prg.css">
        <link rel="stylesheet" href="../../css/main.css">
        <link rel="stylesheet" href="../../css/materialize.css">
        <link rel="stylesheet" href="../../css/sweetalert2.css">
        <script language="JavaScript">
            function mueveReloj(){
                momentoActual = new Date()
                hora = momentoActual.getHours()
                minuto = momentoActual.getMinutes()
                segundo = momentoActual.getSeconds()

                str_segundo = new String (segundo)
                if (str_segundo.length == 1)
                segundo = "0" + segundo

                str_minuto = new String (minuto)
                if (str_minuto.length == 1)
                minuto = "0" + minuto

                str_hora = new String (hora)
                if (str_hora.length == 1)
                hora = "0" + hora

                horaImprimible = hora + " : " + minuto + " : " + segundo

                //document.form_reloj.reloj.value = horaImprimible
                $('#reloj').text(horaImprimible);
                //$("#parrafo").text('Texto de sustitución');
                setTimeout("mueveReloj()",1000)
            }
        </script>
    </head>
    <body  onload="mueveReloj()" class="ToolsticBlanco" >
    <div class="navbar-fixed">
    <nav class="ToolsTic_Verde z-depth-2">
        <div class="nav-wrapper">
            <a class="brand-logo center">
                <img src="../../img/logotipo.png" width="200px"></a> 
            <ul id="nav-mobile" class="left">
                <li><a data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a></li>                
            </ul>  
        </div>
    </nav> 
    </div>
        <?php 
            include 'menu_Docente.php';
            require './../conex.php';
            include './php/fetch_records.php';

            $fecha = ObtenerDateTime();           
            $IpUser = ObtenerIpConex();

        ?>
       
    
    <main>        
      
    <div class="row" style="margin-bottom: 10px;">
            <div class="col s12 m8 push-m2 l9 push-l3">
                <div class="row right"> 
                    <a class="ToolsticAzul btn">
                        <b>Pasto, </b>
                        <?php echo strftime("%d de %b del %Y",strtotime($fecha['date']));?> 
                    </a> &nbsp;
                    <a class="ToolsticAzul btn white-text" id="reloj"></a>   
                    &nbsp; &nbsp;
                </div>                
            </div>            
        </div>        
        <div class="row">
            <div class="col s12 m8 push-m2 l9 push-l3">
                 <div class="row right">
                    <a class="btn blue">
                        <?php echo $IpUser; ?>
                    </a>
                    &nbsp; &nbsp;
                </div>
            </div>
        </div>




        <?php 
            //CONTAR TOTAL DE PREGUNTAS CREADAS
            $SqlTotalPrg = "SELECT COUNT(*) AS NumTotalPrg FROM pregunta";
            $ResultTP = $conex->query($SqlTotalPrg);
            $dataTP = $ResultTP->fetch_assoc();
        ?>
        <div class="row">
        <div class="row">
        <div class="col s12 m12 l4">  
            <div class="col dash z-depth-1">
                <div class="center white ">
                    <img src="./../../img/student.gif" class="circle" width="40%" alt="">
                </div>                
                <div class="card horizontal ToolsticAzul">                
                    <div class="card-image">
                    <h1 style="margin-top: 10px;margin-left: 15px;" class="yellow-text">
                        <b><?php echo $dataTP['NumTotalPrg'];?></b>
                    </h1>
                    </div>                
                    <div class="card-content">
                        <h5 style="margin-top: 5px;" class="yellow-text"><b>Preguntas</b></h5>
                    </div>               
                </div>
            </div>          
            
        </div>   
        
        <?php 
            //CONTAR TOTAL DE PREGUNTAS YA VALIDADAS PUEDE QUE FALTEN EDITAR 
            $SqlTotalPrgVal = "SELECT COUNT(*) AS TotalPrgVal FROM pregunta WHERE id_estado_pregunta='4' OR id_estado_pregunta = '3'";
            $ResultTPVal = $conex->query($SqlTotalPrgVal);
            $dataTPVal = $ResultTPVal->fetch_assoc();
        ?>


        <div class="col s12 m12 l4">  
            <div class="col dash z-depth-1">
                <div class="center white ">
                    <img src="./../../img/student.gif" class="circle" width="40%" alt="">
                </div>                
                <div class="card horizontal blue">                
                    <div class="card-image">
                    <h1 style="margin-top: 10px;margin-left: 15px;" class="white-text">
                        <b><?php echo $dataTPVal['TotalPrgVal'];?></b>
                    </h1>
                    </div>                
                    <div class="card-content" style="margin-left: 20px; margin-right: 0px; padding-right: 0px; padding-Left: 0px;">
                        <h5 style="margin-top: 5px; margin-left: 5px; margin-right: 0px;" class="white-text letreroDash"><b>Preguntas validadas</b></h5>
                    </div>               
                </div>
            </div>          
            
        </div>  

        <?php 
            //CONTAR TOTAL DE PREGUNTAS YA VALIDADAS Y ACEPTADAS
            $SqlTotalPrgAcep = "SELECT COUNT(*) AS TotalPrgAcep FROM pregunta WHERE id_estado_pregunta='4'";
            $ResultTotalPrgAcep = $conex->query($SqlTotalPrgAcep);
            $dataTotalPrgAcep = $ResultTotalPrgAcep->fetch_assoc();
        ?>


        <div class="col s12 m12 l4">  
            <div class="col dash z-depth-1">
                <div class="center white ">
                    <img src="./../../img/student.gif" class="circle" width="40%" alt="">
                </div>                
                <div class="card horizontal green">                
                    <div class="card-image">
                    <h1 style="margin-top: 10px;margin-left: 10px;" class="black-text">
                        <b><?php echo $dataTotalPrgAcep['TotalPrgAcep'];?></b>
                    </h1>
                    </div>                
                    <div class="card-content" style="margin-left: 15px; margin-right: 0px; padding-right: 0px; padding-Left: 0px;">
                            <h5 style="margin-top: 5px; margin-left: 5px; margin-right: 0px;" class="black-text letreroDash"><b>Preguntas aceptadas</b></h5>
                        </div>               
                </div>
            </div>          
            
        </div>  
            
    </div>
        </div>
    <br><br>
    </main>
   
    <?php include './../footer.php'; ?>
        
    
    <script src="../../js/materialize.js"></script> 
    <script src="../../js/sweetalert2.all.js"></script> 
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
            
            var BanderaCambioPW = '<?php echo $CambioPass; ?>';
            console.log(BanderaCambioPW);
            if(BanderaCambioPW == 'true'){
                setTimeout(function(){
                let timerInterval
                Swal.fire({
                title: 'Debes cambiar tu contraseña!',
                type: 'warning',
                html: 'Seras redirigido en <b></b> segundos.',
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
                        setTimeout(function(){ window.location='./perfil.php'; }, 600); 
                    }
                })//FIN THEN RESULT
                }, 800); //FIN SETTIME
            }//fin if
            
        });  //FIN WINDOWS ONLOAD
        
       
        
    </script>
    
      
    </body>
</html>