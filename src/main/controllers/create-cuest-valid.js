function GenerarCuestionarioLog( Intento_estudiante_LOG, inscripcion, cod_estudiante_LOG, Fecha1, IpEstudiante_LOG ){
     
    $.ajax({
      type: "POST",
      data: {
        intento:Intento_estudiante_LOG,
        inscripcion:inscripcion,
        estudiante: cod_estudiante_LOG,
        fecha_id: Fecha1,
        Ip_estudiante: IpEstudiante_LOG ,         
      },
      //dataType: 'json',
      url: GetUrl.ROOT_MAIN_CON + "/models/GeneraCuestionario.php",       
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
