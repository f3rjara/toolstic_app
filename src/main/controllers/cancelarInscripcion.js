function cancelaInscripcion(id_ins, id_grupo){
    var id_ins = id_ins;
    var id_grupo = id_grupo;    
    var estudianteLog = parseInt($('#CodEstuPruebas').html());
 
    

    Swal.fire({
        title: 'Esta seguro? ',
        text: "No podra volverse a inscribir si la prueba no esta activa, su cupo quedara libre en el grupo correspondiente!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, cancelar inscripción!'
      }).then((result) => {
        if (result.value) {
          EliminarInscripcion(id_ins, estudianteLog, id_grupo);
          Swal.fire(
            'INSCRIPCIÓN CANCELADA!',
            'Su inscripción en el grupo de la prueba de homologación ha sido cancelada.',
            'success'
          );
          setTimeout(function(){ location.reload(); }, 1200);
        };
      });
};

function EliminarInscripcion(id, cod, id_grupo){
    $.ajax({
      type: "POST",
      data: {
        id_ins:id,
        estudiante: cod,
        id_grupo: id_grupo
      },
      //dataType: 'json',
      url:  GetUrl.ROOT_MAIN_CON + "/models/eliminaInscripcion.php",       
      success: function(res){            
          var data = jQuery.parseJSON(res);           
          if(!data['res']){
            Swal.fire(
              'Uppps!',
              data['restext'],
              'error'
            );    
            return false;            
          };          
      }
    });
};