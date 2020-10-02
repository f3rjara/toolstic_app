jQuery(document).on('submit','#FPCN_Prueba', function(event){
    event.preventDefault();   
    event.stopPropagation();
    console.log("Recuperando datos para crear una nueva prueba");

    var FPCN_Prueba = $('#FNPR_prueba').val();
    var FNPR_fecha_aplicacion = $('#FNPR_fecha_aplicacion').val();
    var FNPR_fecha_inscripcion = $('#FNPR_fecha_inscripcion').val();
    var FNPR_sede = $('#FNPR_sede').val();
    var FNPR_periodo = $('#FNPR_periodo').val();
    var FNPR_estado_prueba = $('#FNPR_estado_prueba').val();

    
    if(FPCN_Prueba===null || FPCN_Prueba=="" || FPCN_Prueba == " "){
        Toast.fire({
              type: 'error',
              title: 'Debes digitar un nombre para la prueba'
            });
        $('#FNPR_prueba').focus();       
        return false;
    }

    else if(FNPR_fecha_aplicacion===null || FNPR_fecha_aplicacion==" "){
        Toast.fire({
              type: 'error',
              title: 'Debes digitar una fecha de aplicación'
            });
        $('#FNPR_fecha_aplicacion').focus();       
        return false;
    }

    else if(FNPR_fecha_inscripcion===null || FNPR_fecha_inscripcion==" "){
        Toast.fire({
              type: 'error',
              title: 'Debes digitar una fecha de inscripción'
            });
        $('#FNPR_fecha_inscripcion').focus();       
        return false;
    }

    else if(FNPR_fecha_inscripcion >= FNPR_fecha_aplicacion){
        Toast.fire({
              type: 'error',
              title: 'La fecha de inscripción no puede ser mayor o igual a la fecha de aplicación'
            });
        $('#FNPR_fecha_inscripcion').focus();       
        return false;
    }

    if(FNPR_sede===null || FNPR_sede=="" || FNPR_sede == "0"){
        Toast.fire({
              type: 'error',
              title: 'Debes una sede de aplicación para la prueba'
            });
        $('#FNPR_sede').focus();       
        return false;
    }

    if(FNPR_periodo===null || FNPR_periodo=="" || FNPR_periodo == "0"){
        Toast.fire({
              type: 'error',
              title: 'Debes un periodo para la prueba'
            });
        $('#FNPR_periodo').focus();       
        return false;
    }

    console.log(FPCN_Prueba);
    console.log(FNPR_fecha_aplicacion);
    console.log(FNPR_fecha_inscripcion);
    console.log(FNPR_sede);
    console.log(FNPR_periodo);
    console.log(FNPR_estado_prueba);

    Swal.fire({
        title: 'La información es correcta?',
        text: 'Va a crear un nueva  prueba!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, todo correcto!'
    })
    .then((result) => {
        if (result.value) {             
            NewPrueba(FPCN_Prueba,FNPR_fecha_aplicacion,FNPR_fecha_inscripcion,FNPR_sede,FNPR_periodo,FNPR_estado_prueba);
            Swal.fire(
                'Prueba Creada!',
                'La prueba fue creado con exito.',
                'success'
            ); 
            console.log("Success");
            setTimeout(function(){ location.reload(); }, 1700); 
        }; //fin if result
    }); //fin then 
    
});

function NewPrueba(FPCN_Prueba,FNPR_fecha_aplicacion,FNPR_fecha_inscripcion,FNPR_sede,FNPR_periodo,FNPR_estado_prueba) {
    $.ajax({        
        type: "POST",
        data: {        
            FPCN_Prueba: FPCN_Prueba,
            FNPR_fecha_aplicacion: FNPR_fecha_aplicacion,
            FNPR_fecha_inscripcion: FNPR_fecha_inscripcion,
            FNPR_sede: FNPR_sede,
            FNPR_periodo:FNPR_periodo,
            FNPR_estado_prueba: FNPR_estado_prueba
        },         
        url: "php/RunInsertPrueba.php",       
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

