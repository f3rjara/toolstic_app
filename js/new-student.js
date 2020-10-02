
function HabilitarBtn1(){ 
  if($('#FNE_cod_estudiante').val() != "" && $('#FNE_password').val() != "" &&
  $('#FNE_conpassword').val() != ""){    
    $("#next-button_1").attr('disabled', false);
  }
  else{    
    $("#next-button_1").attr('disabled', true);
  }

}

function HabilitarBtn2(){  

  if( ($('#FNE_tipo_doc').val() != null ) &&
      $('#FNE_num_identificacion').val() != ""  &&
      $('#FNE_name').val() != "" && 
      $('#FNE_apellido').val() != "" ){
          $("#next-button_2").attr('disabled', false);
      }
      else{
        $("#next-button_2").attr('disabled', true);
      }
}

function HabilitarBtn3(){  

  if( ($('#FNE_programa').val() != null ) &&
      $('#FNE_semestre').val() != "" ){
          $("#next-button_3").attr('disabled', false);
      }
      else{
        $("#next-button_3").attr('disabled', true);
      }
}

function HabilitarBtn4(){  

  if( $('#FNE_correo').val() != "" ){
          $("#next-button_4").attr('disabled', false);
      }
      else{
        $("#next-button_4").attr('disabled', true);
      }
}


HabilitarBtn1();

$("#next-button_1").click(function(){  
  ValidaFirstStep();
})

$("#next-button_2").click(function(){  
  ValidaSecondStep()
})

$("#next-button_3").click(function(){  
  ValidaThirdStep();
})

$("#next-button_4").click(function(){  
  ValidaFourthStep();
})



jQuery(document).on('submit','#FormNewStudent', function(event){
  event.preventDefault(); 

  var codEstudiante = $('#FNE_cod_estudiante').val();
  var pass1Estudiante = $('#FNE_password').val();
  var pass2Estudiante = $('#FNE_conpassword').val();
  
  var tipoDoc =$('#FNE_tipo_doc').val();
  var NumDocEstudiante =$('#FNE_num_identificacion').val(); 
  var nameEstudiante = $('#FNE_name').val();
  var apellidoEstudiante = $('#FNE_apellido').val();
  
  var programaEstudiante = $('#FNE_programa').val();
  var semestreEstudiante = $('#FNE_semestre').val();
  
  var correoEstudiante = $('#FNE_correo').val();
  var telefonoEstudiante = $('#FNE_telefono_estudiante').val();
  
  if(codEstudiante===null || codEstudiante==""){
      Toast.fire({
            type: 'error',
            title: 'Debes digitar tu código'
          });
      $('.carousel').carousel('set', 0);
      $('#FNE_cod_estudiante').focus();      
      return false;
  }

  if(pass1Estudiante===null || pass1Estudiante==""){
    Toast.fire({
          type: 'error',
          title: 'Debes escribir una contraseña'
        });
    $('.carousel').carousel('set', 0);
    $('#FNE_password').focus();      
    return false;
  }

  if(pass2Estudiante===null || pass2Estudiante==""){
    Toast.fire({
          type: 'error',
          title: 'Debes volver a escribir la contraseña'
        });
    $('#FNE_conpassword').focus();      
    $('.carousel').carousel('set', 0);
    return false;
  }

  if(pass2Estudiante != pass1Estudiante){
    Toast.fire({
          type: 'error',
          title: 'Tus contraseñas no son iguales'
        });
    $('.carousel').carousel('set', 0);
    $('#FNE_conpassword').focus();      
    return false;
  }
  
 

  if(tipoDoc===null || tipoDoc =="" || tipoDoc==0){
    Toast.fire({
          type: 'error',
          title: 'Debes seleccionar tipo de documento'
        });
    $('.carousel').carousel('set', 1);
    $('#FNE_tipo_doc').focus();      
    return false; 
    
  }

  if(NumDocEstudiante===null || NumDocEstudiante==""){
      Toast.fire({
            type: 'error',
            title: 'Debes digitar número de identificación'
          });
      $('.carousel').carousel('set', 1);
      $('#FNE_num_identificacion').focus();      
      return false;
  }

  if(nameEstudiante===null || nameEstudiante==""){
    Toast.fire({
          type: 'error',
          title: 'Debemos conocer tú nombre'
        });
    $('.carousel').carousel('set', 1);    
    $('#FNE_name').focus();      
    return false;
  }

  if(apellidoEstudiante===null || apellidoEstudiante==""){
    Toast.fire({
          type: 'error',
          title: 'Debemos conocer tus apellidos'
        });
    $('.carousel').carousel('set', 1);   
    $('#FNE_apellido').focus();      
    return false;
  }


  if(semestreEstudiante == 1){
    Toast.fire({
      type: 'warning',
      title: 'El semestre seleccionado es correcto?'
    });     
  }
  
  if(programaEstudiante===null || programaEstudiante =="" || programaEstudiante==0){
    Toast.fire({
          type: 'error',
          title: 'Debes seleccionar un programa'
        });
    $('.carousel').carousel('set', 2); 
    $('#FNE_programa').focus();      
    return false; 
    
  }

  if(correoEstudiante===null || correoEstudiante==""){
    Toast.fire({
          type: 'error',
          title: 'Debes digitar tu correo'
        });
    $('.carousel').carousel('set', 3); 
    $('#FNE_correo').focus();      
    return false;
  }

  if(telefonoEstudiante==null || telefonoEstudiante==""){
    Toast.fire({
      type: 'warning',
      title: 'No ingresaste ningún número de telefono'
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
        var ArrayUsuario = new Array(codEstudiante,correoEstudiante, nameEstudiante,apellidoEstudiante,pass1Estudiante,programaEstudiante,semestreEstudiante,tipoDoc, NumDocEstudiante, telefonoEstudiante); 
        EjecutaResgistro(ArrayUsuario); 
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
        NumDocEstudiante: ArrayUsuario[8],
        telefonoEstudiante: ArrayUsuario[9]             
      },        
      url: "RunInsertNewStudent.php",       
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
          else{
            Swal.fire(
              'Bienvenido!',
              'Ahora ya puedes iniciar sesión.',
              'success'
            );            
            setTimeout(function(){ window.location.assign("./index.php"); }, 2200);
          }             
      }//Fin success
  }); // FIN DEL AJAX ENVIO DE DATOS A PHP


}

