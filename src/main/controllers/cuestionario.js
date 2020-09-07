
$(document).ready(function(){
    M.AutoInit();
    Toast.fire({
      type: 'success',
      title: 'Usuario Conectado'
    }); 
    $('.tooltipped').tooltip();
    /*
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
    */

   

});  


function askConfirmation(evt) {
    var msg = 'Si recarga la página perdera todos los datos no guardados.\n¿Deseas recargar la página?';
    evt.returnValue = msg;
    return msg;
}

