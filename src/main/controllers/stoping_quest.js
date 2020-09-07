function Stopearquestion(){
    console.log("Se detiene todo los servicios y se pide el ennvio de todo");
    $('.card-panel').removeAttr('onclick');

    setTimeout(function(){

    let timerInterval2
        Swal.fire({
        title: 'Tiempo Finalizado!',
        html: 'Verifique las respuestas guardadas y envie su cuestionario para generar los resultados correspondientes. <br>  Podrás continuar en : <b></br> ms.',
        timer: 5500,
        allowEscapeKey: false,
        allowOutsideClick: false,
        timerProgressBar: true,
        onBeforeOpen: () => {
            Swal.showLoading()
            timerInterval2 = setInterval(() => {
            const content = Swal.getContent()
            if (content) {
                const b = content.querySelector('b')
                if (b) {
                b.textContent = Swal.getTimerLeft()
                }
            }
            }, 100)
        },
        onClose: () => {
            clearInterval(timerInterval2)
        }
        }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log('Drigiendo a la Tab 51');
            $('.tabs').tabs('select', 'prg51'); 
            $("body, main").animate({ scrollTop: ($('.tabs')[0].scrollHeight)+500}, 1500);
            $('.tabs').scrollLeft(2900);
        }
    });

},1700);


}







function GuardarRespuesta(num_prg, id_prg,id_cuestionario,cod_estudiante,ip_estudiante){

    var id_respuesta = $('input:radio[name=GRPP_'+num_prg+']:checked').val();

    if((id_respuesta % 5) == 0){        
        $('#liprg'+num_prg).removeClass().addClass('tab orange');

        $('#BtnStatusPrg'+num_prg).removeClass().addClass('btn orange');
        $('#BtnStatusPrg'+num_prg).text('GUARDADA SIN RESPONDER');

        $('#BtnStatusFin'+num_prg).removeClass().addClass('btn orange');
        $('#BtnStatusFin'+num_prg).text('GUARDADA SIN RESPONDER');
        var estadoRta = 1;
    }
    else{        
        $('#liprg'+num_prg).removeClass().addClass('tab green');

        $('#BtnStatusPrg'+num_prg).removeClass().addClass('btn green');
        $('#BtnStatusPrg'+num_prg).text('GUARDADA');

        $('#BtnStatusFin'+num_prg).removeClass().addClass('btn green');
        $('#BtnStatusFin'+num_prg).text('GUARDADA');
        var estadoRta = 2;
    };

    var n =  new Date();
    var y = n.getFullYear();
    var m = "0"+(n.getMonth()+1);
    var d = "0"+n.getDate();

    var h = "00"+n.getHours();    
    var mi = "00"+n.getMinutes();
    var se = "00"+n.getSeconds();

    
    var FechaRespu =(y+"-"+m.slice(-2)+"-"+d.slice(-2)+" "+h.slice(-2)+":"+mi.slice(-2)+":"+se.slice(-2)+".00");
        
    console.log(FechaRespu);
        
    $("body, main").animate({ scrollTop:($('#TempPrueba')[0].scrollHeight)+150}, 1000); 

    var arrayRes = {
        id_cuestionario: id_cuestionario,
        cod_estudiante: cod_estudiante,
        id_opcion_respuesta: id_respuesta,
        fecha_rta_enviada: FechaRespu,
        ip_estudiante: ip_estudiante,
        id_estado_rta_enviada: estadoRta,
        id_pregunta: id_prg,
    };

    SaveAnswerPost(arrayRes);
    IrAprgFin('prg'+(num_prg+1),(num_prg+1));

}




