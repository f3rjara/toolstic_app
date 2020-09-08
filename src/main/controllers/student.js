
function mostrarDatos(cod_estudiante) {    
    $.ajax({
        url:GetUrl.ROOT_MAIN_CON+"/models/mostarDatos.php" ,
        type: "POST",
        data: { codigo: cod_estudiante },       
        success: function(res) {
            var data = jQuery.parseJSON(res);     

            $('#NomEstudiante').html(data.datos.nombres_estudiante + " " + data.datos.apellidos_estudiante);
            $('#codEstudiante').html(data.datos.cod_estudiante);

            $('#NomEstudianteModal').html(data.datos.nombres_estudiante + " " + data.datos.apellidos_estudiante);
            $('#codEstudianteModal').html(data.datos.cod_estudiante);
            
            $('#TipoDocumentoEs').val(data.datos.tipo_documento);
            $('#CedulaEstudiante').val(data.datos.num_documento);

            $('#programaEstudiante').val(data.datos.programa);
            $('#semestreEstudiante').val(data.datos.semestre_estudiante + " Semestre");

            $('#CorreoEstudiante').val(data.datos.correo_estudiante);
            $('#TelefonoEstudiante').val(data.datos.telefono_estudiante);              
            
            M.updateTextFields();   
        }
    });
}

function mostrarDatosMenu(cod_estudiante) {
    $.ajax({
        url:GetUrl.ROOT_MAIN_CON+"/models/mostarDatos.php" ,
        type: "POST",
        data: { codigo: cod_estudiante },       
        success: function(res) {
            var data = jQuery.parseJSON(res);  
            $('#NombreLog').html(data.datos.nombres_estudiante);
            $('#ApellidoLog').html(data.datos.apellidos_estudiante);
            $('#CorreoLog').html(data.datos.correo_estudiante);         
        }
    });
}

function  accentDecode(tx) {
	var rp = String(tx);
	//
	rp = rp.replace(/&aacute;/g, 'á');
	rp = rp.replace(/&eacute;/g, 'é');
	rp = rp.replace(/&iacute;/g, 'í');
	rp = rp.replace(/&oacute;/g, 'ó');
	rp = rp.replace(/&uacute;/g, 'ú');
	rp = rp.replace(/&ñtilde;/g, 'ñ');
	rp = rp.replace(/&ntilde;/g, 'ñ');
	rp = rp.replace(/&uuml;/g, 'ü');
	//
	rp = rp.replace(/&Aacute;/g, 'Á');
	rp = rp.replace(/&Eacute;/g, 'É');
	rp = rp.replace(/&Iacute;/g, 'Í');
	rp = rp.replace(/&Oacute;/g, 'Ó');
	rp = rp.replace(/&Uacute;/g, 'Ú');
	rp = rp.replace(/&Ñtilde;/g, 'Ñ');
	rp = rp.replace(/&Ntilde;/g, 'Ñ');
	rp = rp.replace(/&Üuml;/g, 'Ü');
	//
	return rp;
};

function agregaDatosEdicion(cod_estudiante){    
    
    $.ajax({
        type: "POST",
        data: { codigo:cod_estudiante },
        url: GetUrl.ROOT_MAIN_CON+"/models/DatosEdicion.php",       
        success: function(r){            
            var datos=jQuery.parseJSON(r);

            var nombreCode = accentDecode(datos['nombres_estudiante']);
            var apellidoCode = accentDecode(datos['apellidos_estudiante']);
            var correoCode = accentDecode(datos['correo_estudiante']);

            $('#FAiduser').val(datos['cod_estudiate']);
            $('#FAnombre').val(nombreCode);
            $('#FAapellido').val(apellidoCode);
            $('#FAcorreo').val(correoCode);
            $('#FAtelefono').val(datos['telefono_estudiante']);

            M.updateTextFields();
        }
    })
}


