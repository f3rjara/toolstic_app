$(document).ready(function() {     
    console.log( "Bienvenido a ToolsTic!" );
    M.AutoInit();
    moment().format();
    ModalIndex();          
});        


function VerTuto(){    
    //cierra el modal de preguntas frecuentes y abre el modal de video
    $('#PrgFre').modal('close');
    $('#VidTut').modal('open');    
}

function modalMesage() {

    Swal.mixin({            
        //confirmButtonText: 'Siguiente &rarr;', 
        confirmButtonColor: '#019140',
        allowOutsideClick: true,
        allowEscapeKey: false,
        progressSteps: ['1', '2', '3', '4']
        }).queue([
        {
            imageUrl: GetUrl.ROOT_PUBLIC+'/img/udenar1.png',
            imageWidth: '50%',
            imageHeight: '50%',
            confirmButtonText: 'Siguiente &rarr;', 
            title: 'Bienvenido!!',
            text: 'Estas a punto de ingresar a la plataforma ToolsTic del curso de competencias en Lenguaje y Herramientas Informáticas de la Universidad de Nariño.',
        },
        {
            confirmButtonText: 'Siguiente &rarr;', 
            title: 'Open Course ToolsTic!!',
            text: 'El Open Course Ware (OCW) ToolsTic, te brinda la posibilidad de prepararte para la prueba de Homologación ToolsTic, mediante actividades, documentos y simulaciones de la prueba.',
        },
        {
            confirmButtonText: 'Siguiente &rarr;', 
            title: 'Homologa ToolsTic!!',
            text: 'La prueba de Homologación ToolsTic, genera la posibilidad de homologar el curso de competencias en Lenguaje y Herramientas Informáticas mediante un examen; pero recuerda, la  prueba solo estará habilitada en fechas establecidas por el calendario académico de la Universidad de Nariño.',
        },
        {
            confirmButtonText: 'Siguiente &rarr;', 
            title: 'Curso ToolsTic!!',
            text: 'El curso ToolsTic, es un espacio para que docentes y estudiantes puedan interactuar con todas las actividades y contenidos del curso de competencias en Lenguaje y Herramientas Informáticas de la Universidad de Nariño.',
        },
        ]).then((result) => {
        if (result.value) {                
            Swal.fire({
                imageUrl: GetUrl.ROOT_PUBLIC+'/img/udenar1.png',
                imageWidth: '50%',
                imageHeight: '50%',
                title: 'Es hora de comenzar!',   
                text: 'ToolsTic -  Curso de competencias en Lenguaje y Herramientas Informáticas de la Universidad de Nariño',
                confirmButtonColor: '#019140',
                confirmButtonText: 'Entendido'
            })
        }
    });
        
}


function ModalIndex() {

    var TTstorage = localStorage.getItem('TTStorage');
    var TTS = [];
    var hoy = moment(new Date());

    if(TTstorage === null){
        TTS = [
            {
                name: 'TTStorage',
                value: true,
                date: hoy,
                dif: 0
            }
        ];
        console.log(TTS);
        localStorage.setItem('TTStorage',JSON.stringify(TTS));
        modalMesage();
        //localStorage.setItem('')
    }
    else{        
        let datosTTS = JSON.parse(localStorage.getItem('TTStorage'));

        var estado = datosTTS[0]['value'];        
        var LastMesage = new moment(datosTTS[0]['date']);        
        var HoyMesage = new moment(new Date());     
        var dif = moment.duration(HoyMesage.diff(LastMesage));
        var days = parseInt(moment.duration(dif).asDays());      
        
        if(days < 4 && estado === true){           
            TTS = [
                {
                    name: 'TTStorage',
                    value: true,
                    date: LastMesage,
                    dif: days
                }
            ];
            localStorage.setItem('TTStorage',JSON.stringify(TTS));   
        }      
        else{            
            TTS = [
                {
                    name: 'TTStorage',
                    value: true,
                    date: moment( new Date()),
                    dif: 0
                }
            ];
            localStorage.setItem('TTStorage',JSON.stringify(TTS));           
            modalMesage();
        }

    }
}

//VALIDAR SOLO EL INGRESO DE NUMEROS
function justNumbers(e){
    var keynum = window.event ? window.event.keyCode : e.which;
    if ((keynum == 8) || (keynum == 46))
    return true;            
    return /\d/.test(String.fromCharCode(keynum));
};

