//VALIDAR SOLO EL INGRESO DE NUMEROS
function justNumbers2(e){
    tecla = (document.all) ? e.keyCode : e.which;
    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8 ) {
        return true;
    }
    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /\d/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
};


function justWord2(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8 || tecla == 32) {
        return true;
    }
    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[A-Za-z]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
};


jQuery(document).on('submit','#Form_NewGrupo', function(event){
    event.preventDefault();   
    event.stopPropagation();
    console.log("Recuperando datos para crear un nuevo grupo");

           
    var FNewG_grupo = $('#FNewG_grupo').val();
    var FNewG_prueba = $('#FNewG_prueba').val();
    var FNewG_aula = $('#FNewG_aula').val();   
    var FNewG_horario = $('#FNewG_horario').val();   
    var FNewG_cupos_ofrecidos = $('#FNewG_cupos_ofrecidos').val();   
    var FNewG_estad_grupo = $('#FNewG_estad_grupo').val();  
    
    

    if(FNewG_grupo===null || FNewG_grupo=="" || FNewG_grupo==" "){
        Toast.fire({
              type: 'error',
              title: 'Debes darle un nombre al grupo'
            });
        $('#FNewG_grupo').focus();       
        return false;
    }

    else if(FNewG_prueba===null || FNewG_prueba=="" || FNewG_prueba == 0){
        Toast.fire({
              type: 'error',
              title: 'Debes seleccionar una prueba'
            });
        $('#FNewG_prueba').focus();       
        return false;
    }

    else if(FNewG_aula===null || FNewG_aula=="" || FNewG_aula == 0){
        Toast.fire({
              type: 'error',
              title: 'Debes seleccionar una aula donde se aplicará la prueba'
            });
        $('#FNewG_aula').focus();       
        return false;
    }

    else if(FNewG_horario===null || FNewG_horario=="" || FNewG_horario == 0){
        Toast.fire({
              type: 'error',
              title: 'Debes seleccionar una horario para el grupo y su aplicación'
            });
        $('#FNewG_horario').focus();       
        return false;
    }

    else if(FNewG_cupos_ofrecidos===null || FNewG_cupos_ofrecidos=="" || FNewG_cupos_ofrecidos == "."){
        Toast.fire({
              type: 'error',
              title: 'Debes digitar el número de cupos disponibles'
            });
        $('#FNewG_cupos_ofrecidos').focus();       
        return false;
    }
    
    console.log(FNewG_grupo);
    console.log(FNewG_prueba);
    console.log(FNewG_aula);
    console.log(FNewG_horario);
    console.log(FNewG_cupos_ofrecidos);
    console.log(FNewG_estad_grupo);
    


    Swal.fire({
        title: 'La información es correcta?',
        text: 'Va a crear un nuevo grupo!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, todo correcto!'
    })
    .then((result) => {
        if (result.value) {             
            NewGrupoCreate(FNewG_grupo,FNewG_prueba,FNewG_aula,FNewG_horario,FNewG_cupos_ofrecidos,FNewG_estad_grupo);
            Swal.fire(
                'Grupo Creado!',
                'el grupo fue creado con exito.',
                'success'
            ); 
            console.log("Success");
            setTimeout(function(){ location.reload(); }, 1700); 
        }; //fin if result
    }); //fin then 
    
});

function NewGrupoCreate(FNewG_grupo,FNewG_prueba,FNewG_aula,FNewG_horario,FNewG_cupos_ofrecidos,FNewG_estad_grupo) {
    $.ajax({        
        type: "POST",
        data: {        
            FNewG_grupo:FNewG_grupo,
            FNewG_prueba:FNewG_prueba,
            FNewG_aula:FNewG_aula,
            FNewG_horario:FNewG_horario,
            FNewG_cupos_ofrecidos:FNewG_cupos_ofrecidos,
            FNewG_estad_grupo:FNewG_estad_grupo              
        },         
        url: "php/RunInsertNewGrupo.php",       
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
};