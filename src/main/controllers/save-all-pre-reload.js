function SavAllOPRReload(id_cu, cod){
    console.log( "Recuperando las respuestas seleccionadas" );
    var ArrayOPCHK = new Array;
    
    for(var i=1; i < 51; i++){        
        let Var = $('input:radio[name=GRPP_'+i+']:checked').val();     
        ArrayOPCHK.push(Var); 
    }
    
    $.ajax({
        type: "POST",
        data: {
            ArrayOPCHK: ArrayOPCHK,
            id_cuestionario: id_cu,
            cod_estu: cod  
        },
        //dataType: 'json',
        url: "php/SaveAllAnswerPostReload.php",       
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
                setTimeout(function(){
                    Toast.fire({
                        type: 'success',
                        title: "Cuestionario Guardado!"
                        }); 
                },1800);
                
            }          
        }
    });

};



