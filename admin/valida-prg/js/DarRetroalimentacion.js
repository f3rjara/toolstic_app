var id_prg ="";
var id_frm = "";

function GetIdPrgRetro(id_Pregunta){    
    id_prg = id_Pregunta;
    id_frm = "#FPER_PRG_"+id_Pregunta;
}


jQuery(document).on('submit',id_frm, function(event){
    event.preventDefault();   
    event.stopPropagation(); 
    console.log("Recuperando datos de retroalimentación en la pregunta");  

    var id_estado_prg = $('#FPER_SEP_'+id_prg).val();
    var retro_prg = $('#FPER_RETRO_'+id_prg).val();
    
    if(retro_prg === null || retro_prg == "" && id_estado_prg != 4){
        Toast.fire({
            type: 'error',
            title: 'Debes agregar una retroalimentación a la pregunta'
          });
        $('#FPER_RETRO_'+id_prg).focus(); 
        return false;
    }

    Swal.fire({
        title: 'La información es correcta?',
        text: 'Va a cambiar el estado de la pregunta y enviar la retroalimentación correspondiente!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, todo correcto!'
    })
    .then((result) => {
        if (result.value) {             
            RunCrearRetro(id_prg,id_estado_prg,retro_prg);
            Swal.fire(
                'Pregunta validada!',
                'Se valido con exito la pregunta. La retroalimentación se envió al  creador de la pregunta.',
                'success'
            ); 
            console.log("Success");
            setTimeout(function(){ location.reload(); }, 1500); 
        }; //fin if result
    }); //fin then 
        
});

function RunCrearRetro(id_prg,id_estado_prg,retro_prg) {
    $.ajax({        
        type: "POST",
        data: {        
            id_prg: id_prg,
            id_estado_prg: id_estado_prg,
            retro_prg: retro_prg           
        },         
        url: "php/RunCrearRetro.php",       
        success: function(res){ 
            console.log(res);
            var data = jQuery.parseJSON(res);            
            console.log(data);
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
}