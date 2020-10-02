<?php 
    session_start();

    if(isset($_SESSION['user_docente'])){
        $userlog = $_SESSION['user_docente'];
    }
    else{
        header('Location: ../../');
    }


?>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Área Curricular | ToolsTic</title>
        <link rel="icon" type="image/png" href="../../img/favUdenar.png">
        <link rel="stylesheet" href="../../css/valida-prg.css">
        <link rel="stylesheet" href="../../css/materialize.css">
        <link rel="stylesheet" href="../../css/sweetalert2.css">
        <link rel="stylesheet" href="./css/curricularJs.css">

        <!--
        <link rel="stylesheet" href="css/curricular.scss">
        <link rel="stylesheet" href="css/new-curriculo.scss">
        -->

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">   

    </head>
    <body class="ToolsticBlanco" >
    
    <div class="navbar-fixed">
    <nav class="ToolsTic_Verde z-depth-2">
        <div class="nav-wrapper">
            <a class="brand-logo center"><img src="../../img/logotipo.png" width="230px"></a> 
            <ul id="nav-mobile" class="left">
                <li>
                    <a data-target="slide-out" class="sidenav-trigger">
                    <i class="material-icons">menu</i>
                    </a>
                </li>                
            </ul>            
        </div>
    </nav>

    </div>
     <?php 
            include 'menu_Docente.php';
     ?>
    
    <main>
        <div class=" page-content">
        <div class="card_cu">
                <div class="content">
                <h2 class="title">ALFABETIZACIÓN INFORMACIONAL</h2>
                <p class="copy">Gestiona la información encontrada en la red, evaluando su finalidad y relevancia para la realización de trabajos en su labor académica.</p>
                <button class="btn" onclick="VerCompetencias(C1E1)">Conocer más</button>
                </div>
            </div>
            <div class="card_cu">
                <div class="content">
                <h2 class="title">RESOLUCIÓN DE PROBLEMAS</h2>
                <p class="copy">Identifica necesidades y recursos computacionales apropiados para resolver problemas conceptuales y técnicos a través de medios digitales encontrados en la red.</p>
                <button class="btn" onclick="VerCompetencias(C2E1)">Conocer más</button>
                </div>
            </div>
            <div class="card_cu">
                <div class="content">
                <h2 class="title">COMUNICACIÓN Y COLABORACIÓN</h2>
                <p class="copy">Comunica información en entornos digitales a través de herramientas en línea interactuando activamente en comunidades digitales.</p>
                <button class="btn" onclick="VerCompetencias(C3E1)">Conocer más</button>
                </div>
            </div>
            <div class="card_cu">
                <div class="content">
                <h2 class="title">CREACIÓN Y PUBLICACIÓN</h2>
                <p class="copy">Desarrolla contenidos multimediales y respeta los derechos de propiedad intelectual al utilizar bancos de recursos digitales en su labor académica.</p>
                <button class="btn" onclick="VerCompetencias(C4E1)">Conocer más</button>
                </div>
            </div>
        </div>
    
        <!--EVIDENCIAS PARA LA COMPETENCIA 1-->
        <div class="row container  div_compe" id="C1E1">               
            <br><h4>Evidencias alfabetización informacional</h4>            
            <div class="col s12 m4">
                <div class="card small">
                    <div class="card-image card-image_comp">
                        <img class="img_compe" src="./../../img/comp_1.png" >                
                    </div>
                    <div class="card-content">
                        <p>Busca información y contenidos digitales desde diferentes dispositivos a través de servicios en línea. </p>
                    </div>
                    <div class="card-action">
                        <a onclick="VerTareas(C1E1T)" class="btn black white-text">ver Tareas</a>
                    </div>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="card small">
                    <div class="card-image card-image_comp">
                        <img class="img_compe" src="./../../img/comp_1.png" >                
                    </div>
                    <div class="card-content">
                        <p>Almacena información y contenidos digitales desde diferentes dispositivos a través de servicios en línea.  </p>
                    </div>
                    <div class="card-action">
                        <a onclick="VerTareas(C1E2T)" class="btn black white-text">ver Tareas</a>
                    </div>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="card small">
                    <div class="card-image card-image_comp">
                        <img class="img_compe" src="./../../img/comp_1.png" >                
                    </div>
                    <div class="card-content">
                        <p>Filtra información y contenidos digitales desde diferentes dispositivos a través de servicios en línea. </p>
                    </div>
                    <div class="card-action">
                        <a onclick="VerTareas(C1E3T)" class="btn black white-text">ver Tareas</a>
                    </div>
                </div>
            </div>  
        </div>

        <br> <br>
        <!--TAREAS DE EVIDENCIA 1 COMPETENCIA 1-->
        <div class="row container div_tareas" id="C1E1T"> 
            <div class="col s12 m12 " >
                <ul class="collection with-header">
                    <li class="collection-header"><h4>Tareas de la evidencia 1</h4></li>
                    <li class="collection-item">
                        Configura motores de búsqueda para encontrar información.
                    </li>
                    <li class="collection-item">
                        Utiliza metabuscadores para encontrar información.  
                    </li>
                    <li class="collection-item">
                        Busca información confiable en fuentes académicas.   
                    </li>
                    
                </ul>
            </div>
        </div>

        <!--TAREAS DE EVIDENCIA 2 COMPETENCIA 1-->
        <div class="row container div_tareas" id="C1E2T"> 
            <div class="col s12 m12 " >
                <ul class="collection with-header">
                    <li class="collection-header"><h4>Tareas de la evidencia 2</h4></li>
                    <li class="collection-item">
                        Sincroniza el almacenamiento en la nube con el almacenamiento local. 
                    </li>
                    <li class="collection-item">
                        Guarda información en diferentes servidores de almacenamiento.  
                    </li>
                    <li class="collection-item">
                        Descarga información en diferentes formatos y la almacena de forma local y en la nube  
                    </li>
                    <li class="collection-item">
                        Ordena la información en la nube de acuerdo a su formato.   
                    </li>
                    
                </ul>
            </div>
        </div>
    
        <!--TAREAS DE EVIDENCIA 2 COMPETENCIA 1-->
        <div class="row container div_tareas" id="C1E3T"> 
            <div class="col s12 m12 " >
                <ul class="collection with-header">
                    <li class="collection-header"><h4>Tareas de la evidencia 3</h4></li>
                    <li class="collection-item">
                        Utiliza marcadores sociales para organizar las búsquedas.  
                    </li>
                    <li class="collection-item">
                        Aplica un modelo para evaluar la información encontrada en la red.  
                    </li>
                    <li class="collection-item">
                        Realiza curación de contenido para validar la información.  
                    </li>      
                </ul>
            </div>
        </div>




        <!--EVIDENCIAS PARA LA COMPETENCIA 2-->
        <div class="row container  div_compe" id="C2E1">               
            <br><h4>Evidencias resolución de problemas con el uso de recursos computacionales</h4>            
            <div class="col s12 m4">
                <div class="card small">
                    <div class="card-image card-image_comp">
                        <img class="img_compe" src="./../../img/comp_2.png" >                
                    </div>
                    <div class="card-content">
                        <p>Identifica problemas técnicos en diferentes dispositivos a través de entornos digitales.  </p>
                    </div>
                    <div class="card-action">
                        <a onclick="VerTareas(C2E1T)" class="btn black white-text">ver Tareas</a>
                    </div>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="card small">
                    <div class="card-image card-image_comp">
                        <img class="img_compe" src="./../../img/comp_2.png" >                
                    </div>
                    <div class="card-content">
                        <p>Selecciona herramientas informáticas para dar solución a problemas técnicos a través de entornos digitales  </p>
                    </div>
                    <div class="card-action">
                        <a onclick="VerTareas(C2E2T)" class="btn black white-text">ver Tareas</a>
                    </div>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="card small">
                    <div class="card-image card-image_comp">
                        <img class="img_compe" src="./../../img/comp_2.png" >                
                    </div>
                    <div class="card-content">
                        <p>Utiliza herramientas apropiadas para resolver las necesidades técnicas detectadas a través de entornos digitales.  </p>
                    </div>
                    <div class="card-action">
                        <a onclick="VerTareas(C2E3T)" class="btn black white-text">ver Tareas</a>
                    </div>
                </div>
            </div>  

            <div class="col s12 m4">
                <div class="card small">
                    <div class="card-image card-image_comp">
                        <img class="img_compe" src="./../../img/comp_2.png" >                
                    </div>
                    <div class="card-content">
                        <p>Recupera información y contenidos digitales desde diferentes dispositivos a través de herramientas digitales. </p>
                    </div>
                    <div class="card-action">
                        <a onclick="VerTareas(C2E4T)" class="btn black white-text">ver Tareas</a>
                    </div>
                </div>
            </div>  
        </div>

        <!--TAREAS DE EVIDENCIA 1 COMPETENCIA 2-->
        <div class="row container div_tareas" id="C2E1T"> 
            <div class="col s12 m12 " >
                <ul class="collection with-header">
                    <li class="collection-header"><h4>Tareas de la evidencia 1</h4></li>
                    <li class="collection-item">
                        Reconoce las características a nivel de hardware y software que conforman a los dispositivos de cómputo de uso habitual. 
                    </li>
                    <li class="collection-item">
                        Explica en que consiste el mal funcionamiento de un dispositivo de cómputo.
                    </li>                   
                    
                </ul>
            </div>
        </div>

        <!--TAREAS DE EVIDENCIA 2 COMPETENCIA 2-->
        <div class="row container div_tareas" id="C2E2T"> 
            <div class="col s12 m12" >
                <ul class="collection with-header">
                    <li class="collection-header"><h4>Tareas de la evidencia 2</h4></li>
                    <li class="collection-item">
                        Busca herramientas para diagnosticar posibles errores de hardware y software. 
                    </li>
                    <li class="collection-item">
                        Administra herramientas adecuadas para el mantenimiento de un dispositivo.  
                    </li>  
                </ul>
            </div>
        </div>
    
        <!--TAREAS DE EVIDENCIA 3 COMPETENCIA 2-->
        <div class="row container div_tareas" id="C2E3T"> 
            <div class="col s12 m12" >
                <ul class="collection with-header">
                    <li class="collection-header"><h4>Tareas de la evidencia 3</h4></li>
                    <li class="collection-item">
                        Clasifica herramientas digitales para detectar virus informático en los dispositivos 
                    </li>
                    <li class="collection-item">
                        Realiza configuraciones adecuadas en los dispositivos para su correcto funcionamiento y utilización.  
                    </li>
                    <li class="collection-item">
                        Configura entornos digitales para solucionar problemas técnicos específicos.
                    </li>      
                </ul>
            </div>
        </div>

        <!--TAREAS DE EVIDENCIA 4 COMPETENCIA 2-->
        <div class="row container div_tareas" id="C2E4T"> 
            <div class="col s12 m12" >
                <ul class="collection with-header">
                    <li class="collection-header"><h4>Tareas de la evidencia 4</h4></li>
                    <li class="collection-item">
                        Visualiza información con el uso de software especializado.  
                    </li>
                    <li class="collection-item">
                        Restaura información de diferentes medios de almacenamiento.   
                    </li>
                    <li class="collection-item">
                        Cambia el formato de archivos gestionando la información. 
                    </li>      
                </ul>
            </div>
        </div>


        <!--EVIDENCIAS PARA LA COMPETENCIA 3-->
        <div class="row container  div_compe" id="C3E1">               
            <br><h4>Evidencias comunicación y colaboración en entornos digitales</h4>            
            <div class="col s12 m4">
                <div class="card small">
                    <div class="card-image card-image_comp">
                        <img class="img_compe" src="./../../img/comp_3.png" >                
                    </div>
                    <div class="card-content">
                        <p>Interactúa con comunidades digitales a través de herramientas en línea para difundir información. </p>
                    </div>
                    <div class="card-action">
                        <a onclick="VerTareas(C3E1T)" class="btn black white-text">ver Tareas</a>
                    </div>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="card small">
                    <div class="card-image card-image_comp">
                        <img class="img_compe" src="./../../img/comp_3.png" >                
                    </div>
                    <div class="card-content">
                        <p>Comparte información en comunidades digitales a través de herramientas en línea.  </p>
                    </div>
                    <div class="card-action">
                        <a onclick="VerTareas(C3E2T)" class="btn black white-text">ver Tareas</a>
                    </div>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="card small">
                    <div class="card-image">
                        <img class="img_compe" src="./../../img/comp_3.png" >                
                    </div>
                    <div class="card-content">
                        <p>Identifica las normas de comportamiento en entornos digitales para interactuar a través de la red.  </p>
                    </div>
                    <div class="card-action">
                        <a onclick="VerTareas(C3E3T)" class="btn black white-text">ver Tareas</a>
                    </div>
                </div>
            </div>  

            <div class="col s12 m4">
                <div class="card small">
                    <div class="card-image card-image_comp">
                        <img class="img_compe" src="./../../img/comp_3.png" >                
                    </div>
                    <div class="card-content">
                        <p>Gestiona la identidad digital protegiendo datos personales que se proporcionan a través de la red. </p>
                    </div>
                    <div class="card-action">
                        <a onclick="VerTareas(C3E4T)" class="btn black white-text">ver Tareas</a>
                    </div>
                </div>
            </div>  
        </div>

        <!--TAREAS DE EVIDENCIA 1 COMPETENCIA 3-->
        <div class="row container div_tareas" id="C3E1T"> 
            <div class="col s12 m12" >
                <ul class="collection with-header">
                    <li class="collection-header"><h4>Tareas de la evidencia 1</h4></li>
                    <li class="collection-item">
                        Lista los beneficios de las comunidades digitales y la importancia de la colaboración en red. 
                    </li>
                    <li class="collection-item">
                        Utiliza diferentes canales de comunicación en entornos digitales.
                    </li>
                    <li class="collection-item">
                        Participa en espacios en la web, como blogs, wikis, foros o grupos sociales.
                    </li>                    
                    
                </ul>
            </div>
        </div>

        <!--TAREAS DE EVIDENCIA 2 COMPETENCIA 3-->
        <div class="row container div_tareas" id="C3E2T"> 
            <div class="col s12 m12" >
                <ul class="collection with-header">
                    <li class="collection-header"><h4>Tareas de la evidencia 2</h4></li>
                    <li class="collection-item">
                        Clasifica herramientas que faciliten la comunicación y la participación en línea.
                    </li>
                    <li class="collection-item">
                        Utiliza aplicaciones y documentos compartidos para trabajar simultáneamente. 
                    </li>  
                </ul>
            </div>
        </div>
    
        <!--TAREAS DE EVIDENCIA 3 COMPETENCIA 3-->
        <div class="row container div_tareas" id="C3E3T"> 
            <div class="col s12 m12" >
                <ul class="collection with-header">
                    <li class="collection-header"><h4>Tareas de la evidencia 3</h4></li>
                    <li class="collection-item">
                        Aplica las reglas básicas de comunicación en la red.
                    </li>
                    <li class="collection-item">
                        Adopta estrategias para protegerse de los peligros en la red.
                    </li>                        
                </ul>
            </div>
        </div>

        <!--TAREAS DE EVIDENCIA 4 COMPETENCIA 3-->
        <div class="row container div_tareas" id="C3E4T"> 
            <div class="col s12 m12" >
                <ul class="collection with-header">
                    <li class="collection-header"><h4>Tareas de la evidencia 4</h4></li>
                    <li class="collection-item">
                        Categoriza los beneficios y peligros de poseer una identidad digital.  
                    </li>
                    <li class="collection-item">
                        Administra las configuraciones pertinentes de su identidad digital.    
                    </li>                         
                </ul>
            </div>
        </div>


         <!--EVIDENCIAS PARA LA COMPETENCIA 4-->
         <div class="row container  div_compe" id="C4E1">               
            <br><h4>Evidencias creación y publicación de contenidos digitales</h4>            
            <div class="col s12 m4">
                <div class="card small">
                    <div class="card-image card-image_comp">
                        <img class="img_compe" src="./../../img/comp_4.png" >                
                    </div>
                    <div class="card-content">
                        <p>Integra recursos digitales existentes en la creación de contenido nuevo mediante herramientas de edición audiovisual y gráfica.  </p>
                    </div>
                    <div class="card-action">
                        <a onclick="VerTareas(C4E1T)" class="btn black white-text">ver Tareas</a>
                    </div>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="card small">
                    <div class=" card-image card-image_comp">
                        <img class="img_compe" src="./../../img/comp_4.png" >                
                    </div>
                    <div class="card-content">
                        <p>Publica contenidos en diferentes formatos como productos multimedia a través de medios digitales.   </p>
                    </div>
                    <div class="card-action">
                        <a onclick="VerTareas(C4E2T)" class="btn black white-text">ver Tareas</a>
                    </div>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="card small">
                    <div class="card-image card-image_comp">
                        <img class="img_compe" src="./../../img/comp_4.png" >                
                    </div>
                    <div class="card-content">
                        <p>Aplica derechos de autor a la información encontrada en la red y divulga contenidos a través de diferentes plataformas digitales. </p>
                    </div>
                    <div class="card-action">
                        <a onclick="VerTareas(C4E3T)" class="btn black white-text">ver Tareas</a>
                    </div>
                </div>
            </div>              
        </div>

        <!--TAREAS DE EVIDENCIA 1 COMPETENCIA 4-->
        <div class="row container div_tareas" id="C4E1T"> 
            <div class="col s12 m12" >
                <ul class="collection with-header">
                    <li class="collection-header"><h4>Tareas de la evidencia 1</h4></li>
                    <li class="collection-item">
                        Indica las principales características de diferentes recursos multimediales. 
                    </li>
                    <li class="collection-item">  
                        Diseña presentaciones que incluyen diferentes medios digitales o físicos. 
                    </li>
                    <li class="collection-item">
                        Utiliza programas y servicios offline y online para editar contenido multimedial. 
                    </li>                    
                    
                </ul>
            </div>
        </div>

        <!--TAREAS DE EVIDENCIA 2 COMPETENCIA 4-->
        <div class="row container div_tareas" id="C4E2T"> 
            <div class="col s12 m12" >
                <ul class="collection with-header">
                    <li class="collection-header"><h4>Tareas de la evidencia 2</h4></li>
                    <li class="collection-item">
                        Expresa a través de medios digitales sus contenidos, presentaciones y producciones
                    </li>
                    <li class="collection-item">
                        Genera su portafolio digital de trabajos académicos.  
                    </li>  
                </ul>
            </div>
        </div>
    
        <!--TAREAS DE EVIDENCIA 3 COMPETENCIA 4-->
        <div class="row container div_tareas" id="C4E3T"> 
            <div class="col s12 m12" >
                <ul class="collection with-header">
                    <li class="collection-header"><h4>Tareas de la evidencia 3</h4></li>
                    <li class="collection-item">
                        Describe las diferencias entre las licencias copyright, creative commons, copyleft y dominio público. 
                    </li>
                    <li class="collection-item">
                        Indica los derechos de autor y propiedad intelectual en el manejo de contenidos digitales. 
                    </li> 
                    <li class="collection-item">
                        Licencia su propia producción de propiedad intelectual.  
                    </li>                        
                </ul>
            </div>
        </div>

        
        <br><br>   
    </main>
   
    <?php include './../footer.php'; ?>
        
    <script src="../../js/jquery-341.js"></script>
    <script src="../../js/materialize.js"></script> 
    <script src="../../js/sweetalert2.all.js"></script> 
    <script src="funciones.js"></script>   
    <script src="./js/curricularJs.js"></script>
   
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