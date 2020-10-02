var id_grupo = "";
var FormGrupo = "";
function ReturnIdGrupo(id_gr){    
    id_grupo = id_gr;
    FormGrupo = "#EditarGrupo_"+id_grupo;
}

jQuery(document).on('submit',FormGrupo, function(event){
    event.preventDefault();   
    event.stopPropagation();
    console.log("Recuperando datos para editar el grupo seleccionado");
    
    var FPEG_Id_grupo = id_grupo;
    var FPEG_grupo = $('#FPEG_grupo_'+id_grupo).val();
    var FPEG_prueba = $('#FPEG_prueba_'+id_grupo).val();
    var FPEG_aula = $('#FPEG_aula_'+id_grupo).val();   
    var FPEG_horario = $('#FPEG_horario_'+id_grupo).val();   
    var FPEDG_cupos_ofrecidos = $('#FPEDG_cupos_ofrecidos_'+id_grupo).val();   
    var FPEG_estad_grupo = $('#FPEG_estad_grupo_'+id_grupo).val();   

    if(FPEG_grupo===null || FPEG_grupo=="" || FPEG_grupo == " "){
        Toast.fire({
              type: 'error',
              title: 'Debes darle un nombre al grupo'
            });
        $('#FPEG_grupo_'+FPEG_Id_grupo).focus();       
        return false;
    }

    else if(FPEG_prueba===null || FPEG_prueba=="" || FPEG_prueba == 0){
        Toast.fire({
              type: 'error',
              title: 'Debes seleccionar una prueba para el grupo'
            });
        $('#FPEG_prueba_'+FPEG_Id_grupo).focus();       
        return false;
    }

    else if(FPEG_aula===null || FPEG_aula=="" || FPEG_aula == 0){
        Toast.fire({
              type: 'error',
              title: 'Debes seleccionar una aula para la aplicación de la prueba'
            });
        $('#FPEG_aula_'+FPEG_Id_grupo).focus();       
        return false;
    }

    else if(FPEG_horario===null || FPEG_horario=="" || FPEG_horario == 0){
        Toast.fire({
              type: 'error',
              title: 'Debes seleccionar una horario para el grupo'
            });
        $('#FPEG_horario_'+FPEG_Id_grupo).focus();       
        return false;
    }

    else if(FPEDG_cupos_ofrecidos===null || FPEDG_cupos_ofrecidos=="" || FPEDG_cupos_ofrecidos == 0){
        Toast.fire({
              type: 'error',
              title: 'Debes digitar los cupos ofrecidos en el grupo'
            });
        $('#FPEDG_cupos_ofrecidos_'+FPEG_Id_grupo).focus();       
        return false;
    }

    console.log(FPEG_Id_grupo);
    console.log(FPEG_grupo);
    console.log(FPEG_prueba);
    console.log(FPEG_aula);
    console.log(FPEG_horario);
    console.log(FPEDG_cupos_ofrecidos);
    console.log(FPEG_estad_grupo);



    Swal.fire({
        title: 'La información es correcta?',
        text: 'Va a editar el grupo seleccionado!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, todo correcto!'
    })
    .then((result) => {
        if (result.value) {             
            console.log(FPEG_horario);
            UpdateGrupoSelect(FPEG_Id_grupo,FPEG_grupo,FPEG_prueba,FPEG_aula,FPEG_horario,FPEDG_cupos_ofrecidos,FPEG_estad_grupo);
            Swal.fire(
                'Grupo Modificado!',
                'el grupo fue actualizado con exito.',
                'success'
            ); 
            console.log("Success");
            setTimeout(function(){ location.reload(); }, 1700); 
        }; //fin if result
    }); //fin then 
    
});

function UpdateGrupoSelect(FPEG_Id_grupo,FPEG_grupo,FPEG_prueba,FPEG_aula,FPEG_horario,FPEDG_cupos_ofrecidos,FPEG_estad_grupo) {
    $.ajax({        
        type: "POST",
        data: {   
            FPEG_Id_grupo: FPEG_Id_grupo,
            FPEG_grupo: FPEG_grupo,
            FPEG_prueba: FPEG_prueba,
            FPEG_aula: FPEG_aula,
            FPEG_horario: FPEG_horario,
            FPEDG_cupos_ofrecidos: FPEDG_cupos_ofrecidos,
            FPEG_estad_grupo: FPEG_estad_grupo
        },         
        url: "php/RunUpdateGrupo.php",       
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


