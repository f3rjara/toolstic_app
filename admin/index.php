<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Admin Login | ToolsTic</title>        
        <link rel="icon" type="image/png" href="../img/favUdenar.png">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/materialize.css">

    </head>

    <body class="ToolsticBlanco" >
    <!-- ****** INICIO DE NAV DE LOGO ****** -->   
    <nav>
        <div class="nav-wrapper ToolsTic_Verde">
            <a href="./../" class="brand-logo center"><img src="../img/logotipo.png" width="230px"></a>
           
        </div>
    </nav> <br>
    <!-- ****** INICIO DE NAV DE LOGO ****** -->   
    
    <main> 
        <div class="row container ">
                <!-- PRIMERA TARJETA CREAR PREGUNTAS -->
                <div class="col s12 m6 l4 push-l2">
                    <a href="login.php?since=preguntas">
                        <div class="card ">
                            <div class="card-image">
                                <img src="../img/examen.gif">                    
                            </div>
                            <div class="card-content center ToolsticBlanco">  
                                <h4 class="black-text">Administrar preguntas </h4>
                                <p class="black-text">Bienvenido a la plataforma <b>ToolsTIC</b>, aquí podrás crear, validar y administrar las preguntas para la prueba de homologación. </p>  
                            </div>  
                        </div>
                    </a>
                </div>

                <!-- SEGUNDA TARJETA ADMINISTRAR PRUEBAS -->
                <div class="col s12 m6 l4 push-l2">
                    <a href="login.php?since=pruebas">
                        <div class="card ">
                            <div class="card-image">
                                <img src="../img/curso.gif">                    
                            </div>
                            <div class="card-content center ToolsticBlanco">  
                                <h4 class="black-text">Administrar pruebas </h4>
                                <p class="black-text">Bienvenido a la plataforma <b>ToolsTIC</b>, en este espacio podrás gestionar todas las pruebas de homologación, así como usuarios y estudiantes. </p>  
                            </div> 
                        </div>
                    </a>
                </div>


        </div>
        <br><br><br>
    </main>
    
    <!-- ****** INICIO DE PIE DE PAGINA ****** -->
    <!--Footer-->
<footer class="bg_blue page-footer footer-c">
        <div class="container">
            <div class="row">
              <div class="col s12 m8 l8 left-align">
                <h5 class="white-text">Contacto sede Pasto</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!"><i
                        class="material-icons tiny">house</i> Calle #18 Carrera 50 Ciudadela Universitaria Torobajo.</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!"><i
                        class="material-icons tiny">location_on</i> Pasto - Nariño, Colombia.</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!"><i
                        class="material-icons tiny">phone</i> 7000000</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!"><i
                        class="material-icons tiny">mail</i> toolstic@udenar.edu.co</a></li>
                </ul>
              </div>
                <div class="col s12 offset-l2 m4 l2 responsive-img right">
                    <img src="./../img/udenar_f1.png" alt="Escudo Udenar" width="150">
                </div>
                
            </div>
        </div>
        <div class="footer-copyright darken-3">
            <div class="container">
                © 2020 Licencia Creative Commons. | <a class="modal-trigger white-text" href="#modalAviso">Aviso legal.</a>
                <a class="grey-text text-lighten-4 right" href="#!">Desarrollado Por: <strong>Proyecto @ToolsTic.</strong></a>
            </div>
        </div>
    </footer>
    <!-- ****** FIN DE PIE DE PAGINA ****** -->   
        
    <script src="../js/jquery-341.js"></script>
    <script src="../js/materialize.js"></script>        
    </body>
</html>
