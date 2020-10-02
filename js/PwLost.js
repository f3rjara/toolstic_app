function generarCod(){

    var caracteres = "abcdefghijkmnpqrtuvwxyzABCDEFGHJKMNPQRTUVWXYZ2346789";
    var CodGen = "";
    for (i=0; i<10; i++) CodGen +=caracteres.charAt(Math.floor(Math.random()*caracteres.length)); 
    return CodGen;
}


let dataCapture = new Object();

async function PwLost() {

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
    var Titulos = ['Código estudiantil','Correo Elctronico','Código de Validación'];

    var Mensaje = ['Digita tú código registrado en la plataforma','Digita tú correo registrado en la plataforma','Digita el código enviado a tú correo registrado; Revisa la carpeta Span'];  

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
        
        if(currentStep == 0)
        {           
            var codigo = values[currentStep];     
            dataCapture.codigo = codigo; 
            const respond1 = await validarusuario(codigo);
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
            const respond2 = await validarCorreo(dataCapture['correo'], dataCapture['codigo'] );              
            
            if(respond2){    
                dataCapture.CodGen = generarCod();
                EnviarCorreo(dataCapture['correo'], dataCapture['codigo'], dataCapture['CodGen']);            
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
        //JSON.stringify(values)        
        Swal.fire({
        title: 'Todo Corrrecto!',
        html:
            'Los datos recibidos son: <pre><code>' +
            JSON.stringify(values) +
            '</code></pre>',
        confirmButtonText: 'Ahora ingresa tu nueva contraseña!'
        });

        setTimeout(function(){
            obtenerPass(dataCapture['codigo']);
        },2000)

        }// fin exito swaal
    }

    backAndForth()

}

async function obtenerPass(cod_estudiante){
    const { value: password } = await Swal.fire({
        allowOutsideClick: false,
        allowEscapeKey: false,
        showCancelButton: true,
        confirmButtonText: 'Cambiar contraseña',
        showLoaderOnConfirm: true,        
        cancelButtonColor: '#3085d6',
        confirmButtonColor:'#019140',
        title: 'Ingresa tú nueva contraseña',
        input: 'password',
        inputPlaceholder: 'Digita tú contraseña',
        inputAttributes: {          
          autocapitalize: 'off',
          autocorrect: 'off'
        }, inputAttributes: {
            required: true
        },
      })
      
      if (password) {
          const respond =  await updatePass(password, cod_estudiante );         
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

function validarusuario(codigo){
    return new Promise(resolve => {  
        $.ajax({
            type: "POST",
            data: { codigo: codigo  },        
            url: "../includes/vluseres.php", 
                
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

function validarCorreo(Correousuario, codigo){
    return new Promise(resolve => {  
        $.ajax({
            type: "POST",
            data: { correo: Correousuario, codigo: codigo  },        
            url: "../includes/vlmailuseres.php",             
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

function EnviarCorreo(destino, codigo, codgen){
    return new Promise(resolve => {  
        $.ajax({
            type: "POST",
            data: { 
                correo: destino, 
                codigo: codigo,
                codgen: codgen  },        
            url: "../includes/sendmailuseres.php",             
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

function  updatePass(password, cod_estudiante ) {
    return new Promise(resolve => {  
        $.ajax({
            type: "POST",
            data: { 
                password: password, 
                cod_estudiante: cod_estudiante },
            url: "../includes/updpassuseres.php",             
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
