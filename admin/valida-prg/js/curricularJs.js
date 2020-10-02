$(".div_compe").hide(100);
$(".div_tareas").hide(100);


function VerCompetencias(id_compe) {   
    OcultarTareas();
    OcultarCompetencias();
    var comp = '#'+id_compe.id;     
    $(comp).show("slow");
    $("body, main").animate({ scrollTop:($('.div_compe')[0].scrollHeight)+300}, 3000);   
}


function VerTareas(id_tarea) {  
    OcultarTareas(); 
    var uni = '#'+id_tarea.id; 
    $(uni).show("slow");
    $("body, main").animate({ scrollTop:($('.div_tareas')[0].scrollHeight)+800}, 1000);    
}

function OcultarTareas()
{            
    var els = document.getElementsByClassName("div_tareas");
    Array.prototype.forEach.call(els, function(el) {   
        var uni = '#'+el.id; 
        $(uni).hide("slow");
    });
}


function OcultarCompetencias()
{            
    var els = document.getElementsByClassName("div_compe");
    Array.prototype.forEach.call(els, function(el) {   
        var uni = '#'+el.id; 
        $(uni).hide("slow");
    });
}