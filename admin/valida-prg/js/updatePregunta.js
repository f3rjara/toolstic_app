$("body").animate({ scrollTop: $('#SelectLista1')[0].scrollHeight}, 2000);

jQuery(document).on('submit','#FormActualizaPrg', function(event){
    event.preventDefault();   
    
    console.log("Recuperando datos para actualizar pregunta");

    var IdPrguntaDelete = $('#IdPrguntaDelete').val();
    var idComptencia = $('#SelectLista1').val();
    var idEvidencia = $('#SelectLista2').val();
    var idTarea = $('#SelectLista3').val();
    var TxEnunciado = $('#TxEnunciado').val();
    var TxOpcion1 = $('#TxOpcion1').val();
    var TxOpcion2 = $('#TxOpcion2').val();
    var TxOpcion3 = $('#TxOpcion3').val();
    var TxOpcion4 = $('#TxOpcion4').val();

    var Idop1 = $('#Idop1').val();
    var Idop2 = $('#Idop2').val();
    var Idop3 = $('#Idop3').val();
    var Idop4 = $('#Idop4').val();
    


    var PesoTxOpcion1 = parseInt($('#PesoTxOpcion1').val());
    var PesoTxOpcion2 = parseInt($('#PesoTxOpcion2').val());
    var PesoTxOpcion3 = parseInt($('#PesoTxOpcion3').val());
    var PesoTxOpcion4 = parseInt($('#PesoTxOpcion4').val());

        
    if(idComptencia===null){
        Toast.fire({
              type: 'error',
              title: 'Debes seleccionar una competencia'
            });
        $('#SelectLista1').focus();
        $("body").animate({ scrollTop: $('#SelectLista1')[0].scrollHeight}, 2000);
        return false;
    }

    else if(idEvidencia===null || idEvidencia == 0 || idEvidencia =='whatever'){
        Toast.fire({
              type: 'error',
              title: 'Debes seleccionar una evidencia'
            });
        $('#SelectLista2').focus();
        $("body, main").animate({ scrollTop: $('#SelectLista2')[0].scrollHeight}, 2000);
        return false;
    }

    else if(idTarea===null || idTarea == 0 || idTarea =='whatever'){
        Toast.fire({
              type: 'error',
              title: 'Debes seleccionar una tarea'
            });
        $('#SelectLista3').focus();
        $("body, main").animate({ scrollTop:($('#SelectLista3')[0].scrollHeight)+200}, 2000);
        return false;
    }

    else if(TxEnunciado===null || TxEnunciado == "" || TxEnunciado == "&nbsp;"){
        Toast.fire({
              type: 'error',
              title: 'Debes escribir el enunciado de la pregunta'
            });      
        
        $("body, main").animate({ scrollTop:($('#TxEnunciado')[0].scrollHeight)+400}, 2000);  
        $('#TxEnunciado').summernote('focus'); 
        return false;
    }

    else if(TxOpcion1===null || TxOpcion1 == "" || TxOpcion1 == "&nbsp;" ){
        Toast.fire({
              type: 'error',
              title: 'Debes escribir la opción de respuesta No 1'
            });        
        $("body, main").animate({ scrollTop:($('#TxOpcion1')[0].scrollHeight)+600}, 2000); 
        $('#TxOpcion1').summernote('focus');  
        return false;
    }

    else if(TxOpcion2===null || TxOpcion2 == "" || TxOpcion2 == "&nbsp;"){
        Toast.fire({
              type: 'error',
              title: 'Debes escribir la opción de respuesta No 2'
            });        
        $("body, main").animate({ scrollTop:($('#TxOpcion2')[0].scrollHeight)+800}, 2000);  
        $('#TxOpcion2').summernote('focus');  
        return false;
    }

    else if(TxOpcion3===null || TxOpcion3 == "" || TxOpcion3 == "&nbsp;"){
        Toast.fire({
              type: 'error',
              title: 'Debes escribir la opción de respuesta No 3'
            });
        
        $("body, main").animate({ scrollTop:($('#TxOpcion3')[0].scrollHeight)+1000}, 2000); 
        $('#TxOpcion3').summernote('focus');    
        return false;
    }

    else if(TxOpcion4===null || TxOpcion4 == "" || TxOpcion4 == "&nbsp;"){
        Toast.fire({
              type: 'error',
              title: 'Debes escribir la opción de respuesta No 4'
            });
        
        $("body, main").animate({scrollTop:($('#TxOpcion4')[0].scrollHeight)+1200}, 2000);   
        $('#TxOpcion4').summernote('focus');  
        return false;
    }

    else if(PesoTxOpcion1===null || isNaN(PesoTxOpcion1)=== true){
        Toast.fire({
              type: 'error',
              title: 'Debes seleccionar un peso para la respuesta No 1'
            });
        
        $("body, main").animate({ scrollTop:($('#PesoTxOpcion1')[0].scrollHeight)+600}, 2000);        
        $('#PesoTxOpcion1').focus(); 
        return false;
    }

    else if(PesoTxOpcion2===null || isNaN(PesoTxOpcion2)=== true ){
        Toast.fire({
              type: 'error',
              title: 'Debes seleccionar un peso para la respuesta No 2'
            });
        
        $("body, main").animate({ scrollTop:($('#PesoTxOpcion2')[0].scrollHeight)+800}, 2000);        
        $('#PesoTxOpcion2').focus(); 
        return false;
    }

    else if(PesoTxOpcion3===null || isNaN(PesoTxOpcion3)=== true){
        Toast.fire({
              type: 'error',
              title: 'Debes seleccionar un peso para la respuesta No 3'
            });
        
        $("body, main").animate({ scrollTop:($('#PesoTxOpcion3')[0].scrollHeight)+1000}, 2000);        
        $('#PesoTxOpcion3').focus(); 
        return false;
    }

    else if(PesoTxOpcion4===null || isNaN(PesoTxOpcion4)=== true){
        Toast.fire({
              type: 'error',
              title: 'Debes seleccionar un peso para la respuesta No 4'
            });
        
        $("body, main").animate({ scrollTop:($('#PesoTxOpcion4')[0].scrollHeight)+1200}, 2000);        
        $('#PesoTxOpcion4').focus(); 
        return false;
    }    

    

    Swal.fire({
        title: 'La información es correcta?',
        text: "Se va a actualizar la pregunta!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, todo correcto!'
    })
    .then((result) => {
        if (result.value) {                        

            var ArrayPregunta = new Array(idComptencia, idEvidencia, idTarea,TxEnunciado,TxOpcion1,TxOpcion2,TxOpcion3,TxOpcion4,PesoTxOpcion1,PesoTxOpcion2,PesoTxOpcion3,PesoTxOpcion4,IdPrguntaDelete, Idop1, Idop2, Idop3, Idop4);
            
            EjecutarUpdatePregunta(ArrayPregunta);

            Swal.fire(
                'Pregunta actualizada!',
                'La pregunta fue actualizada con exito.',
                'success'
            ); 
            console.log("Success");
            setTimeout(function(){ window.location='./listar-preguntas.php'; }, 1800);            
        }; //fin if result
    }); //fin then
}); //FIN Obtener datos del formulario

