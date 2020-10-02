function ocultar_busqueda_estu(){
    $('#busqueda_estu').hide('slow');
}
function mostrar_busqueda_estu(){
    $('#busqueda_estu').show('slow');
    $("body, main").animate({ scrollTop:($('#busqueda_estu')[0].scrollHeight)+200}, 2000);
}

ocultar_busqueda_estu();

function buscar_datos_est(consulta){
    $.ajax({
        url: './php/Shear_student.php',
        type: 'POST',
        dataType: 'html',
        data:{consulta:consulta},
    })
    .done(function(respuesta){        
        $("#datos").html(respuesta);
    })
    .fail(function(){
        console.log("error");
    })
}

function ShearStudent() {
    mostrar_busqueda_estu();
}

function mostrar_Res(elem){
    var valor = $(elem).val();
    if(valor != ""){
        console.log("Mostrando resultados");  
        buscar_datos_est(valor);
    }
    else{
        buscar_datos_est();
    }    
}

function cargar_modal(){    
    $('.modal').modal();
    $('.collapsible').collapsible();
    M.updateTextFields();
    //const Swal = require('sweetalert2');
}

function ResetPassEst(cod_estu){
    $( "#Chk_ResetPass" ).prop( "checked", true );
    console.log('Recibiendo codigo del estudiante');
    console.log(cod_estu);
    Swal.fire({
        title: 'Resetear contraseña?',
        text: "Va a resetear la contraseña al código: "+cod_estu,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, resetear!',
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false,
        allowEscapeKey:false
      }).then((result) => {
        $( "#Chk_ResetPass" ).prop( "checked", true );
        if (result.value) {

          $.ajax({        
            type: "POST",
            data: {   cod_estu: cod_estu },         
            url: "php/RunUpdatePwStudent.php",       
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
                else {
                  Swal.fire(
                    'Realizado!',
                    data['restext'],
                    'success'
                  );   
                }               
            }//Fin success
          }); // FIN DEL AJAX ENVIO DE DATOS A PHP

          setTimeout(() => {
            $( "#Chk_ResetPass" ).prop( "checked", false );
          }, 1500);
        }
        else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            Swal.fire(
                'Sin cambios!',   
                'No se realizo ningun cambio',
                'error'
            );
            document.getElementById("Chk_ResetPass").checked = false;
            
        } 
    });
    $( "#Chk_ResetPass" ).prop( "checked", false );
};


function CanInscEst(cod_estu){
    console.log('Recibiendo codigo del estudiante');
    Swal.fire({
        title: 'Cancelar Inscripción',
        text: "El estudiante va a dejar de estar inscrito en una prueba. ",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar inscripción!',
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false,
        allowEscapeKey:false
      }).then((result) => {
        if (result.value) {
          console.log("cancelar inscripcion");
          

        }
        else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            Swal.fire(
                'Sin cambios!',   
                'No se realizo ningun cambio',
                'error'
            );
            document.getElementById("Chk_CanIns").checked = false;
            
        } 
    });
};

function NewCuesEst(cod_estu){
    console.log('Recibiendo codigo del estudiante');
    console.log('Nuevo intento para estudiante');
    console.log( cod_estu );
    $( "#Chk_NewCues" ).prop( "checked", true );
    
    console.log(cod_estu);
    Swal.fire({
        title: 'Nuevo intento',
        text: "Brindar un nuevo intento para resolver el custionario? ",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, nuevo intento!',
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false,
        allowEscapeKey:false
      }).then((result) => {
        $( "#Chk_NewCues" ).prop( "checked", true );
        if (result.value) {
          $.ajax({        
            type: "POST",
            data: { cod_estu: cod_estu },         
            url: "php/RunNeeIntentoStudent.php",       
            success: function(res_new){ 
                console.log ( res_new )
                var data_new = jQuery.parseJSON(res_new);            
                console.log(data_new);
                if(!data_new['res']){
                      Swal.fire(
                      'Uppps!',
                      data_new['restext'],
                      'error'
                    );    
                    return false;            
                }
                else {
                  Swal.fire(
                    'Realizado!',
                    data_new['restext'],
                    'success'
                  );   
                }               
            }//Fin success
          }); // FIN DEL AJAX ENVIO DE DATOS A PHP
          setTimeout(() => {
            $( "#Chk_NewCues" ).prop( "checked", false );            
          }, 2000);

        }
        else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            Swal.fire(
                'Sin cambios!',   
                'No se realizo ningun cambio',
                'error'
            );
            document.getElementById("Chk_NewCues").checked = false;
            
        } 
    });

    $( "#Chk_NewCues" ).prop( "checked", false );

};
