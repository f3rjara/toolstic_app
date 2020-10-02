function generarCod(){
    
    var caracteres = "abcdefghijkmnpqrtuvwxyzABCDEFGHJKMNPQRTUVWXYZ2346789";
    var CodGen = "";
    for (i=0; i<10; i++) CodGen +=caracteres.charAt(Math.floor(Math.random()*caracteres.length)); 
    return CodGen;
}

let dataCapture = new Object();

function PwLostAdmin() {

    const steps = ['1', '2', '3']
    const swalQueueStep = Swal.mixin({
    confirmButtonText: 'Siguiente &rarr;',
    showCancelButton: true,
    cancelButtonText: 'Anterior',
    allowOutsideClick: false,
    allowEscapeKey: true,
    progressSteps: steps,    
    inputAttributes: {
        required: true
    },
    reverseButtons: true,
    validationMessage: 'Este campo es obligatorio'
    })

    async function backAndForth () {
    const values = []
    let currentStep
    var Titulos = ['Número de documento','Correo Electrónico','Código de Validación'];

    var Mensaje = ['Digita tú número de documento registrado en la plataforma','Digita tú correo registrado en la plataforma','Digita el código enviado a tú correo registrado. Revisa tu carpeta de SPAN'];  

    var inputText = ['number','email','text'];

   

    for (currentStep = 0; currentStep < steps.length;) {                 
        const result = await swalQueueStep.fire({
        title: Titulos[currentStep],
        text: Mensaje[currentStep],
        inputValue: values[currentStep],
        input: inputText[currentStep],
        showCancelButton: currentStep > 0,
        currentProgressStep: currentStep
        })       
        

        if (result.value) {
        values[currentStep] = result.value;

        //console.log("currentStep "+currentStep);
        //console.log("values[currentStep] "+ values[currentStep]);
        
        if(currentStep == 0)
        {            
            
            var cedula = values[currentStep];     
            dataCapture.cedula = cedula; 
            const respond1 = await validarusuario(cedula);
            if( respond1  == true){    
                currentStep++
            }
            else{                
                break
            }
        }
        
        else if(currentStep == 1)
        {
            var Correousuario = values[currentStep];
            dataCapture.correo = Correousuario;    
            const respond2 = await validarCorreo(dataCapture['correo'], dataCapture['cedula'] );              
            
            if(respond2){    
                dataCapture.CodGen = generarCod();
                EnviarCorreo(dataCapture['correo'], dataCapture['cedula'], dataCapture['CodGen']);            
                currentStep++
            }
            else{                
                break
            }
        }

        else if(currentStep == 2)
        {            
            var codigoVal = values[currentStep];    
            
            const respond3 =  await validarCodigo(dataCapture['CodGen'], codigoVal);
                    
            if(respond3){   
                currentStep++
            }
            else{
                Swal.fire(
                    'Código de validacion Invalido!',
                    'El código digitado es erroneo',
                    'error'
                );
                break
            }
        }


        

        
        
        } else if (result.dismiss === 'cancel') {
            currentStep--
        } else {
        break
        }
    } 

    if (currentStep === steps.length) {
        Swal.fire({
            title: 'Todo Corrrecto!',
            html:
                'Los datos recibidos son: <pre><code>' +
                JSON.stringify(values) +
                '</code></pre>',
            confirmButtonText: 'Ahora ingresa tu nueva contraseña!'
            });
    
            setTimeout(function(){
                obtenerPass(dataCapture['cedula']);
            },2000)
    
            }// fin exito swaal
    }

    backAndForth()

}

async function obtenerPass(cedula){
    const { value: password } = await Swal.fire({
        allowOutsideClick: false,
        allowEscapeKey: false,
        showCancelButton: true,
        confirmButtonText: 'Cambiar contraseña',
        showLoaderOnConfirm: true,
        cancelButtonColor: '#3085d6',
        confirmButtonColor:'#019140',
        showLoaderOnConfirm: true,
        title: 'Ingresa tú nueva contraseña',
        input: 'password',
        inputPlaceholder: 'Digita tú contraseña',
        inputAttributes: {          
          autocapitalize: 'off',
          autocorrect: 'off'
        }
      })
      
      if (password) {
        const respond =  await updatePass(password, cedula );         
        if(respond){
          Swal.fire(
              'Contraseña Actualizada!',
              'Ahora ya puede iniciar sesión',
              'success'
            );
        }
        else{
          Swal.fire(
              'Contraseña NO Actualizada!',
              'No se realizo ningún cambio en  nustros sitemas',
              'error'
            );
        }
    }
    else{
      Swal.fire(
          'Contraseña NO Actualizada!',
          'No se realizo ningún cambio en  nustros sitemas',
          'error'
        );
      return false;
    }
};

function validarusuario(cedula){
    return new Promise(resolve => {  
        $.ajax({
            type: "POST",
            data: { cedula: cedula  },        
            url: "../includes/vluseres_admin.php", 
                
            success: function(res){     
              
                var data = jQuery.parseJSON(res);              
                if(!data['res']){
                    Swal.fire(
                    'Uppps!',
                    data['restext'],
                    'error'
                    ); 
                    resolve(false);  
                } 
                else {                                       
                    resolve(true); 
                }
            }//Fin success
        }); // FIN DEL AJAX ENVIO DE DATOS A PHP   
    })
}

function validarCorreo(Correousuario, cedula){
    return new Promise(resolve => {  
        $.ajax({
            type: "POST",
            data: { correo: Correousuario, cedula: cedula  },        
            url: "../includes/vlmailuseres_admin.php",             
            success: function(res){     
               
                var data = jQuery.parseJSON(res);              
                if(!data['res']){
                    Swal.fire(
                    'Uppps!',
                    data['restext'],
                    'error'
                    ); 
                    resolve(false);  
                } 
                else{
                    resolve(true);
                }    
            }//Fin success
        }); // FIN DEL AJAX ENVIO DE DATOS A PHP
    })
}


function EnviarCorreo(destino, cedula, codgen){
    return new Promise(resolve => {  
        $.ajax({
            type: "POST",
            data: { 
                correo: destino, 
                cedula: cedula,
                codgen: codgen  },        
            url: "../includes/sendmailuser_admin.php",             
            success: function(res){     
              
                var data = jQuery.parseJSON(res);              
                if(!data['res']){
                    Swal.fire(
                    'Uppps!',
                    data['restext'],
                    'error'
                    ); 
                    resolve(false);  
                } 
                else{
                    resolve(true);
                }    
            }//Fin success
        }); // FIN DEL AJAX ENVIO DE DATOS A PHP
    })   
}

function validarCodigo(codgen, codigoVal){
    return new Promise(resolve => {                      
        if(codgen == codigoVal){            
            resolve(true);  
        } 
        else{
            Swal.fire(
                'Uppps!',
                "El código ingresado es incorrecto",
                'error'
                ); 
            resolve(false);
        }               
    })   
}


function  updatePass(password, cedula ) {
    return new Promise(resolve => {  
        $.ajax({
            type: "POST",
            data: { 
                password: password, 
                cedula: cedula },
            url: "../includes/updpassuseres_admin.php",             
            success: function(res){     
               
                var data = jQuery.parseJSON(res);              
                if(!data['res']){
                    Swal.fire(
                    'Uppps!',
                    data['restext'],
                    'error'
                    ); 
                    resolve(false);  
                } 
                else{
                    resolve(true);
                }    
            }//Fin success
        }); // FIN DEL AJAX ENVIO DE DATOS A PHP
    })   
}
