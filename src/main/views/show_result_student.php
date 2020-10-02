
<?php 
    $ResultCuestEstu  = FullDataResulCuestEstu($conex, $userlog['cod_estudiante']);
    $FullDataInsc = FullDataInscEstu($conex, $EstudianteReload['cod_estudiante']);  

    $dataReport = new stdClass();

    //INFORMACION DE LA PRUEBA
    $dataReport->prueba = utf8_decode($FullDataInsc['prueba']);
    $dataReport->periodo_aplicacion = utf8_decode($FullDataInsc['periodo'])." - ".utf8_decode($FullDataInsc['year_periodo']);
    $dataReport->fecha_aplicacion = strftime("%d de %b del %Y",strtotime($FullDataInsc['fecha_aplicacion_prueba']));
    $dataReport->hora_aplicacion = ($FullDataInsc['horario_grupo']);
    $dataReport->sede_aplicacion = utf8_decode($FullDataInsc['sede']);
    $dataReport->lugar_presentacion = ($FullDataInsc['lugar_sede']);
    // DETALLE DE LA INSCRIPCIÓN
    $dataReport->grupo_inscripcion = ($FullDataInsc['grupo']);
    $dataReport->aula_presentacion = "Aula - ".($FullDataInsc['aula_grupo']);
    

    $datetime1 = new DateTime($FullCuestionario['inicio_cuestionario']);
    $datetime2 = new DateTime($FullCuestionario['fin_cuestionario']);
    $interval = $datetime1->diff($datetime2);

?>
<div class='row'>
    <div class="col s12 m12 l10 push-l1"> 

        <?php
            list($fechaIniCues, $horaIniCues) = explode(" ",$ResultCuestEstu['inicio_cuestionario']);
                                    
            $fechaInicioCues = strftime("%d de %b del %Y",strtotime($fechaIniCues));
            $horaInicioCues = strftime("%I:%M:%S %p",strtotime($horaIniCues));

            list($fechaFinCues, $horaFinCues) = explode(" ",$ResultCuestEstu['fin_cuestionario']);
                                    
            $fechaFinCuestionario = strftime("%d de %b del %Y",strtotime($fechaFinCues));
            $horaFinCuestionario = strftime("%I:%M:%S %p",strtotime($horaFinCues));
        ?>

        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>language</i>
            <input id='PruebaEstu' type='text' class='validate infoEstu' disabled value='<?php echo $dataReport->prueba ?>'>
            <label for='PruebaEstu' class="labelInfo">Prueba</label>
        </div>

        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>timelapse</i>
            <input id='PeriodoPerueba' type='text' class='validate infoEstu' disabled value='<?php echo $dataReport->periodo_aplicacion; ?>'>
            <label for='PeriodoPerueba' class="labelInfo">Periodo</label>
        </div>

        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>location_on</i>
            <input id='SedePrueba' type='text' class='validate infoEstu' disabled value='<?php echo $dataReport->sede_aplicacion;?>'>
            <label for='SedePrueba' class="labelInfo">Sede</label>
        </div>                        

        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>map</i>
            <input id='LugarSede' type='text' class='validate infoEstu' disabled value='<?php echo $dataReport->lugar_presentacion;?>'>
            <label for='LugarSede' class="labelInfo">Lugar de presentación</label>
        </div>

        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>supervisor_account</i>
            <input id='GrupoEstu' type='text' class='validate infoEstu' disabled value='<?php echo $dataReport->grupo_inscripcion;?>'>
            <label for='GrupoEstu' class="labelInfo">Grupo inscrito</label>
        </div>

        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>location_searching</i>
            <input id='AulaPrueba' type='text' class='validate infoEstu' disabled value='<?php echo $dataReport->aula_presentacion;?>'>
            <label for='AulaPrueba' class="labelInfo">Aula de presentación</label>
        </div>


        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>description</i>
            <input id='EstadoCuestionario' type='text' class='validate infoEstu' disabled value='<?php echo $ResultCuestEstu['estado_cuestionario'];?>'>
            <label for='EstadoCuestionario'>Estado cuestionario</label>
        </div>
        
        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>hourglass_full</i>
            <input id='FinCuestionario' type='text' class='validate infoEstu' disabled value='<?php echo ($interval->format('%H Horas %I Minutos %S Segundos.'));?>'>
            <label for='FinCuestionario'>Tiempo utilizado</label>
        </div>

        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>date_range</i>
            <input id='InicioCuestionario' type='text' class='validate infoEstu' disabled value='<?php echo $fechaInicioCues." a las ".$horaInicioCues;?>'>
            <label for='InicioCuestionario'>Inicio del cuestionario</label>
        </div>                            

        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>date_range</i>
            <input id='FinCuestionario' type='text' class='validate infoEstu' disabled value='<?php echo $fechaFinCuestionario." a las ".$horaFinCuestionario;?>'>
            <label for='FinCuestionario'>Fin del cuestionario</label>
        </div>

        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>graphic_eq</i>
            <input id='PuntajeObtenido' type='text' class='validate infoEstu' disabled value='<?php echo $Puntaje_Final ." / 5";?>'>
            <label for='PuntajeObtenido'>Nota final obtenida</label>
        </div>

        <div class='input-field col s12 m6'>
            <i class='material-icons prefix'>poll</i>
            <input id='FinCuestionario' type='text' class='validate infoEstu' disabled value='<?php echo $Nivel_Final; ?> '>
            <label for='FinCuestionario'>Desempeño global </label>
        </div>
        
    </div>
