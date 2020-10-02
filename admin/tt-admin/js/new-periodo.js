jQuery(document).on('submit','#Fnew_Periodo', function(event){
    event.preventDefault();   
    event.stopPropagation();
    console.log("Recuperando datos para crear un nuevo periodo");

    var FNP_year = $('#FNP_year').val();
    var FNP_periodo = $('#FNP_periodo').val();
    var FNP_estado_periodo = $('#FNP_estado_periodo').val();   

    if(FNP_year===null || FNP_year==""){
        Toast.fire({
              type: 'error',
              title: 'Debes digitar un año para el periodo'
            });
        $('#FNP_year').focus();       
        return false;
    }

    else if(FNP_periodo===null || FNP_periodo==""){
        Toast.fire({
              type: 'error',
              title: 'Debes digitar un nombre que identifique el periodo'
            });
        $('#FNP_periodo').focus();       
        return false;
    }

    console.log(FNP_year);
    console.log(FNP_periodo);
    console.log(FNP_estado_periodo);

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
            NewPeriodo(FNP_year,FNP_periodo,FNP_estado_periodo);
            Swal.fire(
                'Periodo Creado!',
                'el periodo fue creado con exito.',
                'success'
            ); 
            console.log("Success");
            setTimeout(function(){ location.reload(); }, 1700); 
        }; //fin if result
    }); //fin then 
    
});

function NewPeriodo(FNP_year,FNP_periodo,FNP_estado_periodo) {
    $.ajax({        
        type: "POST",
        data: {                
            FNP_year: FNP_year,
            FNP_periodo: FNP_periodo,
            FNP_estado_periodo: FNP_estado_periodo
        },         
        url: "php/RunInsertPeriodo.php",       
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