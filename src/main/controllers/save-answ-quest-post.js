function SaveAnswerPost(arrayRes){

    const Toast = Swal.mixin({
      toast: true,
      position: 'center',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    });
  
    
      console.log(arrayRes);
      $.ajax({
          type: "POST",
          data: {
              id_cuestionario: arrayRes['id_cuestionario'],
              cod_estudiante: arrayRes['cod_estudiante'],
              id_opcion_respuesta: arrayRes['id_opcion_respuesta'],
              fecha_rta_enviada: arrayRes['fecha_rta_enviada'],
              ip_estudiante: arrayRes['ip_estudiante'],
              id_estado_rta_enviada: arrayRes['id_estado_rta_enviada'],
              id_pregunta: arrayRes['id_pregunta']        
          },
          //dataType: 'json',
          url: "php/SaveAnswerPost.php",       
          success: function(res){   
              console.log(res);
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
              else{              
                Toast.fire({
                  type: 'success',
                  title: "Respuesta Guardada!"
                  });
              }          
          }
        });
  }