<div class="row">                           
    <div class="card-panel ToolsticBlanco black-text ">
        <div class="row">

            <div class="col s12 m6">
                <a class="btn ToolsticAzul white-text">Pregunta</a>
                <a class="btn orange black-text">
                    <b><?php echo $prgs;?></b> 
                </a>
            </div>  

            <?php
                if( $prgs <= $NumPrgSave && isset($FullPregunCues[$prgs-1]['id_opcion_respuesta']) ) {
                    if(($FullPregunCues[$prgs-1]['id_opcion_respuesta'])%5 != 0) { ?>
                        <div class="col s12 m6 right-align">
                            <a id="BtnStatusPrg<?php echo $prgs;?>" class="btn green"> GUARDADA
                            </a>
                        </div>
                    <?php }
                    else{ ?>
                        <div class="col s12 m6 right-align">
                            <a id="BtnStatusPrg<?php echo $prgs;?>" class="btn orange"> GUARDADA Y SIN RESPONDER
                            </a>
                        </div>
                    <?php }
                }
                else { ?>
                    <div class="col s12 m6 right-align">
                        <a id="BtnStatusPrg<?php echo $prgs;?>" class="btn red"> SIN RESPONDER
                        </a>
                    </div>
            <?php } ?>    

        </div>
    </div>
</div>
