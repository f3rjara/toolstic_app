<?php 


if ( isset($FullPregunCues[$prgs -1]['id_opcion_respuesta']) &&  $NumPrgSave > 0 && ($FullPregunCues[$prgs -1]['id_opcion_respuesta']) % 5 != 0 )
{

    if($FullPregunCues[$prgs -1]['id_opcion_respuesta'] == $ResPregExa[0]['id_opcion_respuesta'])
    { $CardPrgSave1 = "green white-text"; } else { $CardPrgSave1 = "white black-text";};

    if($FullPregunCues[$prgs -1]['id_opcion_respuesta'] == $ResPregExa[1]['id_opcion_respuesta'])
    { $CardPrgSave2 = "green white-text"; } else { $CardPrgSave2 = "white black-text";};

    if($FullPregunCues[$prgs -1]['id_opcion_respuesta'] == $ResPregExa[2]['id_opcion_respuesta'])
    { $CardPrgSave3 = "green white-text"; } else { $CardPrgSave3 = "white black-text";};

    if($FullPregunCues[$prgs -1]['id_opcion_respuesta'] == $ResPregExa[3]['id_opcion_respuesta'])
    { $CardPrgSave4 = "green white-text"; } else { $CardPrgSave4 = "white black-text";};

    if($FullPregunCues[$prgs -1]['id_opcion_respuesta'] == $ResPregExa[4]['id_opcion_respuesta'])
    { $CardPrgSave5 = "green white-text"; } else { $CardPrgSave5 = "white black-text";};

    ?>

    <div class="row">
        <!-- OPCION DE RESPUESTA No 1 -->
        <div class="col s12 m12 l6">
            <label>Opción de respuesta No 1</label><hr>

            <div class="TexEnunciado RespCard <?php echo $CardPrgSave1;?> card-panel" id="OR1PP<?php echo $prgs;?>"
                 onclick="Selectoption(1,<?php echo $prgs;?>); GuardarRespuesta(<?php echo $prgs;?>,<?php echo $FullPregunCues[$prgs -1]['id_pregunta'];?>, <?php echo $Id_Cuestionario['id_cuestionario'];?>, <?php echo $userlog['cod_estudiante']; ?>,'<?php echo $IpUsuario; ?>');">
                 <?php echo decodificar_quest ( $ResPregExa[0]['opcion_respuesta'] ); ?>
            </div>

            <div class="row left">                                
                &nbsp; &nbsp;  &nbsp;
                <a style="cursor: pointer;"
                    onclick='EscucharTexVoz("#OR1PP<?php echo $prgs;?>")'> 
                    <i class="material-icons blue-text small"> volume_up </i>
                </a>

                <a style="cursor: pointer;" onclick='StopVoz()'> 
                    <i class="material-icons red-text small"> volume_off </i>
                </a>
            </div>
        </div>
        <!-- OPCION DE RESPUESTA No 2 -->
        <div class="col s12 m12 l6">
            <label>Opción de respuesta No 2</label> <hr>

            <div class="TexEnunciado RespCard <?php echo $CardPrgSave2;?> card-panel" id="OR2PP<?php echo $prgs;?>"
                 onclick="Selectoption(2,<?php echo $prgs;?>); GuardarRespuesta(<?php echo $prgs;?>,<?php echo $FullPregunCues[$prgs -1]['id_pregunta'];?>, <?php echo $Id_Cuestionario['id_cuestionario'];?>, <?php echo $userlog['cod_estudiante']; ?>,'<?php echo $IpUsuario; ?>');">
                 <?php echo decodificar_quest ( $ResPregExa[1]['opcion_respuesta'] ); ?>
            </div>
            <div class="row left">                                
                &nbsp; &nbsp; &nbsp;
                <a style="cursor: pointer;"
                    onclick='EscucharTexVoz("#OR2PP<?php echo $prgs;?>")'> 
                    <i class="material-icons blue-text small"> volume_up </i>
                </a>

                <a style="cursor: pointer;" onclick='StopVoz()'> 
                    <i class="material-icons red-text small"> volume_off </i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- OPCION DE RESPUESTA No 3 -->
        <div class="col s12 m12 l6">
            <label>Opción de respuesta No 3</label> <hr>

            <div class="TexEnunciado RespCard  <?php echo $CardPrgSave3;?> card-panel" id="OR3PP<?php echo $prgs;?>"
                 onclick="Selectoption(3,<?php echo $prgs;?>); GuardarRespuesta(<?php echo $prgs;?>,<?php echo $FullPregunCues[$prgs -1]['id_pregunta'];?>, <?php echo $Id_Cuestionario['id_cuestionario'];?>, <?php echo $userlog['cod_estudiante']; ?>,'<?php echo $IpUsuario; ?>');">
                 <?php echo decodificar_quest ( $ResPregExa[2]['opcion_respuesta'] ); ?>
            </div>

            <div class="row left">                                
                &nbsp; &nbsp; &nbsp;
                <a style="cursor: pointer;"
                    onclick='EscucharTexVoz("#OR3PP<?php echo $prgs;?>")'> 
                    <i class="material-icons blue-text small"> volume_up </i>
                </a>

                <a style="cursor: pointer;" onclick='StopVoz()'> 
                    <i class="material-icons red-text small"> volume_off </i>
                </a>
            </div>
        </div>

        <!-- OPCION DE RESPUESTA No 4 -->  
        <div class="col s12 m12 l6">
            <label>Opción de respuesta No 4</label> <hr>

            <div class="TexEnunciado RespCard <?php echo $CardPrgSave4;?> card-panel" id="OR4PP<?php echo $prgs;?>"
                 onclick="Selectoption(4,<?php echo $prgs;?>); GuardarRespuesta(<?php echo $prgs;?>,<?php echo $FullPregunCues[$prgs -1]['id_pregunta'];?>, <?php echo $Id_Cuestionario['id_cuestionario'];?>, <?php echo $userlog['cod_estudiante']; ?>,'<?php echo $IpUsuario; ?>');">
                <?php echo decodificar_quest ( $ResPregExa[3]['opcion_respuesta'] ); ?>
            </div>

            <div class="row left">                                
                &nbsp;  &nbsp;  &nbsp;
                <a style="cursor: pointer;"
                    onclick='EscucharTexVoz("#OR4PP<?php echo $prgs;?>")'> 
                    <i class="material-icons blue-text small"> volume_up </i>
                </a>

                <a style="cursor: pointer;" onclick='StopVoz()'> 
                    <i class="material-icons red-text small"> volume_off </i>
                </a>
            </div>
        </div>
    </div>

    <!--  BOTON GUARDAR PREGUNTA SOLA
    <div class="row center">
        <br>
        <a class="btn" onclick="GuardarRespuesta(<?php //echo $prgs;?>,<?php //echo $FullPregunCues[$prgs -1]['id_pregunta'];?>, <?php //echo $Id_Cuestionario['id_cuestionario'];?>, <?php //echo $userlog['cod_estudiante']; ?>,'<?php //echo $IpUsuario; ?>' );"><b>Guardar Respuesta <?php //echo $prgs;?> </b></a>
    </div>
    -->

<?php } // FIN END
else { ?>
    <div class="row">
        <!-- OPCION DE RESPUESTA No 1 -->
        <div class="col s12 m12 l6">
            <label>Opción de respuesta No 1</label> <hr>

            <div class="TexEnunciado RespCard white black-text card-panel" id="OR1PP<?php echo $prgs;?>"
                 onclick="Selectoption(1,<?php echo $prgs;?>);GuardarRespuesta(<?php echo $prgs;?>,<?php echo $FullPregunCues[$prgs -1]['id_pregunta'];?>, <?php echo $Id_Cuestionario['id_cuestionario'];?>, <?php echo $userlog['cod_estudiante']; ?>,'<?php echo $IpUsuario; ?>');">
                <?php echo decodificar_quest ( $ResPregExa[0]['opcion_respuesta'] ); ?>
            </div>

            <div class="row left">                                
                &nbsp;
                &nbsp;
                &nbsp;
                <a style="cursor: pointer;"
                    onclick='EscucharTexVoz("#OR1PP<?php echo $prgs;?>")'> 
                    <i class="material-icons blue-text small"> volume_up </i>
                </a>

                <a style="cursor: pointer;" onclick='StopVoz()'> 
                    <i class="material-icons red-text small"> volume_off </i>
                </a>
            </div>
        </div>

        <!-- OPCION DE RESPUESTA No 2 -->
        <div class="col s12 m12 l6">
            <label>Opción de respuesta No 2</label> <hr>

            <div class="TexEnunciado RespCard white black-text card-panel"
                id="OR2PP<?php echo $prgs;?>"
                onclick="Selectoption(2,<?php echo $prgs;?>); GuardarRespuesta(<?php echo $prgs;?>,<?php echo $FullPregunCues[$prgs -1]['id_pregunta'];?>, <?php echo $Id_Cuestionario['id_cuestionario'];?>, <?php echo $userlog['cod_estudiante']; ?>,'<?php echo $IpUsuario; ?>');">
                <?php echo decodificar_quest ( $ResPregExa[1]['opcion_respuesta'] ); ?>
            </div>

            <div class="row left">                                
                &nbsp; &nbsp;  &nbsp;
                <a style="cursor: pointer;"
                    onclick='EscucharTexVoz("#OR2PP<?php echo $prgs;?>")'> 
                    <i class="material-icons blue-text small"> volume_up </i>
                </a>

                <a style="cursor: pointer;" onclick='StopVoz()'> 
                    <i class="material-icons red-text small"> volume_off </i>
                </a>
            </div>

        </div>
    </div>

    <div class="row">
        <!-- OPCION DE RESPUESTA No 3 -->
        <div class="col s12 m12 l6">
            <label>Opción de respuesta No 3</label> <hr>

            <div class="TexEnunciado RespCard  white black-text card-panel"
                id="OR3PP<?php echo $prgs;?>"
                onclick="Selectoption(3,<?php echo $prgs;?>); GuardarRespuesta(<?php echo $prgs;?>,<?php echo $FullPregunCues[$prgs -1]['id_pregunta'];?>, <?php echo $Id_Cuestionario['id_cuestionario'];?>, <?php echo $userlog['cod_estudiante']; ?>,'<?php echo $IpUsuario; ?>'); ">
                <?php echo decodificar_quest ( $ResPregExa[2]['opcion_respuesta'] ); ?>
            </div>

            <div class="row left">                                
                &nbsp; &nbsp;  &nbsp;
                <a style="cursor: pointer;"
                    onclick='EscucharTexVoz("#OR3PP<?php echo $prgs;?>")'> 
                    <i class="material-icons blue-text small"> volume_up </i>
                </a>

                <a style="cursor: pointer;" onclick='StopVoz()'> 
                    <i class="material-icons red-text small"> volume_off </i>
                </a>
            </div>

        </div>

        <!-- OPCION DE RESPUESTA No 4 -->
        <div class="col s12 m12 l6">
            <label>Opción de respuesta No 4</label> <hr>

            <div class="TexEnunciado RespCard white black-text card-panel"
                id="OR4PP<?php echo $prgs;?>"
                onclick="Selectoption(4,<?php echo $prgs;?>); GuardarRespuesta(<?php echo $prgs;?>,<?php echo $FullPregunCues[$prgs -1]['id_pregunta'];?>, <?php echo $Id_Cuestionario['id_cuestionario'];?>, <?php echo $userlog['cod_estudiante']; ?>,'<?php echo $IpUsuario; ?>');">
                <?php echo decodificar_quest ( $ResPregExa[3]['opcion_respuesta'] ); ?>
            </div>

            <div class="row left">                                
                &nbsp;
                &nbsp;
                &nbsp;
                <a style="cursor: pointer;"
                    onclick='EscucharTexVoz("#OR4PP<?php echo $prgs;?>")'> 
                    <i class="material-icons blue-text small"> volume_up </i>
                </a>

                <a style="cursor: pointer;" onclick='StopVoz()'> 
                    <i class="material-icons red-text small"> volume_off </i>
                </a>
            </div>

        </div>
    </div>


    <!--  BOTON GUARDAR PREGUNTA SOLA
    <div class="row center">
        <br>
        <a class="btn" onclick="GuardarRespuesta(<?php //echo $prgs;?>,<?php //echo $FullPregunCues[$prgs -1]['id_pregunta'];?>, <?php //echo $Id_Cuestionario['id_cuestionario'];?>, <?php //echo $userlog['cod_estudiante']; ?>,'<?php //echo $IpUsuario; ?>' );"><b>Guardar respuesta de la pregunta <?php //echo $prgs;?> </b></a>
    </div>  -->

<?php } // FIN ELSE  ?>