</div>


<br>

<div class="row">
    <div class= "col s12 m6 l3">
        <div class="card-panel center small  ToolsticBlanco ">
            <h5>Puntaje global</h5>
            <i class="medium material-icons blue-text">equalizer</i>
            <h3 style="margin-top: 0em;">
                <?php echo ($Puntaje_Final*100);?> <span class="grey-text" style="font-size:2rem">/ 500 <code style="font-size:1rem">Pts.</code></span> 
            </h3>
        </div>
    </div>

    <div class= "col s12 m6 l3">
        <div class="card-panel center small ToolsticBlanco ">
            <h5>Desempeño global</h5>
            <i class="medium material-icons blue-text">done_all</i>
            <h3 style="margin-top: 0em;">
                <?php echo ( $Nivel_Final );?> <span class="grey-text" style="font-size:2rem"> <code style="font-size:1rem">dg.</code></span> 
            </h3>
        </div>
    </div>
    
    <div class= "col s12 m6 l3">
        <div class="card-panel small center ToolsticBlanco ">
            <h5>Fortaleza Compe. <b><?php echo $arrayResuComp[0]['competencia'];?></b> </h5>
            <i class="medium material-icons green-text">arrow_upward</i>
            <h3 style="margin-top: 0em;">
                <?php echo ($arrayResuComp[0]['Puntaje']*100);?> <span class="grey-text" style="font-size:2rem">/ <?php echo $arrayResuComp[0]['NoPre'];?> <code style="font-size:1rem">Pts.</code></span> 
            </h3>
        </div>
    </div>

    <div class= "col s12 m6 l3">
        <div class="card-panel small center ToolsticBlanco ">
            <h5>Debilidad Compe. <b><?php echo $arrayResuComp[3]['competencia'];?></b></h5>
            <i class="medium material-icons red-text">arrow_downward</i>
            <h3 style="margin-top: 0em;">
                <?php echo ($arrayResuComp[3]['Puntaje']*100);?> <span class="grey-text" style="font-size:2rem">/ <?php echo $arrayResuComp[3]['NoPre'];?> <code style="font-size:1rem">Pts.</code></span> 
            </h3>
        </div>
    </div>
</div>
    

    
            
