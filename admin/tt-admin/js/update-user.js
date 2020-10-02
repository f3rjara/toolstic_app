//VALIDAR SOLO EL INGRESO DE NUMEROS
function justNumbers2(e){
    var keynum = window.event ? window.event.keyCode : e.which;    
    if ((keynum == 8) || (keynum == 46))
    return true;            
    return /\d/.test(String.fromCharCode(keynum));
};


function justWord2(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8 || tecla == 32) {
        return true;
    }
    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[A-Za-z]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
};
var IdUsuario;
var FormData;

function Idclickeado(id_user){
    console.log(id_user);
    IdUsuario = id_user;
    FormData = '#ActualizaDatos'+IdUsuario;
    
};



jQuery(document).on('submit',FormData, function(event){
    event.preventDefault();  
   
    var FUU_id_user = $('#Actualiza_id_user_'+IdUsuario).val();
    var FUU_name = $('#Actualiza_name_'+IdUsuario).val();
    var FUU_apellido = $('#Actualiza_apellido_'+IdUsuario).val();
    var FUU_tipo_user = $('#Actualiza_tipo_user_'+IdUsuario).val();
    var FUU_correo_user = $('#Actualiza_correo_user_'+IdUsuario).val();
    var FUU_reset_pw = $('#Actualiza_reset_pw_'+IdUsuario).prop('checked');
       
    if(FUU_id_user===null || FUU_id_user==""){
        Toast.fire({
              type: 'error',
              title: 'Debes digitar el número de documento del usuario'
            });
        $('#FUU_id_user').focus();       
        return false;
    }

    else if(FUU_name===null || FUU_name=="" || FUU_name == " "){
        Toast.fire({
              type: 'error',
              title: 'Debes digitar los nombres del usuario'
            });
        $('#FUU_name').focus();       
        return false;
    }

    else if(FUU_apellido===null || FUU_apellido=="" || FUU_apellido == " "){
        Toast.fire({
              type: 'error',
              title: 'Debes digitar los apellidos del usuario'
            });
        $('#FUU_apellido').focus();       
        return false;
    }

    else if(FUU_tipo_user===null || FUU_tipo_user=="" || FUU_tipo_user == " "){
        Toast.fire({
              type: 'error',
              title: 'Debes seleccionar un tipo de usuario'
            });
        $('#FUU_tipo_user').focus();       
        return false;
    }

    else if(FUU_correo_user===null || FUU_correo_user=="" || FUU_correo_user == " "){
        Toast.fire({
              type: 'error',
              title: 'Debes un correo electronico para el usuario'
            });
        $('#FUU_correo_user').focus();          
        return false;
        
    }   
    else{
        Toast.fire({
            type: 'warning',
            title: '¿quieres restablecer la contraseña?'
        });       
    };  

    var DatosUsuario1 = new Array(FUU_id_user,FUU_name,FUU_apellido,FUU_tipo_user,FUU_correo_user,FUU_reset_pw);      
    setTimeout(function(){         
            Swal.fire({
                title: 'La información es correcta?',
                text: "Va a actualizar los datos del usuario!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, todo correcto!'
            })
            .then((result) => {
                if (result.value) {             
                    ActualizacionUser(DatosUsuario1);            
                    Swal.fire(
                        'Usuario Actualizado!',
                        'el usuario seleccionado fue actualizado con exito.',
                        'success'
                    ); 
                    console.log("Success");
                    setTimeout(function(){ location.reload(); }, 1800); 
                }; //fin if result
            }); //fin then    
        }, 600);//fin time
    }); //FIN Obtener datos del formulario

function ActualizacionUser(DatosUsuario1){    
    $.ajax({        
        type: "POST",
        data: {
            FUU_id_user: DatosUsuario1[0],
            FUU_name: DatosUsuario1[1],
            FUU_apellido: DatosUsuario1[2],
            FUU_tipo_user: DatosUsuario1[3],
            FUU_correo_user: DatosUsuario1[4],
            FUU_reset_pw: DatosUsuario1[5]          
        },        
        url: "php/RunUpdateUser.php",       
        success: function(res){ 
            var data = jQuery.parseJSON(res);   
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
}; //FIN FUNCION

    
 