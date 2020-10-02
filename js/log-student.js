//VALIDAR SOLO EL INGRESO DE NUMEROS
function justNumbers(e){
    var keynum = window.event ? window.event.keyCode : e.which;
    if ((keynum == 8) || (keynum == 46))
    return true;            
    return /\d/.test(String.fromCharCode(keynum));
};

//MOSTRAR CONTRASEÑA
function mostrarContrasena(){
    var tipo = document.getElementById("pw_valida");
    var btn = document.getElementById("MostratPW");            
    if(tipo.type == "password"){ 
        tipo.type = "text";
        btn.classList.remove('ToolsticAzul');
        btn.classList.add('red');
    }
    else{
        tipo.type = "password";
        btn.classList.remove('red');
        btn.classList.add('ToolsticAzul');
    }
};


//ENVIAR DATOS DE CONSULTA PARA INICAR SESION

jQuery(document).on('submit','#formlg', function(event){
    event.preventDefault();
    
    jQuery.ajax({
        url:'login_student.php',
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
            setTimeout(function(){ location.href = './homologa-toolstic/index.php'; }, 1500);
        }
        else {
            console.log(respuesta);
            console.log("User Negaded");            
            Swal.fire({
                position: 'bottom-end',
                type: 'error',
                title: 'Usuario o contraseña incorrectos',
                showConfirmButton: false,                
                backdrop: 'rgba(208, 29, 86,0.3)',
                timer: 1500
            });            
            document.getElementById('btnInicia').innerHTML = 'Iniciar Sesión';    
        } 
    })
    
    .fail(function(resp){
        console.log("Response received");
        console.log(resp.responseText);        
    })
    
    .always(function(){
        console.log("Response complete");
    })
    
});