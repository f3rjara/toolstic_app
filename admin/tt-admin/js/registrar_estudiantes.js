jQuery(document).on('submit','#FMatriStudent', function(event){
    event.preventDefault();   
    event.stopPropagation();
    console.log("Recuperando archivo csv para registrar estudiante");
    
    var FRE_ArchivoCSV = $('#FRE_ArchivoCSV').val();
    var FRE_LabelArchivoCSV = $('#FRE_LabelArchivoCSV').val();


    if(FRE_LabelArchivoCSV===null || FRE_LabelArchivoCSV ==" " || FRE_LabelArchivoCSV == ""){
        Toast.fire({
              type: 'error',
              title: 'Debes cargar un archivo CSV'
            });
        $('#FRE_ArchivoCSV').focus();       
        return false;
    }
    var dataForm = new FormData($('#FMatriStudent')[0]);       
    console.log("****************");
    Swal.fire({
        title: 'Registro de estudiantes!',
        text: 'Se van a registrar los estudiantes en el archivo cargado',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, todo correcto!'
    })
    .then((result) => {
        if (result.value) {                         
            RegistrarStudntsCSV(dataForm);
            Swal.fire(
                'Estudiantes registrados!',
                'Los estudiantes fueron registrados con exito.',
                'success'
            ); 
            console.log("Success");
            setTimeout(function(){ location.reload(); }, 2500); 
        }; //fin if result
    }); //fin then    
});

function RegistrarStudntsCSV(dataForm){
    $.ajax({        
        type: "POST",
        data: dataForm,         
        url: "php/RunRegistroStudentCSV.php", 
        contentType: false,
        processData: false,      
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