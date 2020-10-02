
function FuncionAsignaDocente(id_Select, Id_pregunta){
    event.preventDefault();  
    event.stopPropagation();

    console.log(id_Select);
    console.log(Id_pregunta);
    var id_docente = ($('#'+id_Select).val());
    if(id_docente == 1 || id_docente == 0){
        Toast.fire({
            type: 'warning',
            title: 'La pregunta no fue asignada'
          });
    }
    else{
        Swal.fire({
            title: 'La pregunta va hacer asignada!',
            text: "Esta seguro de asignar la pregunta al docente seleccionado?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, todo correcto!'
        })
        .then((result) => {
            if (result.value) { 
                console.log("se ejuca asignacion");
                RunAsignarPregunta(Id_pregunta,id_docente);
                Swal.fire(
                    'Pregunta Asignada!',
                    'La pregunta fue asignada, debe ser revisada y validada por el docente.',
                    'success'
                ); 
                console.log("Success");
                setTimeout(function(){ location.reload(); }, 1200);

            }
            else{
                console.log("Se cancelo, la pregunta no fue asignada");
                Toast.fire({
                    type: 'warning',
                    title: 'La pregunta no fue asignada'
                });
                $('#'+id_Select).prop('selectedIndex',1);               
            }
        });//fin result
    }
};

function RunAsignarPregunta(Id_pregunta,id_docente){
    $.ajax({
        type: "POST",
        data: {
            Id_pregunta: Id_pregunta,
            id_docente: id_docente           
        },        
        url: "php/RunAsignarPregunta.php",       
        success: function(res){     
            console.log(res);
            var data = jQuery.parseJSON(res);  
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