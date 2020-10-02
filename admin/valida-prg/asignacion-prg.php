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
        <title>Asignar Preguntas | ToolsTic</title>
        <link rel="icon" type="image/png" href="../../img/favUdenar.png">
        <link rel="stylesheet" href="../../css/valida-prg.css">
        <link rel="stylesheet" href="../../css/materialize.css">
        <link rel="stylesheet" href="../../css/sweetalert2.css">

        <link rel="stylesheet" href="css/curricular.scss">

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
        include 'menu_Docente.php';
        require './../conex.php';
        include './php/fetch_records.php';
    ?>      
    
    <main>
    
    <div class="row container">
        <div class="col s12 m12 l8 push-l2 center">
            <p>
                A continuación se presentan las preguntas que aún no han sido validadas ni acepatas por un Docente Experto Temático, por favor por cada competencia asigne las preguntas al docente correspondiente.
            </p>
        </div>    
    </div>
    
    <div class="row">
        <div class="col s12 m10 push-m1">
    
        <ul class="collapsible">
            <li>
                <div class="collapsible-header">
                    <i class="material-icons" style="padding-top: 10px;">assignment</i>
                    <b style="padding-top: 10px;">ALFABETIZACIÓN INFORMACIONAL</b> <hr>
                    <?php 
                        $CuentaTPSV = count(PreguntasSinAsignar(1, $conex)); 
                        if($CuentaTPSV > 0) { ?>
                            <span class="new red badge" data-badge-caption="Sin asignar" style="padding-top: 0px; margin-left: 0px;margin-right: 10px;"><?php echo $CuentaTPSV;?> &nbsp;</span>
                    <?php }  ?>
                    <a class="btn ToolsTic_Blue white-text">C1</a>
                    
                </div>
                <div class="collapsible-body">
                    <table class="centered highlight responsive-table ">
                        <thead>
                        <tr>
                            <th width="2%"> # </th>
                            <th width="15%">Cod. Pregunta</th>
                            <th width="22%">Creador</th>
                            <th width="20%">Fecha Creación</th>
                            <th width="16%">Estado</th>
                            <th width="25%">Docente Asignado</th>
                        </tr>
                        </thead>

                        <tbody>
                            <?php
                            $ResultPreguntas = PreguntasSinAsignar(1, $conex);
                            $numResultados = count($ResultPreguntas);  
                            if($numResultados < 1){
                                echo '<td colspan="6">No hay preguntas sin asignar para esta competencia</td>';
                            } else { 
                                for($rows = 0; $rows < $numResultados; $rows ++) { ?>
                                <tr>                                
                                    <td>
                                        <?php echo $rows+1; ?>   
                                    </td>
                                    <td><?php echo $ResultPreguntas[$rows]['cod_pregunta'];?></td>
                                    <td>
                                        <?php echo $ResultPreguntas[$rows]['nombres_usuario'];?> <?php echo $ResultPreguntas[$rows]['apellidos_usuario'];?>
                                    </td>
                                    <?php 
                                        date_default_timezone_set('America/Bogota');
                                        list($fecha, $hora) = explode(" ",$ResultPreguntas[$rows]['fecha_creacion_pregunta']);
                                        $arrayDate = array("fecha"=>$fecha, "hora"=>$hora);
                                    ?>
                                    <td><?php echo strftime("%d de %b del %Y",strtotime($arrayDate['fecha']));?></td>
                                    <td>
                                        <a class="btn red">
                                            <?php echo $ResultPreguntas[$rows]['estado_pregunta'];?></td>
                                        </a>
                                    <td>
                                    <?php 
                                        $ListadoDocentes =  ListDocentesET($conex);
                                        $numDocentes = count($ListadoDocentes);
                                        if ($numDocentes < 1) {
                                            echo '<a class="btn red">No hay docentes</a>';
                                        } else { 
                                            $Ii_pregunta = $ResultPreguntas[$rows]['id_pregunta'];
                                            $idForSelct = "SelectDocePrg_".$Ii_pregunta;
                                            ?>
                                            <div id="SelectDocente_1"  class="input-field col s12">
                                                <select id="<?php echo $idForSelct;?>" onchange="FuncionAsignaDocente(this.id, <?php echo $Ii_pregunta;?>)">
                                                <option value="0" disabled>Seleccione un docente</option>
                                                <option value="1" selected>Sin Asignar</option>
                                                <?php 
                                                    for($i =0 ; $i < $numDocentes; $i ++){ ?>
                                                        <option value="<?php echo $ListadoDocentes[$i]['id_usuario']; ?>"><?php echo utf8_encode($ListadoDocentes[$i]['nombres_usuario']);?>  <?php echo utf8_encode($ListadoDocentes[$i]['apellidos_usuario']);?></option>';
                                                    <?php }
                                                ?>  
                                                </select>
                                            </div>
                                    <?php }  ?>
                                    </td>
                                </tr> 
                            <?php } //fin for
                            }//fin else?>         
                        </tbody>
                    </table>
                </div> <!-- FIN DEL  collapsible-body -->
            </li>

            <li>
                <div class="collapsible-header">
                    <i class="material-icons" style="padding-top: 10px;">build</i>
                    <b style="padding-top: 10px;">RESOLUCIÓN DE PROBLEMAS CON EL USO DE RECURSOS COMPUTACIONALES</b> <hr>
                    <?php 
                        $CuentaTPSV = count(PreguntasSinAsignar(2, $conex)); 
                        if($CuentaTPSV > 0) { ?>
                            <span class="new red badge" data-badge-caption="Sin asignar" style="padding-top: 0px; margin-left: 0px;margin-right: 10px;"><?php echo $CuentaTPSV;?> &nbsp;</span>
                    <?php }  ?>
                    <a class="btn ToolsTic_Blue white-text">C2</a>
                </div>
                <div class="collapsible-body">
                    <table class="centered highlight responsive-table ">
                        <thead>
                        <tr>
                            <th width="2%"> # </th>
                            <th width="15%">Cod. Pregunta</th>
                            <th width="22%">Creador</th>
                            <th width="20%">Fecha Creación</th>
                            <th width="16%">Estado</th>
                            <th width="25%">Docente Asignado</th>
                        </tr>
                        </thead>

                        <tbody>
                            <?php
                            $ResultPreguntas = PreguntasSinAsignar(2, $conex);
                            $numResultados = count($ResultPreguntas);  
                            if($numResultados < 1){
                                echo '<td colspan="6">No hay preguntas sin asignar para esta competencia</td>';
                            } else { 
                                for($rows = 0; $rows < $numResultados; $rows ++) { ?>
                                <tr>                                
                                    <td>
                                        <?php echo $rows+1; ?>   
                                    </td>
                                    <td><?php echo $ResultPreguntas[$rows]['cod_pregunta'];?></td>
                                    <td>
                                        <?php echo $ResultPreguntas[$rows]['nombres_usuario'];?> <?php echo $ResultPreguntas[$rows]['apellidos_usuario'];?>
                                    </td>
                                    <?php 
                                        date_default_timezone_set('America/Bogota');
                                        list($fecha, $hora) = explode(" ",$ResultPreguntas[$rows]['fecha_creacion_pregunta']);
                                        $arrayDate = array("fecha"=>$fecha, "hora"=>$hora);
                                    ?>
                                    <td><?php echo strftime("%d de %b del %Y",strtotime($arrayDate['fecha']));?></td>
                                    <td>
                                        <a class="btn red">
                                            <?php echo $ResultPreguntas[$rows]['estado_pregunta'];?></td>
                                        </a>
                                    <td>
                                    <?php 
                                        $ListadoDocentes =  ListDocentesET($conex);
                                        $numDocentes = count($ListadoDocentes);
                                        if ($numDocentes < 1) {
                                            echo '<a class="btn red">No hay docentes</a>';
                                        } else { 
                                            $Ii_pregunta = $ResultPreguntas[$rows]['id_pregunta'];
                                            $idForSelct = "SelectDocePrg_".$Ii_pregunta;
                                            ?>

                                            <div id="SelectDocente_2"  class="input-field col s12">
                                                <select id="<?php echo $idForSelct;?>" onchange="FuncionAsignaDocente(this.id, <?php echo $Ii_pregunta;?>)">
                                                <option value="0" disabled>Seleccione un docente</option>
                                                <option value="1" selected>Sin Asignar</option>
                                                <?php 
                                                    for($i =0 ; $i < $numDocentes; $i ++){ ?>
                                                        <option value="<?php echo $ListadoDocentes[$i]['id_usuario']; ?>"><?php echo utf8_encode($ListadoDocentes[$i]['nombres_usuario']);?>  <?php echo utf8_encode($ListadoDocentes[$i]['apellidos_usuario']);?></option>';
                                                    <?php }
                                                ?>  
                                                </select>
                                            </div>
                                            
                                    <?php }  ?>
                                    </td>
                                </tr> 
                            <?php } //fin for
                            }//fin else?>         
                        </tbody>
                    </table>
                </div> <!-- FIN DEL  collapsible-body -->
            </li>

            <li>
                <div class="collapsible-header">
                    <i class="material-icons" style="padding-top: 10px;">language</i>
                    <b style="padding-top: 10px;">COMUNICACIÓN Y COLABORACIÓN EN ENTORNOS DIGITALES</b> <hr>
                    <?php 
                        $CuentaTPSV = count(PreguntasSinAsignar(3, $conex)); 
                        if($CuentaTPSV > 0) { ?>
                            <span class="new red badge" data-badge-caption="Sin asignar" style="padding-top: 0px; margin-left: 0px;margin-right: 10px;"><?php echo $CuentaTPSV;?> &nbsp;</span>
                    <?php }  ?>
                    <a class="btn ToolsTic_Blue white-text">C3</a>
                </div>
                <div class="collapsible-body">
                    <table class="centered highlight responsive-table ">
                        <thead>
                        <tr>
                            <th width="2%"> # </th>
                            <th width="15%">Cod. Pregunta</th>
                            <th width="22%">Creador</th>
                            <th width="20%">Fecha Creación</th>
                            <th width="16%">Estado</th>
                            <th width="25%">Docente Asignado</th>
                        </tr>
                        </thead>

                        <tbody>
                            <?php
                            $ResultPreguntas = PreguntasSinAsignar(3, $conex);
                            $numResultados = count($ResultPreguntas);  
                            if($numResultados < 1){
                                echo '<td colspan="6">No hay preguntas sin asignar para esta competencia</td>';
                            } else { 
                                for($rows = 0; $rows < $numResultados; $rows ++) { ?>
                                <tr>                                
                                    <td>
                                        <?php echo $rows+1; ?>   
                                    </td>
                                    <td><?php echo $ResultPreguntas[$rows]['cod_pregunta'];?></td>
                                    <td>
                                        <?php echo $ResultPreguntas[$rows]['nombres_usuario'];?> <?php echo $ResultPreguntas[$rows]['apellidos_usuario'];?>
                                    </td>
                                    <?php 
                                        date_default_timezone_set('America/Bogota');
                                        list($fecha, $hora) = explode(" ",$ResultPreguntas[$rows]['fecha_creacion_pregunta']);
                                        $arrayDate = array("fecha"=>$fecha, "hora"=>$hora);
                                    ?>
                                    <td><?php echo strftime("%d de %b del %Y",strtotime($arrayDate['fecha']));?></td>
                                    <td>
                                        <a class="btn red">
                                            <?php echo $ResultPreguntas[$rows]['estado_pregunta'];?></td>
                                        </a>
                                    <td>
                                    <?php 
                                        $ListadoDocentes =  ListDocentesET($conex);
                                        $numDocentes = count($ListadoDocentes);
                                        if ($numDocentes < 1) {
                                            echo '<a class="btn red">No hay docentes</a>';
                                        } else { 
                                            $Ii_pregunta = $ResultPreguntas[$rows]['id_pregunta'];
                                            $idForSelct = "SelectDocePrg_".$Ii_pregunta;
                                            ?>
                                            <div id="SelectDocente_3"  class="input-field col s12">
                                                <select id="<?php echo $idForSelct;?>" onchange="FuncionAsignaDocente(this.id, <?php echo $Ii_pregunta;?>)">
                                                <option value="0" disabled>Seleccione un docente</option>
                                                <option value="1" selected>Sin Asignar</option>
                                                <?php 
                                                    for($i =0 ; $i < $numDocentes; $i ++){ ?>
                                                        <option value="<?php echo $ListadoDocentes[$i]['id_usuario']; ?>"><?php echo utf8_encode($ListadoDocentes[$i]['nombres_usuario']);?>  <?php echo utf8_encode($ListadoDocentes[$i]['apellidos_usuario']);?></option>';
                                                    <?php }
                                                ?>  
                                                </select>
                                            </div>
                                    <?php }  ?>
                                    </td>
                                </tr> 
                            <?php } //fin for
                            }//fin else?>         
                        </tbody>
                    </table>
                </div> <!-- FIN DEL  collapsible-body -->
            </li>

            <li>
                <div class="collapsible-header">
                    <i class="material-icons" style="padding-top: 10px;">format_paint</i>
                    <b style="padding-top: 10px;">CREACIÓN Y PUBLICACIÓN DE CONTENIDOS DIGITALES</b> <hr>
                    <?php 
                        $CuentaTPSV = count(PreguntasSinAsignar(4, $conex)); 
                        if($CuentaTPSV > 0) { ?>
                            <span class="new red badge" data-badge-caption="Sin asignar" style="padding-top: 0px; margin-left: 0px;margin-right: 10px;"><?php echo $CuentaTPSV;?> &nbsp;</span>
                    <?php }  ?>
                    <a class="btn ToolsTic_Blue white-text">C4</a>
                </div>
                <div class="collapsible-body">
                    <table class="centered highlight responsive-table ">
                        <thead>
                        <tr>
                            <th width="2%"> # </th>
                            <th width="15%">Cod. Pregunta</th>
                            <th width="22%">Creador</th>
                            <th width="20%">Fecha Creación</th>
                            <th width="16%">Estado</th>
                            <th width="25%">Docente Asignado</th>
                        </tr>
                        </thead>

                        <tbody>
                            <?php
                            $ResultPreguntas = PreguntasSinAsignar(4, $conex);
                            $numResultados = count($ResultPreguntas);  
                            if($numResultados < 1){
                                echo '<td colspan="6">No hay preguntas sin asignar para esta competencia</td>';
                            } else { 
                                for($rows = 0; $rows < $numResultados; $rows ++) { ?>
                                <tr>                                
                                    <td>
                                        <?php echo $rows+1; ?>   
                                    </td>
                                    <td><?php echo $ResultPreguntas[$rows]['cod_pregunta'];?></td>
                                    <td>
                                        <?php echo $ResultPreguntas[$rows]['nombres_usuario'];?> <?php echo $ResultPreguntas[$rows]['apellidos_usuario'];?>
                                    </td>
                                    <?php 
                                        date_default_timezone_set('America/Bogota');
                                        list($fecha, $hora) = explode(" ",$ResultPreguntas[$rows]['fecha_creacion_pregunta']);
                                        $arrayDate = array("fecha"=>$fecha, "hora"=>$hora);
                                    ?>
                                    <td><?php echo strftime("%d de %b del %Y",strtotime($arrayDate['fecha']));?></td>
                                    <td>
                                        <a class="btn red">
                                            <?php echo $ResultPreguntas[$rows]['estado_pregunta'];?></td>
                                        </a>
                                    <td>
                                    <?php 
                                        $ListadoDocentes =  ListDocentesET($conex);
                                        $numDocentes = count($ListadoDocentes);
                                        if ($numDocentes < 1) {
                                            echo '<a class="btn red">No hay docentes</a>';
                                        } else { 
                                            $Ii_pregunta = $ResultPreguntas[$rows]['id_pregunta'];
                                            $idForSelct = "SelectDocePrg_".$Ii_pregunta;
                                            ?>
                                            <div id="SelectDocente_4"  class="input-field col s12">
                                                <select id="<?php echo $idForSelct;?>" onchange="FuncionAsignaDocente(this.id, <?php echo $Ii_pregunta;?>)">
                                                <option value="0" disabled>Seleccione un docente</option>
                                                <option value="1" selected>Sin Asignar</option>
                                                <?php 
                                                    for($i =0 ; $i < $numDocentes; $i ++){ ?>
                                                        <option value="<?php echo $ListadoDocentes[$i]['id_usuario']; ?>"><?php echo utf8_encode($ListadoDocentes[$i]['nombres_usuario']);?>  <?php echo utf8_encode($ListadoDocentes[$i]['apellidos_usuario']);?></option>';
                                                    <?php }
                                                ?>  
                                                </select>
                                            </div>
                                    <?php }  ?>
                                    </td>
                                </tr> 
                            <?php } //fin for
                            }//fin else?>         
                        </tbody>
                    </table>
                </div> <!-- FIN DEL  collapsible-body -->
            </li>
        </ul>  

        </div>  
    </div>

    
    
    




    </main>
   
    <?php include './../footer.php'; ?>
        
    <script src="../../js/jquery-341.js"></script>
    <script src="../../js/materialize.js"></script> 
    <script src="../../js/sweetalert2.all.js"></script> 
    <script src="funciones.js"></script>  
    <script src="./js/AsiganarPregunta.js"></script> 
   
    <script>
        $(document).ready(function(){
            M.AutoInit();

            Toast.fire({
              type: 'success',
              title: 'Usuario Conectado'
            });
            
            mostrarDatos();
            agregaDatosEdicion(<?php echo $userlog['id_usuario']; ?>);
        });  
        
        
    </script>
    
      
    </body>
</html>