// FUNCION QUE VERIFICA SI EL CODIGO INGRESA ESTA O NO ESTA REGISTRADO
function EstudianteRegistrado(codEstudiante){ 
  return Promise.resolve(jQuery.ajax({
    url:'verificate_user.php',
    type: 'POST',
    dataType: 'json',
    data: {
      codEstudiante: codEstudiante
    }
  })
  .done(function(respuesta){    
    return respuesta;
  }));
 
}

// VALIDACIÓN DE PRIMER PASO
function ValidaFirstStep(){
  
  var codEstudiante = $('#FNE_cod_estudiante').val();
  var pass1Estudiante = $('#FNE_password').val();
  var pass2Estudiante = $('#FNE_conpassword').val();
  
  var promise = EstudianteRegistrado(codEstudiante);    
  promise.then(function(result) {    
    if(result.error){    
      
      Swal.fire({
        allowOutsideClick: false,
        title: 'Upss',
        html: `El código <strong>${codEstudiante}</strong> ya se encuentra registrado en el sistema`,
        type: 'error'
      }).then((result) => {
        if (result.value) {
          $('.carousel').carousel('prev');
      }});      
      $('#FNE_conpassword').val(''); 
      $('#FNE_cod_estudiante').val('');   
      $('#FNE_cod_estudiante').focus();   
      HabilitarBtn1();        
    }
    return false;
  })
  

  if(codEstudiante===null || codEstudiante==""){
    Toast.fire({
      type: 'error',
      title: 'Debes escribir una contraseña'
    });      
        
    $('#FNE_cod_estudiante').focus(); 
    HabilitarBtn1();     
    return false;
  }

  else if(pass2Estudiante===null || pass2Estudiante==""){
    Toast.fire({
          type: 'error',
          title: 'Debes volver a escribir la contraseña'
        });
    $('#FNE_conpassword').focus(); 
    HabilitarBtn1();       
    return false;
  }

  else if(pass2Estudiante != pass1Estudiante){    
    Toast.fire({
          type: 'error',
          title: 'Tus contraseñas no son iguales'
    });
    $('#FNE_conpassword').val('');   
    $('#FNE_conpassword').focus();    
    HabilitarBtn1();  
    return false;
  }

  else{
    $('.carousel').carousel('next');
    return true;
  }

}