function Selectoption(num_repuesta, num_pregunta){      
    if(num_repuesta == 1){ 
        $('#OR1PP'+num_pregunta).removeClass('white black').addClass('green');

        $('#OR2PP'+num_pregunta).removeClass('green');
        $('#OR3PP'+num_pregunta).removeClass('green');           
        $('#OR4PP'+num_pregunta).removeClass('green'); 

        
        $('#OR2PP'+num_pregunta+' p').removeClass('white-text').addClass('black-text'); 
        $('#OR3PP'+num_pregunta+' p').removeClass('white-text').addClass('black-text');
        $('#OR4PP'+num_pregunta+' p').removeClass('white-text').addClass('black-text');
        $('#OR1PP'+num_pregunta+' p').removeClass('black-text').addClass('white-text');

        
        $('#resp2_prg'+num_pregunta).attr( 'checked', false);
        $('#resp3_prg'+num_pregunta).attr( 'checked', false);
        $('#resp4_prg'+num_pregunta).attr( 'checked', false); 
        $('#resp1_prg'+num_pregunta).attr( 'checked', true); 
    }
    if(num_repuesta == 2){
        $('#OR2PP'+num_pregunta).removeClass('white black').addClass('green');      

        $('#OR1PP'+num_pregunta).removeClass('green');        
        $('#OR3PP'+num_pregunta).removeClass('green');           
        $('#OR4PP'+num_pregunta).removeClass('green'); 

        $('#OR1PP'+num_pregunta+' p').removeClass('white-text').addClass('black-text'); 
        $('#OR3PP'+num_pregunta+' p').removeClass('white-text').addClass('black-text');
        $('#OR4PP'+num_pregunta+' p').removeClass('white-text').addClass('black-text');
        $('#OR2PP'+num_pregunta+' p').removeClass('black-text').addClass('white-text');


        $('#resp1_prg'+num_pregunta).attr( 'checked', false);        
        $('#resp3_prg'+num_pregunta).attr( 'checked', false);
        $('#resp4_prg'+num_pregunta).attr( 'checked', false);  
        $('#resp2_prg'+num_pregunta).attr( 'checked', true);
    }
    if(num_repuesta == 3){
        $('#OR3PP'+num_pregunta).removeClass('white black').addClass('green');    

        $('#OR1PP'+num_pregunta).removeClass('green');
        $('#OR2PP'+num_pregunta).removeClass('green');
        $('#OR4PP'+num_pregunta).removeClass('green');           
         

        $('#OR1PP'+num_pregunta+' p').removeClass('white-text').addClass('black-text'); 
        $('#OR2PP'+num_pregunta+' p').removeClass('white-text').addClass('black-text');       
        $('#OR4PP'+num_pregunta+' p').removeClass('white-text').addClass('black-text');
        $('#OR3PP'+num_pregunta+' p').removeClass('black-text').addClass('white-text');


        $('#resp1_prg'+num_pregunta).attr( 'checked', false);
        $('#resp2_prg'+num_pregunta).attr( 'checked', false);
        $('#resp4_prg'+num_pregunta).attr( 'checked', false);  
        $('#resp3_prg'+num_pregunta).attr( 'checked', true);
    }
    if(num_repuesta == 4){
        $('#OR4PP'+num_pregunta).removeClass('white black').addClass('green');

        $('#OR1PP'+num_pregunta).removeClass('green'); 
        $('#OR2PP'+num_pregunta).removeClass('green');
        $('#OR3PP'+num_pregunta).removeClass('green');           
        
        $('#OR1PP'+num_pregunta+' p').removeClass('white-text').addClass('black-text'); 
        $('#OR2PP'+num_pregunta+' p').removeClass('white-text').addClass('black-text');
        $('#OR3PP'+num_pregunta+' p').removeClass('white-text').addClass('black-text');
        $('#OR4PP'+num_pregunta+' p').removeClass('black-text').addClass('white-text');




        $('#resp1_prg'+num_pregunta).attr( 'checked', false);
        $('#resp2_prg'+num_pregunta).attr( 'checked', false);
        $('#resp3_prg'+num_pregunta).attr( 'checked', false);
        $('#resp4_prg'+num_pregunta).attr( 'checked', true);  
    }
}//fin funcion Selectoption
