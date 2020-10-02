var GetPeriodoID = "";
var IdFormulario = "";

function GetIdPeriodo(id){    
    GetPeriodoID = id;
    IdFormulario = '#FPE_Periodo_'+GetPeriodoID;
};

jQuery(document).on('submit',IdFormulario, function(event){
    event.preventDefault();   
    event.stopPropagation();
    console.log("Recuperando datos para editar un nuevo periodo");
    
    var FUP_id_periodo = GetPeriodoID;
    var FUP_year = $('#FUP_year_'+GetPeriodoID).val();
    var FUP_periodo = $('#FUP_periodo_'+GetPeriodoID).val();
    var FUP_estado_periodo = $('#FUP_estado_periodo_'+GetPeriodoID).val();   

    if(FUP_year===null || FUP_year==""){
        Toast.fire({
              type: 'error',
              title: 'Debes digitar un año para el periodo'
            });
        $('#FUP_year_'+GetPeriodoID).focus();       
        return false;
    }

    else if(FUP_periodo===null || FUP_periodo==""){
        Toast.fire({
              type: 'error',
              title: 'Debes digitar un nombre que identifique el periodo'
            });
        $('#FUP_periodo_'+GetPeriodoID).focus();       
        return false;
    }

    Swal.fire({
        title: 'La información es correcta?',
        text: 'Va a crear un nuevo periodo!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, todo correcto!'
    })
    .then((result) => {
        if (result.value) {             
            UpdatePeriodo(FUP_id_periodo,FUP_year,FUP_periodo,FUP_estado_periodo);
            Swal.fire(
                'Periodo Modificado!',
                'el periodo fue actualizado con exito.',
                'success'
            ); 
            console.log("Success");
            setTimeout(function(){ location.reload(); }, 1700); 
        }; //fin if result
    }); //fin then 
    
});

function UpdatePeriodo(FUP_id_periodo,FUP_year,FUP_periodo,FUP_estado_periodo) {
    $.ajax({        
        type: "POST",
        data: {   
            FUP_id_periodo: FUP_id_periodo,             
            FUP_year: FUP_year,
            FUP_periodo: FUP_periodo,
            FUP_estado_periodo: FUP_estado_periodo
        },         
        url: "php/RunUpdatePeriodo.php",       
        success: function(res){ 
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
};


