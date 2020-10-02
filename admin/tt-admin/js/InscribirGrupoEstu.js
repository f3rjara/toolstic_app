
function InscribirGrupoEstu() {
    const steps = ['1', '2']
    const swalQueueStep = Swal.mixin({
    confirmButtonText: 'Siguiente &rarr;',
    showCancelButton: true,    
    cancelButtonColor: '#d33',
    progressSteps: steps,    
    inputAttributes: {
        required: true
    },
    reverseButtons: true,
    validationMessage: 'Este campo es obligatorio'
    })  //fin steps 

    async function backAndForth () {
        const values = []
        let currentStep
        for (currentStep = 0; currentStep < steps.length;) {  
            if(currentStep == 0){

                var inputOptionsPromise = new Promise(function (resolve) {            
                    $.ajax({        
                        type: "POST",
                        url: "php/ConsultaGruposInsc.php",       
                        success: function(res){ 
                            var data2 = jQuery.parseJSON(res); 
                            var obj  = {"grupos":data2};                            
                            var datos = new Array();
                            var i = 0;
                            $.each(obj.grupos.data2, function(){
                                var gr = this['grupo']+" | "+this['Cupos_Libres']+" Cupos Libres";
                                var idgr = this['id_grupo']; 
                                datos[i] = {idgr,gr}                                
                                i++;
                            })  
                           
                            var MiMapa = new Map();

                            for(var j = 0; j < datos.length; j++){
                                MiMapa.set(datos[j]['idgr'],datos[j]['gr']);
                            }  
                            console.log("Se consultaron los grupos");                                                       
                            resolve(MiMapa);                                 
                        }//Fin success
                    }); // FIN DEL AJAX ENVIO DE DATOS A PHP

                    //place options here
                                      
                                                           
                });

                const result = await swalQueueStep.fire(
                {                
                    title: 'Grupo',
                    text: 'Selecciona el grupo para inscribir a estudiantes',
                    inputPlaceholder: 'Seleccione un grupo',
                    inputOptions: inputOptionsPromise,
                    inputValidator: (value) => {
                        if (!value) {
                          return 'Necesitas seleccionar un grupo!'
                        }
                    },
                    input: 'select',
                    cancelButtonText: 'Cancelar',
                    showCancelButton: true,
                    currentProgressStep: currentStep
                }); 

                if (result.value) {
                    values[currentStep] = result.value;                   
                              
                    var id_grupo = values[currentStep];

                        if (id_grupo == null || id_grupo == "") {
                            currentStep --;  
                        }
                        if (result.dismiss !== 'cancel') {
                            currentStep ++;  
                        }  
                    } // fin result

                    if (result.dismiss === 'cancel') {
                        currentStep--
                        break
                    }

                }
            else if(currentStep == 1){
                const result = await swalQueueStep.fire(
                    {                
                        title: 'Estudiantes',
                        text: 'Digita los códigos de los estudiantes separados por coma ","',
                        inputValue: '',                        
                        input: 'textarea',
                        inputPlaceholder: 'Solo códigos de usuarios registrados',
                        cancelButtonText: 'Anterior',
                        showCancelButton: currentStep > 0,
                        currentProgressStep: currentStep
                    }); 
                    if (result.value) {
                        values[currentStep] = result.value;
                       
                        var CodigosDigitados = values[currentStep];
                        

                        if (result.dismiss !== 'cancel') {
                            currentStep ++;  break
                        }
                    }    
                    
                    if (result.dismiss === 'cancel' || CodigosDigitados == null || CodigosDigitados == "") {
                        currentStep--
                    }

                    

            }  // fin else if

        
        
        } // FIN FOR

        if (currentStep === steps.length) {            
            var grupo = id_grupo;
            var codigos = CodigosDigitados;
            
            var datas = new Array(grupo,codigos);
            console.log(datas);

            Swal.fire({
                title: 'Esta seguro?',
                text: "Se inscribiran los estudiantes al grupo seleccionado!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonText: 'Cancelar',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, inscribirlos!'
              }).then((result) => {
                if (result.value) {
                    InscribirEstudiantesAgrupo(datas);                    
                }// fin if resulr
            });// fin ajax
            
        }    //fin IF


    } // FIN FUNCION ASYNC
    backAndForth();

} // FIN FUNCION


function InscribirEstudiantesAgrupo(datas){
    $.ajax({        
        type: "POST",
        data: {
            id_grupo:datas[0],
            codigos:datas[1]
        },         
        url: "php/RunInscEstuGroup.php",            
        success: function(res){ 
            console.log(res);
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
            else{
                Swal.fire(
                    'Registro!',
                    data['restext'],
                    'success'
                ).then(function () {
                    setTimeout(function(){ location.reload(); }, 600); 
                })
            }               
        }//Fin success
    }); // FIN DEL AJAX ENVIO DE DATOS A PHP
}//FIN FUNCION