//FUNCION PARA EJECUTAR 
function EjecutarUpdatePregunta(array){    
    var TxOpcion1 = array[4];
    var TxOpcion2 = array[5];
    var TxOpcion3 = array[6];
    var TxOpcion4 = array[7];
    var PesoTxOpcion1 = array[8];
    var PesoTxOpcion2 = array[9];
    var PesoTxOpcion3 = array[10];
    var PesoTxOpcion4 = array[11];
    var IdPrguntaDelete = array[12];
    var Idop1 = array[13];
    var Idop2 = array[14];
    var Idop3 = array[15];
    var Idop4 = array[16];


    $.ajax({
        type: "POST",
        data: {
            idTarea: array[2],
            TxEnunciado: array[3],
            IdPrguntaDelete: array[12]            
        },        
        url: "php/RunUpdatePregunta.php",       
        success: function(res){             
            var data = jQuery.parseJSON(res);  
            
            UpdateOpcionesRtaPrg(IdPrguntaDelete,TxOpcion1,TxOpcion2,TxOpcion3,TxOpcion4,PesoTxOpcion1,PesoTxOpcion2,PesoTxOpcion3,PesoTxOpcion4,Idop1,Idop2,Idop3,Idop4);   

            if(!data['res']){
              Swal.fire(
                'Uppps!',
                data['restext'],
                'error'
              );    
              return false;            
            }                 
        }//Fin success
    }); // FIN DEL AJAX ENVIO DE DATOS A PHP
};


function UpdateOpcionesRtaPrg(IdPrguntaDelete,TxOpcion1,TxOpcion2,TxOpcion3,TxOpcion4,PesoTxOpcion1,PesoTxOpcion2,PesoTxOpcion3,PesoTxOpcion4,Idop1,Idop2,Idop3,Idop4){     
    $.ajax({
        type: "POST",
        data: {
            id_Prg: IdPrguntaDelete,
            TxOpcion1: TxOpcion1,
            TxOpcion2: TxOpcion2,
            TxOpcion3: TxOpcion3,
            TxOpcion4: TxOpcion4,
            PesoTxOpcion1:PesoTxOpcion1,
            PesoTxOpcion2:PesoTxOpcion2,
            PesoTxOpcion3:PesoTxOpcion3,
            PesoTxOpcion4:PesoTxOpcion4,
            Idop1: Idop1,
            Idop2: Idop2,
            Idop3: Idop3,
            Idop4: Idop4
        },        
        url: "php/RunUpdateRespuestas.php",       
        success: function(res){    
            var data1 = jQuery.parseJSON(res);                   
            if(!data1['res']){
              Swal.fire(
                'Uppps!',
                data1['restext'],
                'error'
              );    
              return false;            
            }                
        }//Fin success
    }); // FIN DEL AJAX ENVIO DE DATOS A PHP
};