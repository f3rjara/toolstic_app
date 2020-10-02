
$(document).ready(function(){
    M.AutoInit();
    Toast.fire({
      type: 'success',
      title: 'Usuario Conectado'
    }); 
    $('.tooltipped').tooltip();
    
    // Disabled copiar y pegar en el sitio
    $('body').bind('cut copy paste', function (e) {
        e.preventDefault();
    });

    //Disable mouse right click
    $("body").on("contextmenu",function(e){
        return false;
    });
    // Disabled F12 y Ctrl + shif + I Modo Desarrollo
    $(document).keydown(function (event) {
        if (event.keyCode == 123) { // Prevent F12
            return false;
        } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
            return false;
        }
    });
    window.addEventListener('beforeunload', askConfirmation);
    

    console.log("%cDetente!",`
        box-sizing: content-box;
        border: none;
        font: normal 80px/normal "Anton", Helvetica, sans-serif;
        color: rgb(255, 0, 125);
        line-height:110px;
        text-overflow: clip;
        text-shadow: 0 0 20px rgb(254,152,1) , 10px -10px 30px rgb(254,136,3) , -20px -20px 40px rgb(255,74,2) , 20px -40px 50px rgb(236,18,2) , -20px -60px 60px rgb(205,0,6) , 0 -80px 70px rgb(151,55,2) , 10px -90px 80px rgb(69,27,1) ;
    `);
        console.log("%cEsta función del navegador está pensada para desarrolladores. Si alguien te indicó que copiaras y pegaras algo aquí para habilitar una función de Toolstic o para 'acceder' al sistema, se trata de un fraude. Si lo haces, incurriras en una sanción.!",`
        box-sizing: content-box;
        border: none;
        font: normal 24px/normal "Anton", Helvetica, sans-serif;
        color: rgb(255, 0, 125);
        line-height:25px;
        text-overflow: clip; `);

});  


function askConfirmation(evt) {
    var msg = 'Si recarga la página perdera todos los datos no guardados.\n¿Deseas recargar la página?';
    evt.returnValue = msg;
    return msg;
}

