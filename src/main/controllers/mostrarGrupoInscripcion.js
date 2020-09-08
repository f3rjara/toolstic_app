$('#SelectGrupo').hide();


function MostrarGrupo(id){
    var id = id;    
    
    //Mostrar mensaje de grupos y cupos
    $('#SelectGrupo').show(1000, function(){  
        let timerInterval
            Swal.fire({
            allowOutsideClick: false,
            title: 'Inscripción a la prueba!',
            html: 'Seleccione grupo y horario disponibles. <hr> <b> Es posible que los cupos se completen mientras realiza el proceso de inscripción</b>',
            timer: 4500,
            onBeforeOpen: () => {
                Swal.showLoading()
            },
            onClose: () => {
                clearInterval(timerInterval)
            }
            });
        $("body").animate({ scrollTop: $('#SelectGrupo')[0].scrollHeight + ($(window).height() - 1300)} , 3200);         
    }); 
    
    //consulta de grupos y cupos en la prueba
    $.ajax({
        url: GetUrl.ROOT_MAIN_CON + "/models/mostarGruposInscripcion.php" ,
        data: "id_prueba="+id,
        type: "POST",       
        
        success: function(res) {               
            var data = jQuery.parseJSON(res);
            idgrupoSend = 0;
            $('#GruposPrueba').html(data[0]);
            $('#NamePrueba').val(data[1]);
            
            $SeHabilitaBTN = data[2];
            
            if($SeHabilitaBTN == true){
                $('#BtnRealizarInscripcion').attr('disabled', 'disabled');
            }
            else{
                $('#BtnRealizarInscripcion').removeAttr('disabled');
            }
            
        }
    });


};