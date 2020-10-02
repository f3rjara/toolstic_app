var id_prueba_Select ="";
var FormularioPrueba = "";

function ObtenerIdPrueba(id_prueba) {    
    id_prueba_Select = id_prueba;
    FormularioPrueba = "#FPE_Prueba_"+id_prueba_Select;
};

jQuery(document).on('submit',FormularioPrueba, function(event){
    event.preventDefault();   
    event.stopPropagation();
    console.log("Recuperando datos para editar la prueba");
    
    var FPE_Id_prueba = id_prueba_Select;
    var FPE_prueba = $('#FPE_prueba_'+id_prueba_Select).val();
    var FPE_fecha_aplicacion = $('#FPE_fecha_aplicacion_'+id_prueba_Select).val();
    var FPE_fecha_inscripcion = $('#FPE_fecha_inscripcion_'+id_prueba_Select).val();   
    var FPE_sede = $('#FPE_sede_'+id_prueba_Select).val();   
    var FPE_periodo = $('#FPE_periodo_'+id_prueba_Select).val();   
    var FPE_estado_prueba = $('#FPE_estado_prueba_'+id_prueba_Select).val();   

       
    if(FPE_prueba===null || FPE_prueba=="" || FPE_prueba == " "){
        Toast.fire({
              type: 'error',
              title: 'Debes digitar un nombre para la prueba'
            });
        $('#FPE_prueba_'+FPE_Id_prueba).focus();       
        return false;
    }

    else if(FPE_fecha_aplicacion===null || FPE_fecha_aplicacion==" "){
        Toast.fire({
              type: 'error',
              title: 'Debes digitar una fecha de aplicación'
            });
        $('#FPE_fecha_aplicacion_'+FPE_Id_prueba).focus();       
        return false;
    }

    else if(FPE_fecha_inscripcion===null || FPE_fecha_inscripcion==" "){
        Toast.fire({
              type: 'error',
              title: 'Debes digitar una fecha de inscripción'
            });
        $('#FPE_fecha_inscripcion_'+FPE_Id_prueba).focus();       
        return false;
    }

    else if(FPE_fecha_inscripcion >= FPE_fecha_aplicacion){
        Toast.fire({
              type: 'error',
              title: 'La fecha de inscripción no puede ser mayor o igual a la fecha de aplicación'
            });
        $('#FPE_fecha_inscripcion_'+FPE_Id_prueba).focus();       
        return false;
    }

    if(FPE_sede===null || FPE_sede=="" || FPE_sede == "0"){
        Toast.fire({
              type: 'error',
              title: 'Debes una sede de aplicación para la prueba'
            });
        $('#FPE_sede_'+FPE_Id_prueba).focus();       
        return false;
    }

    if(FPE_periodo===null || FPE_periodo=="" || FPE_periodo == "0"){
        Toast.fire({
              type: 'error',
              title: 'Debes un periodo para la prueba'
            });
        $('#FPE_periodo_'+FPE_Id_prueba).focus();       
        return false;
    }



    console.log(FPE_Id_prueba);
    console.log(FPE_prueba);
    console.log(FPE_fecha_aplicacion);
    console.log(FPE_fecha_inscripcion);
    console.log(FPE_sede);
    console.log(FPE_periodo);
    console.log(FPE_estado_prueba);


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
            RunActualizaPrueba(FPE_Id_prueba,FPE_prueba,FPE_fecha_aplicacion,FPE_fecha_inscripcion,FPE_sede,FPE_periodo,FPE_estado_prueba);
            Swal.fire(
                'Prueba Modificada!',
                'La prueba fue actualizada con exito.',
                'success'
            ); 
            console.log("Success");
            setTimeout(function(){ location.reload(); }, 1700); 
        }; //fin if result
    }); //fin then 
    
});

function RunActualizaPrueba(FPE_Id_prueba,FPE_prueba,FPE_fecha_aplicacion,FPE_fecha_inscripcion,FPE_sede,FPE_periodo,FPE_estado_prueba) {
    $.ajax({        
        type: "POST",
        data: {   
            FPE_Id_prueba: FPE_Id_prueba,
            FPE_prueba: FPE_prueba,
            FPE_fecha_aplicacion: FPE_fecha_aplicacion,
            FPE_fecha_inscripcion: FPE_fecha_inscripcion,
            FPE_sede: FPE_sede,
            FPE_periodo: FPE_periodo,
            FPE_estado_prueba: FPE_estado_prueba
        },         
        url: "php/RunUpdatePrueba.php",       
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
};


