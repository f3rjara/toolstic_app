function DeleteGrupo(id) {
    
    Swal.fire({
        title: 'Estas seguro?',
        text: "El grupo se archivará de forma permanente!, los estudianntes dejaran de estar inscritos al grupo",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, elimínalo!'
        }).then((result) => {
        if (result.value) {
            EliminarGrupoSelect(id);
            Swal.fire(
            'Eliminado!',
            'El grupo fue archivado permanentemente.',
            'success'
            );
            setTimeout(function(){ location.reload(); }, 1600);
        }
        })

};

function EliminarGrupoSelect(id){
    $.ajax({
        type: "POST",
        data: {
          id_grupo:id
        },        
        url: "php/RunDeleteGrupo.php",       
        success: function(res){   
            console.log(res);
            var data = jQuery.parseJSON(res);  
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