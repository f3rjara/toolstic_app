function mostrarDatos() {
    M.updateTextFields();
    $.ajax({
        url:"php/mostarDatos.php" ,
        success: function(r) {
            $('#InformaUsuario').html(r);
        }
    });
}


function ActualizaDatos() {
    event.stopPropagation();
    M.updateTextFields();
    var NombreUsur = $('#FAnombre').val();
    var ApellidoUsur = $('#FAapellido').val();
    var PWUsuar = $('#FApassword').val();
    var NewPWUsur = $('#FAnewpassword1').val();
    var RNewPWUsur = $('#FAnewpassword2').val();
    var CorreoUsur = $('#FAcorreo').val();
    var TelUsur = $('#FAtelefono').val();
    
    
    if(NewPWUsur !== RNewPWUsur)
        {
            Toast.fire({
              type: 'error',
              title: 'Las Contraseña debe coincidir'
            });
        $('#FAnewpassword2').focus();
        return false;
        }
    
    var expresion = /\w+@\w+\.+[a-z]/; 
    var expresionNPW = /^[0-9a-zA-Z]+$/; 
    
    if(NombreUsur==""){
        Toast.fire({
              type: 'error',
              title: 'Debes agregar un nombre valido'
            });
        $('#FAnombre').focus();
        return false;
    }
    
    else if(NombreUsur.length>50){
        Toast.fire({
              type: 'error',
              title: 'El nombre es muy largo'
            });
        $('#FAnombre').focus();
        return false;
    }
    
    else if(ApellidoUsur==""){
        Toast.fire({
              type: 'error',
              title: 'Debes agregar un apellido valido'
            });
        $('#FAapellido').focus();
        return false;
    }
    
    else if(ApellidoUsur.length>100){
        Toast.fire({
              type: 'error',
              title: 'El apellido es muy largo'
            });
        $('#FAapellido').focus();
        return false;
    }
    
    
    else if(PWUsuar==""){
        Toast.fire({
              type: 'error',
              title: 'Debes agregar la última contraseña valida'
            });
        $('#FApassword').focus();
        return false;
    }
    
    else if(PWUsuar.length>30){
        Toast.fire({
              type: 'error',
              title: 'La contraseña es muy larga, Maximo 30 digitos sin espacios'
            });
        $('#FApassword').focus();
        return false;
    }
    
    else if(NewPWUsur.length>30){
        Toast.fire({
              type: 'error',
              title: 'La contraseña es muy larga, Maximo 30 digitos sin espacios'
            });
        $('#FAnewpassword1').focus();
        return false;
    }
    
     
    
    else if(RNewPWUsur.length>30){
        Toast.fire({
              type: 'error',
              title: 'La contraseña es muy larga, Maximo 30 digitos sin espacios'
            });
        $('#FAnewpassword2').focus();
        return false;
    }
    
    
    else if(CorreoUsur==""){
        Toast.fire({
              type: 'error',
              title: 'Debes agregar un correo valido'
            });
        $('#FAcorreo').focus();
        return false;
    }
    
    else if(CorreoUsur.length>50){
        Toast.fire({
              type: 'error',
              title: 'El correo esta muy largo'
            });
        $('#FAcorreo').focus();
        return false;
    }
    
    else if(!expresion.test(CorreoUsur)){
        Toast.fire({
              type: 'error',
              title: 'El correo debe tener el formato solicitado \n usuario@dominio.com'
            });
        $('#FAcorreo').focus();
        return false;
    }
    
    
    else if(TelUsur.length>11){
        Toast.fire({
              type: 'error',
              title: 'El telefono esta mal escrito'
            });
        $('#FAtelefono').focus();
        return false;
    }
    
    
    else if(isNaN(TelUsur)){
        Toast.fire({
              type: 'error',
              title: 'El teléfono digitado no es un número'
            });
        $('#FAtelefono').focus();
        return false;
    }
    
    
    var Usuario = $('#FAiduser').val();
    
    
    $.ajax({
        type: "POST",
        data: $('#FRActualizaDatos').serialize(), 
        url:"php/ActualizaDatos.php" ,
        success: function(r) {
            var data = jQuery.parseJSON(r); 
            var res=  data['res'];            
            var bandera = data['bandera']; 
            console.log(bandera);
            if(res==1){
                mostrarDatos();
                $('#modalActualiza').modal('close');
                $('#FRActualizaDatos')[0].reset();
                agregaDatosEdicion(Usuario);                
                if(bandera == 'true'){
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Debes iniciar sesión nuevamente',
                        showConfirmButton: false,
                        timer: 1500
                      })
                    setTimeout(function(){ window.location='./../logout.php'; }, 1000);
                }       
                else{
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Sus datos fueron actualizados con exito',
                        showConfirmButton: false,
                        timer: 1500
                      })
                }
            }            
            else if(r==2){
                Toast.fire({
                  type: 'error',
                  title: 'Error en la contraseña'
                });
                $('#FApassword').focus();
            }
            else{
                Toast.fire({
                  type: 'error',
                  title: 'Fallo al Actualizar'
                });
            }
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



function agregaDatosEdicion(id){    
    M.updateTextFields();
    $.ajax({
        type: "POST",
        data: {
            id:id
        },
        url: "php/DatosEdicion.php",
        success: function(res){             
            var datos = jQuery.parseJSON(res);             
                                    
            var nombreCode = accentDecode(datos['nommbre']);
            var apellidoCode = accentDecode(datos['apellidos']);
            var correoCode = accentDecode(datos['correo']);
            
            $('#NombreLog').html(nombreCode);
            $('#ApellidoLog').html(apellidoCode);
            $('#CorreoLog').html(correoCode);
            
            $('#FAiduser').val(datos['id_user']);
            $('#FAnombre').val(nombreCode);
            $('#FAapellido').val(apellidoCode);
            $('#FAcorreo').val(correoCode);
            $('#FAtelefono').val(datos['telefono']);
            
            mostrarDatos();   
        }
    })
}