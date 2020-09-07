function SavAllOPR(id_cu, cod){
    console.log( "Recuperando las respuestas guardadas" );
    var ArrayOPCHK = new Array;
    
    for(var i=1; i < 51; i++){        
        let Var = $('input:radio[name=GRPP_'+i+']:checked').val();     
        ArrayOPCHK.push(Var); 
    }
    
    //console.log(ArrayOPCHK);

    Swal.fire({
        title: 'Envio de cuestionario',
        text: "Las respuestas seleccionadas serán enviadas como definitivas ",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, todo correcto!',
        cancelButtonText: 'Cancelar!'
      }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                data: {
                    ArrayOPCHK: ArrayOPCHK,
                    id_cuestionario: id_cu,
                    cod_estu: cod  
                },
                //dataType: 'json',
                url: "php/SaveAllAnswerPost.php",       
                success: function(res){   
                    //console.log(res);
                    var data = jQuery.parseJSON(res);         
                    //console.log(data['restext']);
                    if(!data['res']){
                      Swal.fire(
                        'Uppps!',
                        data['restext'],
                        'error'
                      );    
                      return false;            
                    }
                    else{              
                      Toast.fire({
                        type: 'success',
                        title: "Cuestionario Guardado!"
                        });                        
                        window.removeEventListener("beforeunload",askConfirmation);
                        setTimeout(function(){
                            let timerInterval
                            Swal.fire({
                            allowOutsideClick: false,
                            allowEscapeKey:false,
                            allowEnterKey:false,
                            title: 'Todo fue guardado!',
                            html: 'Serás redirigido a los resultados.',
                            timer: 3500,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                            },
                            onClose: () => {
                                clearInterval(timerInterval);                                
                                window.location='./resultados.php';
                            }
                            });  
                        },1500);

                        
                    }          
                }
            });
        }
    });
}