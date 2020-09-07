function AccedeExamen( recupera_res, intentoNo, enCod ) {
    var urldestino = GetUrl.ROOT_MEDIA_USER +'/student/cuestionario.php?encod='+enCod+'&recu_pre='+recupera_res+'&int='+intentoNo;;
   
    Swal.fire({
        title: 'Comenzar a resolver la prueba?',
        text: "Una vez iniciada la prueba no se podrá cancelar!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, comenzar a resolver!'
        }).then((result) => {
        if (result.value) {                    
            let timerInterval
            Swal.fire({
            allowOutsideClick: false,
            title: 'Mucha suerte!',
            html: 'Serás redirigido a presentar la prueba de Homologación en unos segundos.',
            timer: 4000,
            onBeforeOpen: () => {                
                Swal.showLoading()
            },
            onClose: () => {
                clearInterval(timerInterval);
                $.ajax({
                    type: "POST",
                    data: { bandera : true },                            
                    url:  GetUrl.ROOT_MAIN_CON + "/models/habilita_examen.php",         
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
                            window.location = urldestino; 
                        }
                    }
                });  
            }
            });  
        };               
        
    });

}