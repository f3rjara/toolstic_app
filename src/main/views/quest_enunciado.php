<div class="card-panel ToolsticBlanco black-text">
    <span class="card-title"> <b>Enunciado</b> </span> <br>                                        
    <label>
        Enunciado de la pregunta
        <b>
            <?php echo $FullPregunCues[$prgs -1]['cod_pregunta']; ?>
        </b>
    </label>

    <div id="TxtEnun_<?php echo $FullPregunCues[$prgs -1]['id_pregunta']; ?>" class="TexEnunciado white black-text card-panel">
        <?php 
        $rwemplaz= str_replace("â€œ", '"', $FullPregunCues[$prgs -1]['enunciado_pregunta'] ); 
        $rwemplaz= str_replace("â€", '"', $rwemplaz ); 
        $rwemplaz= str_replace("", '', $rwemplaz ); 
        $rwemplaz= str_replace("&nbsp;", ' ', $rwemplaz ); 
        $vaar =  ( html_entity_decode ( $rwemplaz , ENT_HTML5, 'UTF-8'));
        echo utf8_decode ( $vaar );        
        ?>
    </div>

    <div class="row left">
        <?php $id_PRG_En = "#TxtEnun_".$FullPregunCues[$prgs -1]['id_pregunta']; ?>
        &nbsp;
        &nbsp;
        <a style="cursor: pointer;"
            onclick='EscucharTexVoz("<?php echo $id_PRG_En;?>")'> 
            <i class="material-icons blue-text small"> volume_up </i>
        </a>

        <a style="cursor: pointer;" onclick='StopVoz()'> 
            <i class="material-icons red-text small"> volume_off </i>
        </a>
    </div>
    <br>
</div>