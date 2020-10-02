function VerPrgFull(id_preg) {
   
    var cod_pregunta_MF;
    var estado_pregunta_MF;
    var bg_estado_pregunta_MF;
    var competencia_MF;
    var def_competencia_MF;
    var evidencia_MF;
    var tarea_MF;
    var enunciado_MF;
    var peso1_MF;
    var peso2_MF;
    var peso3_MF;
    var peso4_MF;
    var respu1_MF;
    var respu2_MF;
    var respu3_MF;
    var respu4_MF;
    var fecha_creacion_MF;
    var creador_pregunta_MF;
    var validador_pregunta_MF;

    $('.modal').modal();

    $.ajax({
        type: "POST",
        data: {
            id_pregunta: id_preg           
        },        
        url: "php/DataModal.php",       
        success: function(res)
        {             
            var data = jQuery.parseJSON(res); 
            
            cod_pregunta_MF = data['cod_pregunta'];
            estado_pregunta_MF = data['estado_pregunta'];
            bg_estado_pregunta_MF = data['bg_estado_pregunta'];
            competencia_MF = data['competencia'];
            def_competencia_MF = data['def_competencia'];
            evidencia_MF = data['evidencia'];
            tarea_MF = data['tarea'];
            enunciado_MF = data['enunciado'];
            peso1_MF = data['peso1'];
            peso2_MF = data['peso2'];
            peso3_MF = data['peso3'];
            peso4_MF = data['peso4'];
            respu1_MF = data['respu1'];
            respu2_MF = data['respu2'];
            respu3_MF = data['respu3'];
            respu4_MF = data['respu4'];
            fecha_creacion_MF = data['fecha_creacion'];
            creador_pregunta_MF = data['creador_pregunta'];
            validador_pregunta_MF = data['validador_pregunta'];



            $('#MF_cod_pregunta').html(cod_pregunta_MF);
            $('#MF_estado_pregunta').html(estado_pregunta_MF);
            $('#MF_estado_pregunta').addClass(bg_estado_pregunta_MF);
            $('#MF_competencia').html(competencia_MF);
            $('#MF_def_competencia').html(def_competencia_MF);
            $('#MF_evidencia').html(evidencia_MF);
            $('#MF_tarea').html(tarea_MF);
            $('#MF_enunciado').html(enunciado_MF);
            $('#MF_pesoP1').html(peso1_MF);
            $('#MF_pesoP2').html(peso2_MF);
            $('#MF_pesoP3').html(peso3_MF);
            $('#MF_pesoP4').html(peso4_MF);
            $('#MF_opcionR1').html(respu1_MF);
            $('#MF_opcionR2').html(respu2_MF);
            $('#MF_opcionR3').html(respu3_MF);
            $('#MF_opcionR4').html(respu4_MF);
            $('#MF_fecha_creacion_pregunta').html(fecha_creacion_MF);
            $('#MF_creador_pregunta').html(utf8_encode(creador_pregunta_MF));
            $('#MF_validador_pregunta').html(utf8_encode(validador_pregunta_MF));



        }//Fin success
    }); // FIN DEL AJAX ENVIO DE DATOS A PHP


    

    $('#VerFullPrg').modal('open');
    /*
    $('#VerFullPrg').on('shown', function () {
        $("#modal-content").scrollTop(0);
    }); 
    */
   
}