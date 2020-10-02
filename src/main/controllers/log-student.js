
//MOSTRAR CONTRASEÑA
function mostrarContrasena(){
    var tipo = document.getElementById("pw_valida");
    var btn = document.getElementById("MostratPW");            
    if(tipo.type == "password"){ 
        tipo.type = "text";
        btn.classList.remove('ToolsTic_Azul');
        btn.classList.add('red');
    }
    else{
        tipo.type = "password";
        btn.classList.remove('red');
        btn.classList.add('ToolsTic_Azul');
    }
};


//ENVIAR DATOS DE CONSULTA PARA INICAR SESION

jQuery(document).on('submit','#formlg', function(event){
    event.preventDefault();
    
    jQuery.ajax({
        url: GetUrl.ROOT_MAIN_CON +'/models/login_student.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function(){            
           document.getElementById('btnInicia').innerHTML = 'Validando...';
        }
    })
    
    .done(function(respuesta){
        console.log("Response received");
        console.log(respuesta);
        console.log("***************");
        if(respuesta.error === false){
            console.log("User Acepted");
            Swal.fire({                  
                type: 'success',
                title: 'Muy bien!...',
                text: 'Bienvenido a la Prueba de homologación ToolsTic!',
                showConfirmButton: false,                
                backdrop: 'rgba(11, 194, 64,0.3)',
                timer: 1600
            });                    
            setTimeout(function(){ location.href = GetUrl.ROOT_MEDIA_USER +'/student/index.php'; }, 1500);
        }
        else {
            console.log(respuesta.mens);
            console.log("User Negaded");            
            Swal.fire({
                position: 'bottom-end',
                type: 'error',
                title: respuesta.mens, 
                showConfirmButton: false,                
                backdrop: 'rgba(208, 29, 86,0.3)',
                timer: 1500
            });

            setTimeout(() => {
                if( respuesta.log ) {  

                    Swal.fire({
                        title: 'Desea cerrar sesión?',
                        text: "Ya tiene una sesión iniciada en otro navegador, ¿desea cerrar todas las sesiones, e iniciar una nueva aquí? \n  Tu prueba puede ser invalidada!. ",
                        type: 'warning',
                        showCancelButton: true,
                        cancelButtonText: 'No, conservarla',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, cerrar sesión!'
                    })
                    .then((result) => {
                        if(result.value) {
                            $.ajax({
                                type: "POST",
                                data: {student:respuesta.student},
                                //dataType: 'json',
                                url: GetUrl.ROOT_MAIN_CON +"/models/close_session.php",       
                                success: function(respuesta){ 
                                    console.log(respuesta); 
                                    var data = jQuery.parseJSON(respuesta);
                                    console.log(data);
                                    console.log("******");
                                    if(respuesta['res'] === false){
                                        Swal.fire(
                                            'Uppps!',
                                            respuesta['restext'],
                                            'error'
                                        );       
                                    }
                                    else {
                                        Swal.fire(
                                            'Realizado!',
                                            respuesta['restext'],
                                            'success'
                                        ); 
                                    }
                                }
                            }); 
                        };
                    });

                }
            }, 1800);     
            
            document.getElementById('btnInicia').innerHTML = 'Iniciar Sesión';    
        } 
    })
    
    .fail(function(resp){
        console.log("fail recivied");
        console.log(resp.responseText);        
    })
    
    .always(function(){
        console.log("Response complete");
    })
    
});