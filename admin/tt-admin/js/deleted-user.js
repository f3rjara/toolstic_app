function DeleteUsuario(id) {
    event.stopPropagation();    
    Swal.fire({
        title: 'Estas seguro?',
        text: "El usuario se eliminara de forma permanente!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, elimínalo!'
        }).then((result) => {
        if (result.value) {
            EliminarUsuarioSelect(id)
            Swal.fire(
            'Eliminado!',
            'El usuario fue eliminado de la base de datos.',
            'success'
            );
            setTimeout(function(){ location.reload(); }, 1600);
        }
        })
}

function EliminarUsuarioSelect(id_user){
    $.ajax({
        type: "POST",
        data: {
          id_usuario:id_user
        },        
        url: "php/RunDeleteUser.php",       
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