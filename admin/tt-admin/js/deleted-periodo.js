function DeletePeriodo(id) {
    Swal.fire({
        title: 'Estas seguro?',
        text: "El periodo se eliminara de forma permanente!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, elimínalo!'
        }).then((result) => {
        if (result.value) {
            EliminarPeriodoSelect(id);
            Swal.fire(
            'Eliminado!',
            'El periodo fue archivado exitosamente.',
            'success'
            );
            setTimeout(function(){ location.reload(); }, 1600);
        }
        })

};

function EliminarPeriodoSelect(id){
    $.ajax({
        type: "POST",
        data: {
          id_periodo:id
        },        
        url: "php/RunDeletePeriodo.php",       
        success: function(res){   
            var data = jQuery.parseJSON(res);  
            console.log(res) ;            
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