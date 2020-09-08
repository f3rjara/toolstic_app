var idgrupoSend = 0;

function GrupoSelect(id){
  idgrupoSend = id;   
};

jQuery(document).on('submit','#FormGrupos', function(event){
  event.preventDefault();
  
  if(idgrupoSend == 0)
    {
        Toast.fire({
          type: 'error',
          title: 'Debes seleccionar un grupo para inscribirte'
        });    
      return false;
    }

  estudianteLog = parseInt($('#CodEstuPruebas').html());
 

  Swal.fire({
        title: 'Esta Seguro?',
        text: "Usted se inscribira en el grupo seleccionado",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, inscribirme!'
  })
  .then((result) => {
      if(result.value) {
        
          realizarInscripcion(idgrupoSend, estudianteLog);
          Swal.fire(
            'Inscrito!',
            'Usted fue inscrito satisfactoriamente.',
            'success'
          );
          setTimeout(function(){ location.reload(); }, 1500);          
      };
  });
});

function realizarInscripcion(idgrupoSend, estudianteLog){
  var idgrupo=idgrupoSend;
  var estudiante =estudianteLog;

    $.ajax({
      type: "POST",
      data: {
        idgrupo:idgrupo,
        estudiante: estudiante
      },
      //dataType: 'json',
      url: GetUrl.ROOT_MAIN_CON +"/models/ejecutarInscripcion.php",       
      success: function(res){   
          var data = jQuery.parseJSON(res);         
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

};
