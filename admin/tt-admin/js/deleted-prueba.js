function DeletePrueba(id){    
    Swal.fire({
        title: 'Estas seguro?',
        text: "La prueba se archivara y no podra volverse a editar!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, archivarla!'
        }).then((result) => {
        if (result.value) {
            RunEliminarPrueba(id);
            Swal.fire(
            'Archivada!',
            'La prueba fue archivada de manera correcta',
            'success'
            );
            setTimeout(function(){ location.reload(); }, 1600); 
        }
        })
}

function RunEliminarPrueba(id){

    $.ajax({        
        type: "POST",
        data: {        
            id_prueba: id
        },         
        url: "php/RunDeletePrueba.php",       
        success: function(res){ 
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
        }//Fin success
    }); // FIN DEL AJAX ENVIO DE DATOS A PHP

}