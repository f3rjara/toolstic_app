function EscucharTexVoz(id){
    var texto = $(id).text();
    if (speechSynthesis.speaking) {
        // SpeechSyn is currently speaking, cancel the current utterance(s)
        speechSynthesis.cancel();       
    }
          
        var message = new SpeechSynthesisUtterance(texto);
        message.lang = "es-ES";
        speechSynthesis.speak(message);
      
   
}

function StopVoz(){
    speechSynthesis.cancel();       
}

function IrAprgFin(tab, litab){    
    $('.tabs').tabs('select',tab);  
    $("body, main").animate({ scrollTop: ($('.tabs')[0].scrollHeight)+500}, 1500);
    
    console.log(litab);
    if(litab < 20){
        console.log("es menor a 20");
        $('.tabs').scrollLeft(-300);
    }
    else if(litab >= 20 && litab <= 36){
        console.log("es mayor o igua  a 20 y menor a 40");
        $('.tabs').scrollLeft(1200);
    }
    else if(litab > 36){
        console.log("es mayor a 40");
        $('.tabs').scrollLeft(1900);
    }
    
   
}
