function DeletePrg(id){    
    Swal.fire({
        title: 'Estas seguro?',
        text: "La pregunta se archivara y no podra volverse a editar!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminala!'
        }).then((result) => {
        if (result.value) {
            RunDeleteQuestion(id);
            Swal.fire(
            'Eliminada!',
            'La pregunta fue archivada y no podra volverse a editar.',
            'success'
            );
            setTimeout(function(){ location.reload(); }, 1800);
        }
        })
}

function  RunDeleteQuestion(id_prg) {
    $.ajax({
        type: "POST",
        data: {
          idpregunta:id_prg
        },        
        url: "php/RunDeletePregunta.php",       
        success: function(res){   
            var data = jQuery.parseJSON(res);  
            console.log(res) ;
            console.log(data['restext']);
            if(!data['res']){
              Swal.fire(
                'Uppps!',
                data['restext'],
                'error'
              );    
              return false;            
            }          
        }
    });
}