<div class="row" style="display:none" >
    <?php 
    //style="display:none"
        $ResPregExa = ObtenerOpcionesRespuestasRandom($FullPregunCues[$prgs -1]['id_pregunta'], $conex);          
                
        if ( isset( $FullPregunCues[$prgs -1]['id_opcion_respuesta'] ) && $NumPrgSave > 0 && ( $FullPregunCues[$prgs -1]['id_opcion_respuesta']) % 5 != 0 ) 
        {
            if($FullPregunCues[$prgs -1]['id_opcion_respuesta'] == $ResPregExa[0]['id_opcion_respuesta'])
            { $ChkPrgSave1 = "checked"; } else { $ChkPrgSave1 = "";};
            
            if($FullPregunCues[$prgs -1]['id_opcion_respuesta'] == $ResPregExa[1]['id_opcion_respuesta'])
            { $ChkPrgSave2 = "checked"; } else { $ChkPrgSave2 = "";};
            
            if($FullPregunCues[$prgs -1]['id_opcion_respuesta'] == $ResPregExa[2]['id_opcion_respuesta'])
            { $ChkPrgSave3 = "checked"; } else { $ChkPrgSave3 = "";};
            
            if($FullPregunCues[$prgs -1]['id_opcion_respuesta'] == $ResPregExa[3]['id_opcion_respuesta'])
            { $ChkPrgSave4 = "checked"; } else { $ChkPrgSave4 = "";};
            
            if($FullPregunCues[$prgs -1]['id_opcion_respuesta'] == $ResPregExa[4]['id_opcion_respuesta'])
            { $ChkPrgSave5 = "checked"; } else { $ChkPrgSave5 = "";};
        ?>
            <p>
                <label>
                    <input class="with-gap" style="display:none" name="GRPP_<?php echo $prgs;?>"
                        id="resp1_prg<?php echo $prgs;?>" type="radio" <?php echo $ChkPrgSave1; ?>
                        value="<?php echo $ResPregExa[0]['id_opcion_respuesta']; ?>" />
                        <span><?php echo $ResPregExa[0]['id_opcion_respuesta'].$ChkPrgSave1; ?></span> 
                </label>
            </p>

            <p>
                <label>
                    <input class="with-gap" style="display:none" name="GRPP_<?php echo $prgs;?>"
                        id="resp2_prg<?php echo $prgs;?>" type="radio" <?php echo $ChkPrgSave2; ?>
                        value="<?php echo $ResPregExa[1]['id_opcion_respuesta']; ?>" />
                    <span><?php echo $ResPregExa[1]['id_opcion_respuesta'].$ChkPrgSave2; ?></span>
                </label>
            </p>

            <p>
                <label>
                    <input class="with-gap" style="display:none" name="GRPP_<?php echo $prgs;?>"
                        id="resp3_prg<?php echo $prgs;?>" type="radio"  <?php echo $ChkPrgSave3; ?>
                        value="<?php echo $ResPregExa[2]['id_opcion_respuesta']; ?>" />
                    <span><?php echo $ResPregExa[2]['id_opcion_respuesta'].$ChkPrgSave3; ?></span>
                </label>
            </p>

            <p>
                <label>
                    <input class="with-gap" style="display:none" name="GRPP_<?php echo $prgs;?>"
                        id="resp4_prg<?php echo $prgs;?>" type="radio"  <?php echo $ChkPrgSave4; ?>
                        value="<?php echo $ResPregExa[3]['id_opcion_respuesta']; ?>" />
                    <span><?php echo $ResPregExa[3]['id_opcion_respuesta'].$ChkPrgSave4; ?></span>
                </label>
            </p>        

            <p>
                <label>
                    <input class="with-gap" style="display:none" name="GRPP_<?php echo $prgs;?>"
                        id="resp5_prg<?php echo $prgs;?>" type="radio" <?php echo $ChkPrgSave5; ?>
                        value="<?php echo $ResPregExa[4]['id_opcion_respuesta']; ?>" />
                    <span><?php echo $ResPregExa[4]['id_opcion_respuesta'].$ChkPrgSave5; ?></span>
                </label>
            </p>  
    <?php }
    else  { ?>
            <p>
                <label>
                    <input class="with-gap" style="display:none" name="GRPP_<?php echo $prgs;?>"
                        id="resp1_prg<?php echo $prgs;?>" type="radio"
                        value="<?php echo $ResPregExa[0]['id_opcion_respuesta']; ?>" />
                        <span><?php echo $ResPregExa[0]['id_opcion_respuesta']; ?></span> 
                </label>
            </p>

            <p>
                <label>
                    <input class="with-gap" style="display:none" name="GRPP_<?php echo $prgs;?>"
                        id="resp2_prg<?php echo $prgs;?>" type="radio"
                        value="<?php echo $ResPregExa[1]['id_opcion_respuesta']; ?>" />
                    <span><?php echo $ResPregExa[1]['id_opcion_respuesta']; ?></span>
                </label>
            </p>

            <p>
                <label>
                    <input class="with-gap" style="display:none" name="GRPP_<?php echo $prgs;?>"
                        id="resp3_prg<?php echo $prgs;?>" type="radio"
                        value="<?php echo $ResPregExa[2]['id_opcion_respuesta']; ?>" />
                    <span><?php echo $ResPregExa[2]['id_opcion_respuesta']; ?></span>
                </label>
            </p>

            <p>
                <label>
                    <input class="with-gap" style="display:none" name="GRPP_<?php echo $prgs;?>"
                        id="resp4_prg<?php echo $prgs;?>" type="radio"
                        value="<?php echo $ResPregExa[3]['id_opcion_respuesta']; ?>" />
                    <span><?php echo $ResPregExa[3]['id_opcion_respuesta']; ?></span>
                </label>
            </p>

            <p>
                <label>
                    <input class="with-gap" style="display:none" name="GRPP_<?php echo $prgs;?>"
                        id="resp5_prg<?php echo $prgs;?>" type="radio" checked
                        value="<?php echo $ResPregExa[4]['id_opcion_respuesta']; ?>" />
                    <span><?php echo $ResPregExa[4]['id_opcion_respuesta']; ?></span>
                </label>
            </p>
    <?php } ?>   
</div>