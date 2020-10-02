
//VALIDAR SOLO EL INGRESO DE NUMEROS
function justNumbers(e){
    var keynum = window.event ? window.event.keyCode : e.which;
    if ((keynum == 8) || (keynum == 46))
    return true;            
    return /\d/.test(String.fromCharCode(keynum));
};

//MOSTAR Y SELECCIONAR EL SEMESTRE
var slider = document.getElementById("FRNE_semestre");
var output = document.getElementById("NumSemestre");
output.innerHTML = slider.value;

slider.oninput = function() {
    output.innerHTML = this.value;
}


jQuery(document).on('submit','#FormRegistroNewStudent', function(event){
    event.preventDefault();   
    
    console.log("Recuperando datos del formulario Form New Student");
    //var data = $(this).serialize();
    //console.log(data);
    
    var codEstudiante = $('#FRNE_cod_estudiante').val();
    var correoEstudiante = $('#FRNE_correo').val();
    var tipoDoc =$('#FRNE_tipo_doc').val();
    var NumDocEstudiante =$('#FRNE_num_identificacion').val(); 
    var nameEstudiante = $('#FRNE_name').val();
    var apellidoEstudiante = $('#FRNE_apellido').val();
    var pass1Estudiante = $('#FRNE_password').val();
    var pass2Estudiante = $('#FRNE_conpassword').val();
    var programaEstudiante = $('#FRNE_programa').val();
    var semestreEstudiante = $('#FRNE_semestre').val();
      
    
    if(codEstudiante===null || codEstudiante==""){
        Toast.fire({
              type: 'error',
              title: 'Debes digitar tu código'
            });
        $('#FRNE_cod_estudiante').focus();      
        return false;
    }
  
    if(correoEstudiante===null || correoEstudiante==""){
      Toast.fire({
            type: 'error',
            title: 'Debes digitar tu correo'
          });
      $('#FRNE_correo').focus();      
      return false;
    }
  
  
    if(tipoDoc===null || tipoDoc =="" || tipoDoc==0){
      Toast.fire({
            type: 'error',
            title: 'Debes seleccionar tipo de documento'
          });
      $('#FRNE_tipo_doc').focus();      
      return false; 
      
    }
  
    if(NumDocEstudiante===null || NumDocEstudiante==""){
        Toast.fire({
              type: 'error',
              title: 'Debes digitar número de identificación'
            });
        $('#FRNE_num_identificacion').focus();      
        return false;
    }
  
    if(nameEstudiante===null || nameEstudiante==""){
      Toast.fire({
            type: 'error',
            title: 'Debemos conocer tú nombre'
          });
      $('#FRNE_name').focus();      
      return false;
    }
  
    if(apellidoEstudiante===null || apellidoEstudiante==""){
      Toast.fire({
            type: 'error',
            title: 'Debemos conocer tus apellidos'
          });
      $('#FRNE_apellido').focus();      
      return false;
    }
  
    if(pass1Estudiante===null || pass1Estudiante==""){
      Toast.fire({
            type: 'error',
            title: 'Debes escribir una contraseña'
          });
      $('#FRNE_password').focus();      
      return false;
    }
  
    if(pass2Estudiante===null || pass2Estudiante==""){
      Toast.fire({
            type: 'error',
            title: 'Debes volver a escribir la contraseña'
          });
      $('#FRNE_conpassword').focus();      
      return false;
    }
  
    if(pass2Estudiante != pass1Estudiante){
      Toast.fire({
            type: 'error',
            title: 'Tus contraseñas no son iguales'
          });
      $('#FRNE_conpassword').focus();      
      return false;
    }
    
    
    if(programaEstudiante===null || programaEstudiante =="" || programaEstudiante==0){
      Toast.fire({
            type: 'error',
            title: 'Debes seleccionar un programa'
          });
      $('#FRNE_programa').focus();      
      return false; 
      
    }
  
    if(semestreEstudiante == 1){
      Toast.fire({
        type: 'warning',
        title: 'El semestre seleccionado es correcto?'
      }); 
    }
    
  
    Swal.fire({
        title: 'Todos los datos son correctos?',
        text: "Revisa muy bien tus datos!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Registrarme!'
      }).then((result) => {
        if (result.value) {        
          var ArrayUsuario = new Array(codEstudiante,correoEstudiante, nameEstudiante,apellidoEstudiante,pass1Estudiante,programaEstudiante,semestreEstudiante,tipoDoc, NumDocEstudiante);            
                  
          EjecutaResgistro(ArrayUsuario);
          console.log(EjecutaResgistro(ArrayUsuario));
          
        }
    })
  
  });
  
  
  function EjecutaResgistro(ArrayUsuario){
      $.ajax({
        type: "POST",
        data: {
          codEstudiante: ArrayUsuario[0],   
          correoEstudiante: ArrayUsuario[1],
          nameEstudiante: ArrayUsuario[2],
          apellidoEstudiante: ArrayUsuario[3],
          pass1Estudiante: ArrayUsuario[4],
          idprogramaEstudiante: ArrayUsuario[5],
          semestreEstudiante: ArrayUsuario[6],
          tipoDoc: ArrayUsuario[7],  
          NumDocEstudiante: ArrayUsuario[8]               
        },        
        url: "./php/RunRegisterInsertNewStudent.php",       
        success: function(res){  
            console.log(res);
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
            else{
              Swal.fire(
                'Registrado!',
                'El estudiante fue registrado satisfactoriamente.',
                'success'
              );            
              setTimeout(function(){ location.reload(); }, 2200);
            }             
        }//Fin success
    }); // FIN DEL AJAX ENVIO DE DATOS A PHP
  
  
  }