// VALIDACIÓN DE SEGUNDO PASO
function ValidaSecondStep(){

  var result1Setp = ValidaFirstStep();
  if(!result1Setp){
    Toast.fire({
      type: 'error',
      title: 'Debes completar el paso anterior'
    });
    setTimeout(function(){ $('.carousel').carousel('prev'), 1500 });   
    return false;
  }
  else{
        var tipoDoc =$('#FNE_tipo_doc').val();
        var NumDocEstudiante =$('#FNE_num_identificacion').val(); 
        var nameEstudiante = $('#FNE_name').val();
        var apellidoEstudiante = $('#FNE_apellido').val();

        if(tipoDoc===null || tipoDoc =="" || tipoDoc==0){
          Toast.fire({
                type: 'error',
                title: 'Debes seleccionar tipo de documento'
              });
          $('#FNE_tipo_doc').focus();     
          return false; 
        }
        else if(NumDocEstudiante===null || NumDocEstudiante==""){
          Toast.fire({
                type: 'error',
                title: 'Debes digitar número de identificación'
              });
          $('#FNE_num_identificacion').focus();      
          return false;
        }
        else if(nameEstudiante===null || nameEstudiante==""){
          Toast.fire({
                type: 'error',
                title: 'Debemos conocer tú nombre'
              });
          $('#FNE_name').focus();      
          return false;
        }

        else if(apellidoEstudiante===null || apellidoEstudiante==""){
          Toast.fire({
                type: 'error',
                title: 'Debemos conocer tus apellidos'
              });
          $('#FNE_apellido').focus();      
          return false;
        }
        else{
          return true;
        }

    }// fin del else
}

// VALIDACIÓN DE TERCER PASO
function ValidaThirdStep(){
  var Valida2step = ValidaSecondStep();
  if(!Valida2step){
    Toast.fire({
      type: 'error',
      title: 'Debes completar el paso anterior'
    });
    setTimeout(function(){ $('.carousel').carousel('prev'), 1500 });    
    return false;
  }
  else{
    var programaEstudiante = $('#FNE_programa').val();
    var semestreEstudiante = $('#FNE_semestre').val();

    if(programaEstudiante===null || programaEstudiante =="" || programaEstudiante==0){
      Toast.fire({
            type: 'error',
            title: 'Debes seleccionar un programa'
          });
      $('#FNE_programa').focus();      
      return false; 
      
    }  
    if(semestreEstudiante == 1){
      Toast.fire({
        type: 'warning',
        title: `El semestre seleccionado ${semestreEstudiante} ¿es correcto?`
      });        
    }
    else{
      return true;
    }


  }
}

// VALIDACIÓN DE CUARTO PASO
function ValidaFourthStep() {
  var Valida3step = ValidaThirdStep();
  if(!Valida3step){
    Toast.fire({
      type: 'error',
      title: 'Debes completar el paso anterior'
    });
    setTimeout(function(){ $('.carousel').carousel('prev'), 1500 });    
    return false;
  }
  else{
    var correoEstudiante = $('#FNE_correo').val();
    var telefonoEstudiante = $('#FNE_telefono_estudiante').val();

    if(correoEstudiante===null || correoEstudiante==""){
      Toast.fire({
            type: 'error',
            title: 'Debes digitar tu correo'
          });
      $('#FNE_correo').focus();      
      return false;
    }
    else{
      return true;
    }

  }
}


//MOSTRAR CONTRASEÑA
function mostrarContrasena(btn, input){

  var tipo = document.getElementById(input);
  var btn = document.getElementById(btn);  
  
  if(tipo.type == "password"){ 
    tipo.type = "text";      
    $(btn).html('visibility_off');
    btn.classList.add('red-text');
}
else{
    tipo.type = "password";
    $(btn).html('visibility');    
    btn.classList.remove('red-text').add('black-text');  
}
  
};

//VALIDAR SOLO EL INGRESO DE NUMEROS
function justNumbers(e){
  var keynum = window.event ? window.event.keyCode : e.which;
  if ((keynum == 8) || (keynum == 46))
  return true;            
  return /\d/.test(String.fromCharCode(keynum));
};


// MUESTRA EL NÚMERO DE SEMESTRE
var slider = document.getElementById("FNE_semestre");
var output = document.getElementById("NumSemestre");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}