<div class="row" >

    <br> <br>    
        <div class="row center">
            <h4>Resultados detallados</h4>
        </div>
    <br> <br>

    <div class="col s12 m6 l3">
        <div class="card ">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" src="<?php echo ROOT_PUBLIC; ?>/img/comp_1.png">
            </div>
            <div class="card-content">
            <span class="card-title activator grey-text text-darken-4">
                <i class="material-icons right">more_vert</i>
            </span>
            <br>
            <div class="row">
                <span class="card-title activator title-compe">
                <b>C1</b> - Alfabetización Informacional
                </span>
                <hr>
                <div class="row center">
                    <h3 style="margin-top: 0.5em; margin-bottom: 0px; ">
                        <?php echo ($Puntaje_1*100);?> <span class="grey-text" style="font-size:2rem">/ 100 <code style="font-size:1rem">Pts.</code></span>               
                    </h3>
                    
                </div>
                
                <div class="row center start-i">
                <?php for($i = 1; $i <=4; $i++){
                    if($i <= $arrayCompetencias[0]['Estrellas']){
                        echo "<i class='material-icons ".$arrayCompetencias[0]['Color']."-text'>stars</i>";
                    }
                    else{
                        echo "<i class='material-icons grey-text'>stars</i>";
                    }
                } ?>
                    
                </div>
                <br>
                <div class="row center">
                    <span>
                        <code>Nivel de desempeño: </code> 
                        <div class='chip <?php echo $arrayCompetencias[0]['Color']; ?> white-text'>
                            <span><b> <?php echo $Nivel_C1;?> </b></span>
                        </div>
                    </span>
                </div>
                
                    

            
            </div>
            </div>
            <div class="card-reveal">
            <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>¿Qué se evalua?</span> <hr>
            <h6>
                <b class="ToolsTic_Verde-text">
                Alfabetización Informacional
                </b>   
            </h6>            
            <p>El estudiante gestiona la información encontrada en la red, evaluando su finalidad y relevancia para la realización de trabajos en su labor académica.</p>
            </div>
        </div>
    </div>

    <div class="col s12 m6 l3">
        <div class="card ">
            <div class="card-image waves-effect waves-block waves-light">
            <img class="activator" src="<?php echo ROOT_PUBLIC; ?>/img/comp_2.png">
            </div>
            <div class="card-content">
            <span class="card-title activator grey-text text-darken-4">
                <i class="material-icons right">more_vert</i>
            </span> <br>
            <div class="row">
            <span class="card-title activator title-compe">
                <b>C2</b> - Resolución de problemas computacionales
            </span>
            <hr>
                <div class="row center">
                    <h3 style="margin-top: 0.5em; margin-bottom: 0px; ">
                        <?php echo ($Puntaje_2*100);?>    <span class="grey-text" style="font-size:2rem">/ 80 <code style="font-size:1rem">Pts.</code></span>             
                    </h3>                
                </div>
                
                <div class="row center start-i">
                <?php for($i = 1; $i <=4; $i++){
                    if($i <= $arrayCompetencias[1]['Estrellas']){
                        echo "<i class='material-icons ".$arrayCompetencias[1]['Color']."-text'>stars</i>";
                    }
                    else{
                        echo "<i class='material-icons grey-text'>stars</i>";
                    }
                } ?>           
                </div>
                <br>
                <div class="row center">
                    <span>
                        <code>Nivel de desempeño: </code> 
                        <div class='chip <?php echo $arrayCompetencias[1]['Color']; ?> white-text'>
                            <span><b> <?php echo $Nivel_C2;?> </b></span>
                        </div>
                    </span>
                </div>
                

            </div>
            </div>
            <div class="card-reveal">
            <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>¿Qué se evalua?</span> <hr>
            <h6>
                <b class="ToolsTic_Verde-text">
                    Resolución de problemas con el uso de recursos computacionales.
                </b>   
            </h6>
            <p>Identifica necesidades y recursos computacionales apropiados para resolver problemas conceptuales y técnicos a través de medios digitales encontrados en la red.</p>
            </div>
        </div>
    </div>

    <div class="col s12 m6 l3">
        <div class="card ">
            <div class="card-image waves-effect waves-block waves-light">
            <img class="activator" src="<?php echo ROOT_PUBLIC; ?>/img/comp_3.png">
            </div>
            <div class="card-content">
            <span class="card-title activator grey-text text-darken-4">
                <i class="material-icons right">more_vert</i>
            </span> <br>
            <div class="row">
                <span class="card-title activator title-compe">
                    <b>C3</b> - Comunicación y colaboración
                </span>
                <hr>
                <div class="row center">
                    <h3 style="margin-top: 0.5em; margin-bottom: 0px; ">
                        <?php echo ($Puntaje_3*100);?> <span class="grey-text" style="font-size:2rem">/ 160 <code style="font-size:1rem">Pts.</code></span>                
                    </h3>
                
                </div>
                
                <div class="row center start-i">
                <?php for($i = 1; $i <=4; $i++){
                    if($i <= $arrayCompetencias[2]['Estrellas']){
                        echo "<i class='material-icons ".$arrayCompetencias[2]['Color']."-text'>stars</i>";
                    }
                    else{
                        echo "<i class='material-icons grey-text'>stars</i>";
                    }
                } ?>         
                </div>
                <br>
                <div class="row center">
                    <span>
                        <code>Nivel de desempeño: </code>
                        <div class='chip <?php echo $arrayCompetencias[2]['Color']; ?> white-text'>
                            <span><b> <?php echo $Nivel_C3;?> </b></span>
                        </div>                         
                    </span>
                </div>
            
            
            
            
            </div>
            </div>
            <div class="card-reveal">
            <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>¿Qué se evalua?</span> <hr>
            <h6>
                <b class="ToolsTic_Verde-text">
                    Comunicación y colaboración en entornos digitales.
                </b>   
            </h6>              
            <p>Comunica información en entornos digitales a través de herramientas en línea interactuando activamente en comunidades digitales.</p>
            </div>
        </div>
    </div>

    <div class="col s12 m6 l3">
        <div class="card ">
            <div class="card-image waves-effect waves-block waves-light">
            <img class="activator" src="<?php echo ROOT_PUBLIC; ?>/img/comp_4.png">
            </div>
            <div class="card-content">
            <span class="card-title activator grey-text text-darken-4">
                <i class="material-icons right">more_vert</i>
            </span> <br>
            <div class="row">
                <span class="card-title activator title-compe">
                    <b>C4</b> -  Creación y publicación digital
                </span>
                <hr>
                <div class="row center">
                    <h3 style="margin-top: 0.5em; margin-bottom: 0px; ">
                        <?php echo ($Puntaje_4*100);?>  <span class="grey-text" style="font-size:2rem">/ 160 <code style="font-size:1rem">Pts.</code></span>               
                    </h3>
                    
                </div>
                
                <div class="row center start-i">
                <?php for($i = 1; $i <=4; $i++){
                    if($i <= $arrayCompetencias[3]['Estrellas']){
                        echo "<i class='material-icons ".$arrayCompetencias[3]['Color']."-text'>stars</i>";
                    }
                    else{
                        echo "<i class='material-icons grey-text'>stars</i>";
                    }
                } ?>           
                </div>
                <br>
                <div class="row center">
                    <span>
                        <code>Nivel de desempeño: </code> 
                        <div class='chip <?php echo $arrayCompetencias[3]['Color']; ?> white-text'>
                            <span><b> <?php echo $Nivel_C4;?> </b></span>
                        </div>
                    </span>
                </div>




            </div>
            </div>
            <div class="card-reveal">
            <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>¿Qué se evalua?</span> <hr>
            <h6>
                <b class="ToolsTic_Verde-text">
                    Creación y publicación de contenido digital.
                </b>   
            </h6>              
            <p>Desarrolla contenidos multimediales y respeta los derechos de propiedad intelectual al utilizar bancos de recursos digitales en su labor académica.</p>
            </div>
        </div>
    </div>
