<!-- CARD TABS PARA SELECCIONAR LAS PREGUNTAS tabs-fixed-width -->
<div class="card-tabs">
    <ul class="tabs ">
        <?php 
            for($li = 1; $li <= 51; $li++) { 
                if($li != 51)  {
                    if($li <= $NumPrgSave && isset($FullPregunCues[$li-1]['id_opcion_respuesta'])){
                        if(($FullPregunCues[$li-1]['id_opcion_respuesta'])%5 != 0){ ?>
                            <li class="tab green" id="liprg<?php echo $li;?>">
                                <a href="#prg<?php echo $li;?>"class="white-text">
                                    <b><?php echo $li;?></b>
                                </a>
                            </li>
                        <?php }
                        else{ ?>
                            <li class="tab orange" id="liprg<?php echo $li;?>">
                                <a href="#prg<?php echo $li;?>"class="white-text">
                                    <b><?php echo $li;?></b>
                                </a>
                            </li>
                        <?php }
                    } //FIN IF
                    else { ?>
                    <li class="tab red" id="liprg<?php echo $li;?>">
                        <a href="#prg<?php echo $li;?>"class="white-text">
                            <b><?php echo $li;?></b>
                        </a>
                    </li>
                    <?php  }  // FIN ELSE
                } // FIN IF != 51
                else { ?>
                    <li class="tab orange" id="liprg<?php echo $li;?>">
                        <a href="#prg<?php echo $li;?>"class="black-text"><b>FIN</b></a>
                    </li>
                <?php } // FIN ELSE 
            } //FIN DEL FOR 
        ?>
    </ul>
</div>
<!-- *********+ FIN  ********************** -->