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

        <link rel="stylesheet" href="../../css/valida-prg.css">
        <link rel="stylesheet" href="../../css/materialize.css">
        <link rel="stylesheet" href="../../css/sweetalert2.css">

        <link rel="stylesheet" href="css/curricular.scss">

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">   

    </head>
    <body class="ToolsticBlanco" >
    <div class="navbar-fixed">
    <nav class="ToolsticBlanco z-depth-2">
        <div class="nav-wrapper">
            <a href="#" class="brand-logo center"><img src="../../img/logotipo.png" width="250px"></a> 
            <ul id="nav-mobile" class="left">
                <li><a href="#" data-target="slide-out" id="menu_nav" class="sidenav-trigger"><i class="material-icons">menu</i></a></li>                
            </ul>
            
            <li></li>
        </div>
    </nav> 
    </div>
     <?php 
            include 'menu_Docente.php';
        ?>
       
    <br><br>
    <main>
        
        <div class="row">
            <div class="col s12 m12">
                <div class="card">
                    <div class="card-content container center  ">
                        <h5 class="ToolsticAzul-text">Propuesta educativa MBE</h5><br>
                        <div class="container center">
                        <p style="text-align:justify"> 
                        Para cada una de las competencias seleccionadas, se formularon las afirmaciones con sus correspondientes evidencias. Así mismo, se formularon las tareas que corresponden y dan razón del conocer, del saber, del ser y las acciones de pensamiento específico por cuyo despliegue se debe indagar en las preguntas que son requeridas para recolectar las evidencias (Magisterio, 2016). Como resultado del proceso se obtuvieron varias matrices, las cuales conforman las especificaciones que orientan la construcción de los instrumentos de evaluación para el diseño de la prueba y el curso.<br> <br>
                        
                         De acuerdo a lo anterior, el proceso evaluativo hace parte esencial de la formación del estudiante y tiene, entre otras funciones, la de proporcionar información sobre la efectividad del proceso de enseñanza y aprendizaje que está siendo desarrollado. En este sentido, el modelo basado en evidencias (MBE) permite articular de una manera más directa los resultados de aprendizaje esperados con el desempeño alcanzado por los estudiantes.  <br> <br>
                        
                        El Modelo basado en Evidencias (MBE), ha sido complementado con el Diseño Centrado en Evidencias (DCE), empleado actualmente por el Instituto Colombiano para la Evaluación de la Educación (Icfes) en la creación, aplicación y uso de instrumentos de evaluación o pruebas. El complemento que el DCE hace al MBE se trata básicamente, de agregar un estrato el cual es denominado: definición de la competencia, ubicado antes de los estratos de la afirmación, evidencias y tareas; con el fin de dar una explicación más clara de lo que el estudiante debe ser capaz de alcanzar o demostrar en una determinada actividad o prueba. <br> <br>
                        
                        De esta manera, para obtener resultados confiables en una evaluación es necesario que las dimensiones conceptuales, cognitivas y los logros que definen cada nivel de desempeño a evaluar estén adecuadamente representados en especificaciones de contenido, pues es en éstas en donde se apoyarán las interpretaciones que se hagan de los resultados de una evaluación (Magisterio, 2016). <br> <br>
                        
                        Teniendo en cuenta lo anterior, se pretende que el curso de Competencias en Lenguaje y Herramientas Informáticas aporte en la adquisición y desarrollo de competencias y habilidades digitales e informáticas en los estudiantes de la Universidad de Nariño. Para cumplir con este propósito se plantea la siguiente propuesta educativa:
                         <br>  </p>
                        </div>
                        <br><br>

                    </div>
                    <div class="container show-on-small hide-on-med-and-up center ToolsticAzul">
                        <p><br><i class="medium material-icons white-text">screen_rotation </i></p><hr>
                        <a class="white-text">                                                     
                            Para un mejor visualización gire su dispotivo de manera Horizontal                      
                        </a>
                    </div> <br>
                    <ul class="collapsible popout">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">find_in_page</i><span>ALFABETIZACIÓN INFORMACIONAL</span> <hr><b>Peso: <a class="btn ToolsticAzul">25%</a></b></div>
                            <!-- CONTENIDO COMPETENCIA 1 highlight -->
                            <div class="collapsible-body">
                                <table class=" highlightTD centered">
                                    <tbody>
                                        <tr>
                                            <td width="25%" class="ToolsticAzul white-text"> <b>Definición</b></td>
                                            <td colspan="3"> Capacidad de una persona para saber cuándo y por qué necesita información, dónde encontrarla, y cómo evaluarla, utilizarla y comunicarla de manera ética. Se considera un prerrequisito para participar eficazmente en la Sociedad de la Información.</td>   
                                        </tr>
                                        <tr>
                                            <td class="ToolsticVerde white-text"> <b>Afirmación</b></td>
                                            <td colspan="3"> Gestiona la información encontrada en la red, evaluando su finalidad y relevancia para la realización de trabajos en su labor académica. </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="ToolsticAzul white-text"><b>Evidencias</b></td>
                                        </tr>
                                        <tr>
                                            <td class=""> Busca información y contenidos digitales desde diferentes dispositivos a través de servicios en línea. </td>

                                            <td class=""> Almacena información y contenidos digitales desde diferentes dispositivos a través de servicios en línea. </td>

                                            <td class=""> Recupera información y contenidos digitales desde diferentes dispositivos a través de herramientas digitales. </td>

                                            <td class=""> Filtra información y contenidos digitales desde diferentes dispositivos a través de servicios en línea. </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="ToolsticAzul white-text"><b>Tareas</b></td>
                                        </tr>
                                        <tr>
                                            <td class=""> 
                                                <ul class="collection">
                                                    <li class="collection-item grey lighten-3">Configura motores de búsqueda para encontrar información. </li>
                                                    <li class="collection-item">Clasifica los servicios que ofrecen los motores de búsqueda.  </li>
                                                    <li class="collection-item grey lighten-3">Utiliza metabuscadores para encontrar información.  </li>
                                                    <li class="collection-item ">Busca información confiable en fuentes académicas.   </li>
                                                    <li class="collection-item grey lighten-3">Realiza búsquedas avanzadas en los diferentes motores de búsqueda.  </li>
                                                </ul>
                                            </td>

                                            <td class=""> 
                                                <ul class="collection">
                                                    <li class="collection-item grey lighten-3">Sincroniza el almacenamiento en la nube con el almacenamiento local. </li>
                                                    <li class="collection-item">Guarda información en diferentes servidores de almacenamiento. </li>
                                                    <li class="collection-item grey lighten-3">Descarga información en diferentes formatos y la almacena de forma local y en la nube. </li>
                                                    <li class="collection-item">Ordena la información en la nube de acuerdo a su formato.</li>
                                                    <li class="collection-item grey lighten-3">Realiza copias de seguridad desde diversos dispositivos.</li>
                                                </ul>
                                            </td>

                                            <td class=""> 
                                                <ul class="collection">
                                                    <li class="collection-item grey lighten-3">Visualiza información con el uso de software especializado. </li>
                                                    <li class="collection-item">Restaura información de diferentes medios de almacenamiento. </li>
                                                    <li class="collection-item grey lighten-3">Recupera copias de seguridad guardadas de forma local y en la nube. </li>
                                                    <li class="collection-item">Cambia el formato de archivos gestionando la información. </li>
                                                </ul>
                                            </td>

                                            <td class="">
                                                <ul class="collection ">
                                                    <li class="collection-item grey lighten-3">Utiliza marcadores sociales para organizar las búsquedas. </li>
                                                    <li class="collection-item">Aplica un modelo para evaluar la información encontrada en la red. </li>
                                                    <li class="collection-item grey lighten-3">Realiza curación de contenido para validar la información. </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- FIN DEL CONTENIDO COMPETENCIA 1 -->
                        </li> <br>
                            <!-- ************************  -->
                        <li>
                            <div class="collapsible-header"><i class="material-icons">bug_report</i> <span>RESOLUCIÓN DE PROBLEMAS CON EL USO DE RECURSOS COMPUTACIONALES</span> <hr><b>Peso: <a class="btn ToolsticAzul">25%</a></b></div>
                            <!-- CONTENIDO COMPETENCIA 2 -->
                            <div class="collapsible-body">
                            <table class=" highlightTD centered">
                                    <tbody>
                                        <tr>
                                            <td width="33.33%" class="ToolsticAzul white-text"> <b>Definición</b></td>
                                            <td colspan="2"> Capacidad de una persona para combinar diferentes conocimientos, habilidades y recursos computacionales físicos y digitales adquiridos de manera previa para dar solución a una situación nueva. </td>   
                                        </tr>
                                        <tr>
                                            <td class="ToolsticVerde white-text"> <b>Afirmación</b></td>
                                            <td colspan="2"> Identifica necesidades y recursos computacionales apropiados para resolver problemas conceptuales y técnicos a través de medios digitales encontrados en la red. </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="ToolsticAzul white-text"><b>Evidencias</b></td>
                                        </tr>
                                        <tr>
                                            <td class=""> Identifica problemas técnicos en diferentes dispositivos a través de entornos digitales. </td>
                                            <td class=""> Selecciona herramientas informáticas para dar solución a problemas técnicos a través de entornos digitales </td>
                                            <td class=""> Utiliza herramientas apropiadas para resolver las necesidades técnicas detectadas a través de entornos digitales. </td>
                                            
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="ToolsticAzul white-text"><b>Tareas</b></td>
                                        </tr>
                                        <tr>
                                            <td class=""> 
                                                <ul class="collection">
                                                    <li class="collection-item grey lighten-3">Reconoce las características a nivel de hardware y software que conforman a los dispositivos de cómputo de uso habitual. </li>
                                                    <li class="collection-item">Explica en que consiste el mal funcionamiento de un dispositivo de cómputo. </li>
                                                    <li class="collection-item grey lighten-3">Lista los problemas más comunes presentes en los dispositivos de cómputo. </li>
                                                    <li class="collection-item">Clasifica las diferentes opciones para dar solución a un problema técnico en específico.</li>
                                                </ul>
                                            </td>

                                            <td class=""> 
                                                <ul class="collection">
                                                    <li class="collection-item grey lighten-3">Busca herramientas para diagnosticar posibles errores de hardware y software. </li>
                                                    <li class="collection-item">Clasifica el software apropiado que permite solucionar un determinado problema. </li>
                                                    <li class="collection-item grey lighten-3">Administra herramientas adecuadas para el mantenimiento de un dispositivo electrónico.</li> 
                                                </ul>
                                            </td>

                                            <td class="">
                                                <ul class="collection">
                                                    <li class="collection-item grey lighten-3">Utiliza herramientas digitales para detectar virus informático en los dispositivos. </li>
                                                    <li class="collection-item">Realiza configuraciones adecuadas en los dispositivos para su correcto funcionamiento y utilización. </li>
                                                    <li class="collection-item grey lighten-3">Aplica los diferentes tipos de mantenimiento para prevenir y solucionar problemas técnicos.  </li>
                                                    <li class="collection-item">Configura entornos digitales para solucionar problemas técnicos específicos.</li>
                                                </ul>
                                            </td>                                            
                                        </tr>
                                    </tbody>
                                </table>    

                            </div>
                            <!-- FIN DEL CONTENIDO COMPETENCIA 2 -->
                        </li> <br>
                            <!-- ************************  -->
                        <li>
                            <div class="collapsible-header"><i class="material-icons">record_voice_over</i><span>COMUNICACIÓN Y COLABORACIÓN EN ENTORNOS DIGITALES</span> <hr><b>Peso: <a class="btn ToolsticAzul">25%</a></b></div>
                            <!-- CONTENIDO COMPETENCIA 3 -->
                            <div class="collapsible-body">
                            <table class=" highlightTD centered">
                                    <tbody>
                                        <tr>
                                            <td width="25%" class="ToolsticAzul white-text"> <b>Definición</b></td>
                                            <td colspan="3"> Capacidad de una persona para comunicar y compartir información por medio de herramientas en línea conectando con otros e interactuando en entornos y redes digitales. </td>   
                                        </tr>
                                        <tr>
                                            <td class="ToolsticVerde white-text"> <b>Afirmación</b></td>
                                            <td colspan="3"> Comunica información en entornos digitales a través de herramientas en línea interactuando activamente en comunidades digitales. </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="ToolsticAzul white-text"><b>Evidencias</b></td>
                                        </tr>
                                        <tr>
                                            <td class=""> Interactúa con comunidades digitales a través de herramientas en línea para difundir información. </td>
                                            <td class=""> Comparte información en comunidades digitales a través de herramientas en línea. </td>
                                            <td class=""> Identifica las normas de comportamiento en entornos digitales para interactuar a través de la red. </td>
                                            <td class=""> Gestiona la identidad digital protegiendo datos personales que se proporcionan a través de la red. </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="ToolsticAzul white-text"><b>Tareas</b></td>
                                        </tr>
                                        <tr>
                                            <td class=""> 
                                                <ul class="collection">
                                                    <li class="collection-item grey lighten-3">Lista los beneficios de las comunidades digitales y la importancia de la colaboración en red. </li>
                                                    <li class="collection-item">Clasifica los medios de comunicación digital sincrónicos y asincrónicos. </li>
                                                    <li class="collection-item grey lighten-3">Utiliza diferentes canales de comunicación en entornos digitales. </li>
                                                    <li class="collection-item">Crea espacios en la web, como blogs, wikis, foros o grupos sociales. </li>
                                                </ul>
                                            </td>

                                            <td class=""> 
                                                <ul class="collection">
                                                    <li class="collection-item grey lighten-3">Clasifica herramientas que faciliten la comunicación y la participación en línea. </li>
                                                    <li class="collection-item">Realiza publicaciones en internet respetando las normas establecidas. </li>
                                                    <li class="collection-item grey lighten-3">Utiliza aplicaciones y documentos compartidos para trabajar simultáneamente. </li>
                                                </ul>
                                            </td>

                                            <td class=""> 
                                                <ul class="collection">
                                                    <li class="collection-item grey lighten-3">Aplica las reglas básicas de comunicación en la red. </li>
                                                    <li class="collection-item">Adopta estrategias para protegerse de los peligros en la red. </li>
                                                    <li class="collection-item grey lighten-3">Evita conductas inadecuadas para sí mismo y los demás en entornos digitales.</li>  
                                                </ul>
                                            </td>

                                            <td class=""> 
                                                <ul class="collection">
                                                    <li class="collection-item grey lighten-3">Categoriza los beneficios y peligros de poseer una identidad digital. </li>
                                                    <li class="collection-item">Crea una identidad digital de forma adecuada en diferentes comunidades en línea.</li>
                                                    <li class="collection-item grey lighten-3">Administra las configuraciones pertinentes de su identidad digital.</li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- FIN DEL CONTENIDO COMPETENCIA 3 -->
                        </li> <br>
                            <!-- ************************  -->
                        <li>
                            <div class="collapsible-header"><i class="material-icons">widgets</i> <span>CREACIÓN Y PUBLICACIÓN DE CONTENIDOS DIGITALES </span><hr><b>Peso: <a class="btn ToolsticAzul">25%</a> </b></div>
                            <!-- CONTENIDO COMPETENCIA 4 -->
                            <div class="collapsible-body">
                            <table class=" highlightTD centered">
                                    <tbody>
                                        <tr>
                                            <td width="33.33%" class="ToolsticAzul white-text"> <b>Definición</b></td>
                                            <td colspan="2"> Capacidad de una persona para crear y publicar contenidos digitales, integrando conocimientos y recursos previos en la producción de contenido multimedia aplicando correctamente los derechos de propiedad intelectual. </td>   
                                        </tr>
                                        <tr>
                                            <td class="ToolsticVerde white-text"> <b>Afirmación</b></td>
                                            <td colspan="2">Desarrolla contenidos multimediales y respeta los derechos de propiedad intelectual al utilizar bancos de recursos digitales en su labor académica. </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="ToolsticAzul white-text"><b>Evidencias</b></td>
                                        </tr>
                                        <tr>
                                            <td class=""> Integra recursos digitales existentes en la creación de contenido nuevo mediante herramientas de edición audiovisual y gráfica. </td>
                                            <td class=""> Publica contenidos en diferentes formatos como productos multimedia a través de medios digitales.  </td>
                                            <td class=""> Aplica derechos de autor a la información encontrada en la red y divulga contenidos a través de diferentes plataformas digitales.</td>                                          
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="ToolsticAzul white-text"><b>Tareas</b></td>
                                        </tr>
                                        <tr>
                                            <td class=""> 
                                                <ul class="collection">
                                                    <li class="collection-item grey lighten-3">Clasifica herramientas que permiten crear contenido multimedia. </li>
                                                    <li class="collection-item">Crea contenido digital en diferentes formatos. </li>
                                                    <li class="collection-item grey lighten-3">Indica las principales características de diferentes recursos multimediales.</li>
                                                    <li class="collection-item">Diseña presentaciones que incluyen diferentes medios digitales o físicos. </li>
                                                    <li class="collection-item grey lighten-3">Utiliza organizadores gráficos para presentar información. </li>
                                                    <li class="collection-item">Categoriza bases de datos de recursos que pueden recombinarse y reutilizarse. </li>
                                                    <li class="collection-item grey lighten-3">Utiliza programas y servicios offline y online para editar contenido multimedial. </li>
                                                    
                                                </ul> 
                                            </td>

                                            <td class="">
                                                <ul class="collection">
                                                    <li class="collection-item grey lighten-3">Selecciona herramientas que permiten publicar contenido multimedia. </li>
                                                    <li class="collection-item">Expresa a través de medios digitales sus contenidos, presentaciones y producciones. </li>
                                                    <li class="collection-item grey lighten-3">Presenta la información de manera ordenada y fácil de entender. </li>
                                                    <li class="collection-item">Genera su portafolio digital de trabajos académicos.  </li>
                                                </ul> 
                                            </td>

                                            <td class=""> 
                                                <ul class="collection">
                                                    <li class="collection-item grey lighten-3">Encuentra información sobre normativa relacionada con derechos de autor y licencias. </li>
                                                    <li class="collection-item">Describe las diferencias entre las licencias copyright, creative commons, copyleft y dominio público. </li>
                                                    <li class="collection-item grey lighten-3">Indica los derechos de autor y propiedad intelectual en el manejo de contenidos digitales. </li>
                                                    <li class="collection-item">Utiliza recursos digitales de libre explotación. </li>
                                                    <li class="collection-item grey lighten-3">Licencia su propia producción de propiedad intelectual.  </li>
                                                    <li class="collection-item">Atribuye la autoría de los materiales digitales difundidos en la red </li>
                                                </ul> 
                                            </td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- FIN DEL CONTENIDO COMPETENCIA 4 -->
                        </li>
                    </ul>
                    <br>
                    
                </div>
            </div>
        </div>
        
    
    </main>
   
    <footer class="page-footer ToolsticAzul ">
        <div class="footer-copyright ToolsticRojo">
            <div class="container ">                
                <span class="center-align color-texto-claro-primario"><i class="material-icons">copyright</i> <b>2014 | Todos los derechos reservados</b></span>
                <a class="grey-text text-lighten-4 right color-texto-claro-primario" href="#!">@ToolsTic</a>
            </div>
        </div>
    </footer>
        
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
            });
            
            mostrarDatos();
            agregaDatosEdicion(<?php echo $userlog['id_usuario']; ?>);
        });  
        
        
    </script>
    
      
    </body>
</html>