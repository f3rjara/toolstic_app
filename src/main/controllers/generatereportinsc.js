function generatereport(response) {
    console.log("bienvendio estamos comprobando los datos");    
    var urldestino = GetUrl.ROOT_MEDIA_USER +'/student/reporte-inscripcion.php';
   
    Swal.fire({
        allowOutsideClick: false,
        title: 'Generando reporte',
        html: 'Espere unos segundos mientras se genera el reporte de inscripción.',
        timer: 3000,
        onBeforeOpen: () => {                
            Swal.showLoading()
        },
        onClose: () => {            
            $.ajax({
                type: "POST",
                data: { dataReport : response },                            
                url:  GetUrl.ROOT_MAIN_CON + "/models/habilita_report.php",         
                success: function(res){                     
                    var data = jQuery.parseJSON(res);
                    if(data['error']){
                        Swal.fire(
                        'Uppps!',
                        data['restext'],
                        'error'
                        );    
                        return false;            
                    }   
                    else {
                        console.log("exito.. redirigiendo");
                        console.log(data['restext']);
                        window.open(urldestino, '_blank');                        
                    }
                }
            });  
        }
    }); 


}