</div>
    

<br>

<div class="row ">
    <div class="col s12 m12 l8">
        <ul class="collection with-header">

            <li class="collection-header">
                <h4>Resultados por competencias</h4>
                <p> Un resumen del nivel obtenido para cada competencia y sus evidencias alcanzadas </p>
            </li>

            <li class="collection-item">
                <div> 
                    Alfabetización Informacional
                    <a href="#!" class="secondary-content"> 
                        <i class="material-icons ToolsticVerde-text">send</i>
                    </a>
                </div>
            </li>

            <li class="collection-item">
                <div>
                    Resolución de problemas con el uso de recursos computacionales.
                    <a href="#!" class="secondary-content">
                        <i class="material-icons ToolsticVerde-text">send</i>
                    </a>
                </div>
            </li>

            <li class="collection-item">
                <div>
                    Comunicación y colaboración en entornos digitales.
                    <a href="#!" class="secondary-content">
                        <i class="material-icons ToolsticVerde-text">send</i>
                    </a>
                </div>
            </li>

            <li class="collection-item">
                <div>
                    Creación y publicación de contenido digital.
                    <a href="#!" class="secondary-content">
                        <i class="material-icons ToolsticVerde-text">send</i>
                    </a>
                </div>
            </li>

            <li class="collection-item ToolsTic_azul white-text">
                <div class="">
                    <b>Resultados totales</b>
                    <a href="#!" class="secondary-content">
                        <i class="material-icons white-text">send</i>
                    </a>
                </div>
            </li>
        </ul>
    </div>

    <div class="col s12 m12 l4">
        <div class="row">                
            <div class="card">                    
                <div class="card-content center">
                <h6><b>¿Necesitas un Certificado?</b></h6>
                <a href="#" class="btn green">DESCARGAR</a>
                </div>
                <div class="card-image">                    
                    <img src="<?php echo ROOT_PUBLIC; ?>/img/certifivado.jpg">
                </div>                    
            </div>                
        </div>
    </div>
</div>

<br><br>