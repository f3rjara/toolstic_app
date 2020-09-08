<!-- EL ESTUDIANTE YA PRESENTO LA PRUEBA DE HOMOLOGACION -->
<div class="row center">
    <div class="col s12 m6 push-m3 l4 push-l4">
        <div class="card">
            <div class="card-image">
                <img src="<?php echo ROOT_PUBLIC;?>/img/result_prg.jpg">
                <span class="card-title"><b>Ya presentó una prueba</b></span>
            </div>
            <div class="card-content">
            <p>Usted ya se presentó  la prueba de Homologación de Lenguaje y Herramientas Informáticas de la Universida de Nariño. Para ver sus resultado y generar un reporte debes acceder al menú resultado. </p>
            </div>
            <div class="card-action">
                <a class="btn ToolsticAzul white-text " href="<?php echo ROOT_MEDIA_USER;?>/student/resultados.php">
                    <i class='material-icons right'>poll</i>
                    Ver resultados
                </a>
            </div>
        </div>
    </div>
</div>
<!-- ********************** FIN  *************************-->




<?PHP

           

$StudentEstaInscrito  = EstudianteInscrito($userlog['cod_estudiante'], $conex);           
            

            if($StudentEstaInscrito['bandera'])
            {
                $idInscripcion =  $StudentEstaInscrito['data']['id_inscripcion_prueba']; 
                $idGrupo =  $StudentEstaInscrito['data']['id_grupo'];             
                $dataInscripcion = FullDatosInsctipcion($idGrupo, $conex);
                $encripCod = md5($userlog['cod_estudiante']);
                
                
                $BanderaHorario = VerificacionHorarioGrupo($dataInscripcion['id_estado_prueba'],$dataInscripcion['horario_grupo']);   
                        
                
                $NoIntentosCues = IntenoStudent($conex, $userlog['cod_estudiante']);    
            
                    if( $NoIntentosCues === NULL ){
                        $TextBtnCues = array("estado_cuestionario"=>"Sin presentar","bgcolor_estado_cuestionario"=>"red");
                    }
                    else {
                        $TextBtnCues = array("estado_cuestionario"=>$NoIntentosCues['estado_cuestionario'],"bgcolor_estado_cuestionario"=>$NoIntentosCues['bgcolor_estado_cuestionario']);
                    }
            } 
            
            $dataEstudiante = DatosEstudiantesReload($conex,$userlog['cod_estudiante']);
            //var_dump($dataInscripcion);


            if($StudentEstaInscrito['bandera'] && $dataEstudiante['realizo_prueba'] == 0 && $dataEstudiante['estudiante_habilitado'] == 1){
                //EL ESTUDIANTE ESTA INSCRITO EN UN GRUPO Y ESTA HABILITADO Y NO REALIZO LA PRUEBA
                include (ROOT_MAIN.'/views/conceptosEvaluacion.php');
                echo "<br>";              
                
                //SE VERIFICA SI TIENE UN CUESTIONARIO SI >0  
               
                if($NoIntentosCues != NULL  ){                   
                    if($dataInscripcion['id_estado_prueba'] == 3)
                    { 
                        if($BanderaHorario['bandera']){  ?>
                            <div class="row center">
                                <br>
                                <a onclick="AccedeExamen(true, <?php echo count($NoIntentosCues);?>,'<?php echo $encripCod;?>')" class="btn green">Comenzar a resolver la prueba</a>
                            </div>
                        <?php }      
                        else { $_SESSION['btnPresentaPrueba'] = 'false'; ?>
                            <div class="row center">
                                <br>
                                <a class="btn red"><?php echo $BanderaHorario['ResTex']; ?></a>
                            </div>
                        <?php }
                        
                    } //FIN IF ESTADO PRUEBA                
                    else
                    {                         
                        if($BanderaHorario['bandera']){  ?>
                            <div class="row center">
                                <br>
                                <a onclick="AccedeExamen(false,<?php echo count($NoIntentosCues);?>,'<?php echo $encripCod;?>')" class="btn green">Comenzar a resolver la prueba</a>
                            </div>
                        <?php }      
                        else { $_SESSION['btnPresentaPrueba'] = 'false'; ?>
                            <div class="row center">
                                <br>
                                <a class="btn red"><?php echo $BanderaHorario['ResTex']; ?></a>
                            </div>
                        <?php }    

                    } //FIN ELSE  
                } //FIN IF COUNT
                else{
                    //SE HABILITA EL BTN PERO DEPENDE DEL HORARIO 
                    if($BanderaHorario['bandera']){ ?>
                        <div class="row center">
                                <br>
                                <a onclick="AccedeExamen(false,<?php echo count($NoIntentosCues);?>,'<?php echo $encripCod;?>')" class="btn green">Comenzar a resolver la prueba</a>
                        </div>
                    <?PHP }      
                    else { $_SESSION['btnPresentaPrueba'] = 'false'; ?>
                            <div class="row center">
                                <br>
                                <a class="btn red"><?php echo $BanderaHorario['ResTex']; ?></a>
                            </div>
                    <?PHP }                    
                };
            }
      