jQuery(document).on('submit','#FRActualizaDatos', 
function(event){
    event.preventDefault(); 

    var CodigoUsuario = parseInt($('#codEstudianteModal').html());
    var NombreUsuario = $('#FAnombre').val();
    var ApellidoUsuario = $('#FAapellido').val();
    var CorreoUsuario = $('#FAcorreo').val();
    var TelUsuario = $('#FAtelefono').val();
    var PWUsuario = $('#FApassword').val();
    var NewPWUsuario = $('#FAnewpassword1').val();
    var RNewPWUsuario = $('#FAnewpassword2').val();

    var expresion = /\w+@\w+\.+[a-z]/; 
    //var expresionNPW = /^[0-9a-zA-Z]+$/;

    if(NombreUsuario == "" || NombreUsuario == null){
        Toast.fire({
              type: 'error',
              title: 'Debes agregar un nombre valido'
            });
        $('#FAnombre').focus();
        return false;
    }

    else if(NombreUsuario.length > 50){
        Toast.fire({
              type: 'error',
              title: 'El nombre digitado es muy largo'
            });
        $('#FAnombre').focus();
        return false;
    }

    else if(ApellidoUsuario == "" || ApellidoUsuario == null){
        Toast.fire({
              type: 'error',
              title: 'Debes agregar un apellido valido'
            });
        $('#FAnombre').focus();
        return false;
    }

    else if(ApellidoUsuario.length > 100){
        Toast.fire({
              type: 'error',
              title: 'El apellido digitado es muy largo'
            });
        $('#FAapellido').focus();
        return false;
    }

    else if(CorreoUsuario == "" || CorreoUsuario == " " || CorreoUsuario == null){
        Toast.fire({
              type: 'error',
              title: 'Debes digitar un correo valido'
            });
        $('#FAcorreo').focus();
        return false;
    }
    
    else if(CorreoUsuario.length > 50){
        Toast.fire({
              type: 'error',
              title: 'El correo digitado es muy largo'
            });
        $('#FAcorreo').focus();
        return false;
    }
    
    else if(!expresion.test(CorreoUsuario)){
        Toast.fire({
              type: 'error',
              title: 'El correo debe tener el formato solicitado \n usuario@dominio.com'
            });
        $('#FAcorreo').focus();
        return false;
    }
    
    else if(TelUsuario.length > 11 || TelUsuario.length < 10){
        Toast.fire({
              type: 'error',
              title: 'El telefono digitado no coincide con el formato'
            });
        $('#FAtelefono').focus();
        return false;
    }
    
    
    else if(isNaN(TelUsuario) || TelUsuario == "" || TelUsuario == null){
        Toast.fire({
              type: 'error',
              title: 'El teléfono digitado no es un número'
            });
        $('#FAtelefono').focus();
        return false;
    }

    else if(PWUsuario == "" || PWUsuario.length <= 0 || PWUsuario == null){
        Toast.fire({
              type: 'error',
              title: 'Debes agregar la última contraseña valida'
            });
        $('#FApassword').focus();
        return false;
    }

    else if(PWUsuario.length > 30){
        Toast.fire({
              type: 'error',
              title: 'La contraseña es muy larga, Maximo 30 digitos sin espacios'
            });
        $('#FApassword').focus();
        return false;
    }

    else if(NewPWUsuario.length > 30 || RNewPWUsuario.length > 30) {
        Toast.fire({
              type: 'error',
              title: 'La contraseña es muy larga, Maximo 30 digitos sin espacios'
            });
        $('#FAnewpassword1').focus();
        return false;
    }

    else if(NewPWUsuario !== RNewPWUsuario) {
        Toast.fire({
            type: 'error',
            title: 'Las Contraseñas digitadas no coinciden'
        });
    $('#FAnewpassword2').focus();
    return false;
    }

    else if(NewPWUsuario.length <= 0 || RNewPWUsuario.length <= 0){
        NewPWUsuario = false;
        RNewPWUsuario = false;
    }

    $.ajax({
        type: "POST",
        data: {
            CodigoUsuario : CodigoUsuario,
            NombreUsuario : NombreUsuario, 
            ApellidoUsuario: ApellidoUsuario,  
            CorreoUsuario : CorreoUsuario,
            TelUsuario: TelUsuario, 
            PWUsuario : PWUsuario,
            NewPWUsuario: NewPWUsuario, 
            RNewPWUsuario : RNewPWUsuario
        }, 
        url:  GetUrl.ROOT_MAIN_CON+"/models/ActualizaDatos.php" ,
        success: function(res) {
            var data = jQuery.parseJSON(res); 
            console.log(data);            
                      
            if(data.res == true){
                $('#modalActualiza').modal('close');
                $('#FRActualizaDatos')[0].reset();
                mostrarDatos(CodigoUsuario);
                agregaDatosEdicion(CodigoUsuario);
                mostrarDatosMenu(CodigoUsuario);      

                Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: data.resText,
                    showConfirmButton: false,
                    timer: 2000
                })

                if(data.Reinicio == true){
                    setTimeout(function(){ window.location= GetUrl.ROOT_INCLUDE_MEDIA+'/logout.php'; }, 1500);
                }

            }       
            else{
                Swal.fire({
                    position: 'top-end',
                    type: 'error',
                    title: data.resText,
                    showConfirmButton: false,
                    timer: 1500
                });
            }    
               
            
        }
    });

    
});


function EvitarEspacios(id){
    const input = document.getElementById(id);
   
    input.addEventListener("keydown", ev => {
    var code = ev.keyCode || ev.which;
        if(code == 32 && ev.repeat){
            ev.preventDefault();
        }
    });

    // Evento input
    input.addEventListener('input', ev => {
        var text = input.value;
        input.value = text.replace(/ {2,}/g, ' ');
    });

}