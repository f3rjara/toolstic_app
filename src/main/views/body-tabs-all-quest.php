<div id="prg<?php echo $prgs;?>" class="row">    
    <div class="black-text row">
            <div class="row">
                <div class="col s12 m6 push-m3 center">
                    <i class='material-icons large red-text'>info</i><br>
                    <h5>Verifique cada pregunta y de click en "ENVIAR TODO Y TERMINAR" al final de esta sección para finalizar el cuestionario.</h5>
                    <br>
                </div>
            </div>

            <div class="row">
                <div class="col s12 m4 push-m4">
                    <table class="centered">
                        <tbody>
                            <?php
                                for( $prgs = 1; $prgs <= 50; $prgs++ )
                                { 
                                    if( $prgs <= $NumPrgSave && isset($FullPregunCues[$prgs-1]['id_opcion_respuesta']) ){
                                        if(($FullPregunCues[$prgs-1]['id_opcion_respuesta'])%5 != 0){ ?>
                                            <tr>
                                                <td> <a class="btn ToolsticAzul white-text">Pregunta: </a> </td>
                                                <td class="left">
                                                    <a class="btn orange white-text tab">
                                                        <b><?php echo $prgs;?></b>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a id="BtnStatusFin<?php echo $prgs;?>" class="btn green white-text"
                                                       onclick="IrAprgFin('prg<?php echo $prgs;?>','<?php echo $prgs;?>')">
                                                        Guardada
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php }
                                        else{ ?>
                                        <tr>
                                            <td> <a class="btn ToolsticAzul white-text">Pregunta: </a>  </td>
                                            <td class="left"><a
                                                    class="btn orange white-text tab"><b><?php echo $prgs;?></b>
                                                </a>
                                            </td>
                                            <td>
                                                <a id="BtnStatusFin<?php echo $prgs;?>"  class="btn orange white-text"
                                                   onclick="IrAprgFin('prg<?php echo $prgs;?>','<?php echo $prgs;?>')">
                                                   Guardada Sin Responder 
                                                </a>
                                            </td>
                                        </tr>
                                        <?php }
                                    } 
                                    else { ?>
                                        <tr>
                                            <td><a class="btn ToolsticAzul white-text">Pregunta: </a> </td>
                                            <td class="left">
                                                <a class="btn orange white-text tab"><b><?php echo $prgs;?></b>
                                                </a>
                                            </td>
                                            <td>
                                                <a id="BtnStatusFin<?php echo $prgs;?>" class="btn red white-text"
                                                   onclick="IrAprgFin('prg<?php echo $prgs;?>','<?php echo $prgs;?>')">
                                                   Sin Responder</a>
                                            </td>
                                        </tr>
                                    <?php  } 
                                } ?>
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="row">
                <div class="col s12 m12 center">
                    <br>
                    <!-- PARA CAMBIAR EL COLOR DEL SELECTOR LI $('#liprg1').addClass = 'green'; -->
                    <a class="btn green" id="BtnETYT" onclick="SavAllOPR(<?php echo $Id_Cuestionario['id_cuestionario']; ?>, <?php echo $userlog['cod_estudiante'];?>)">
                        Enviar todo y terminar
                    </a>
                </div>
            </div>       
    </div>
</div> 
<br>


