jQuery(document).on('submit','#FNew_User', function(event){
    event.preventDefault();   
    event.stopPropagation();
    console.log("Recuperando datos para crear usuario");

    var FNewUs_id_user = $('#FNewUs_id_user').val();
    var FNewUs_name = $('#FNewUs_name').val();
    var FNewUs_apellido = $('#FNewUs_apellido').val();
    var FNewUs_tipo_user = $('#FNewUs_tipo_user').val();
    var FNewUs_correo = $('#FNewUs_correo').val();    

    if(FNewUs_id_user===null || FNewUs_id_user==""){
        Toast.fire({
              type: 'error',
              title: 'Debes digitar el número de documento del usuario'
            });
        $('#FNewUs_id_user').focus();       
        return false;
    }

    else if(FNewUs_name===null || FNewUs_name=="" || FNewUs_name == " "){
        Toast.fire({
              type: 'error',
              title: 'Debes digitar los nombres del usuario'
            });
        $('#FNewUs_name').focus();       
        return false;
    }

    else if(FNewUs_apellido===null || FNewUs_apellido=="" || FNewUs_apellido == " "){
        Toast.fire({
              type: 'error',
              title: 'Debes digitar los apellidos del usuario'
            });
        $('#FNewUs_apellido').focus();       
        return false;
    }

    else if(FNewUs_correo===null || FNewUs_correo=="" || FNewUs_correo == " "){
        Toast.fire({
              type: 'error',
              title: 'Debes un correo electronico para el usuario'
            });
        $('#FNewUs_correo').focus();          
        return false;
        
    } 

    else if(FNewUs_tipo_user===null || FNewUs_tipo_user=="" || FNewUs_tipo_user == 0){
        Toast.fire({
              type: 'error',
              title: 'Debes seleccionar un tipo de usuario'
            });
        $('#FNewUs_tipo_user').focus();       
        return false;
    }

    

    var DatosUsuarioFNewUs = new Array(FNewUs_id_user,FNewUs_name,FNewUs_apellido,FNewUs_tipo_user,FNewUs_correo);
    console.log(DatosUsuarioFNewUs);
    Swal.fire({
        title: 'La información es correcta?',
        text: 'Va a crear un nuevo usuario!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, todo correcto!'
    })
    .then((result) => {
        if (result.value) {             
            NewUser(DatosUsuarioFNewUs);
            Swal.fire(
                'Usuario Creado!',
                'el usuario seleccionado fue creado con exito.',
                'success'
            ); 
            console.log("Success");
            setTimeout(function(){ location.reload(); }, 1700); 
        }; //fin if result
    }); //fin then    

}); //FIN Obtener datos del formulario



function NewUser(DatosUsuarioFNewUs){
    $.ajax({        
        type: "POST",
        data: {                
            FNewUs_id_user: DatosUsuarioFNewUs[0],
            FNewUs_name: DatosUsuarioFNewUs[1],
            FNewUs_apellido: DatosUsuarioFNewUs[2],
            FNewUs_tipo_user: DatosUsuarioFNewUs[3],
            FNewUs_correo: DatosUsuarioFNewUs[4]
        },         
        url: "php/RunInsertUser.php",       
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
}; //FIN FUNCION

    
 