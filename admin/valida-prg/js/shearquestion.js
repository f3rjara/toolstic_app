
var bandDocente = "false";
var bandEnun = "false";


function AutocompletarShear(){
    $('#InputBuscar').autocomplete({
        data: {          
          "Alfabetización informacional": './../../img/comp_1.png',
          "Resolución de problemas con el uso de recursos computacionales": './../../img/comp_2.png',
          "Comunicación y colaboración en entornos digitales": './../../img/comp_3.png',
          "Creación y publicación de contenidos digitales": './../../img/comp_4.png',

          "Sin validar": './../../img/red.png',
          "Sin validar, editada": './../../img/red-darken4.png',         
          "Asignada": './../../img/orange.png',
          "Validada y aceptada": './../../img/green.png',
          "Validada y por corregir": './../../img/blue.png',
          "No aceptada": './../../img/grey.png',
          "Archivada": './../../img/grey.png'         

        },
        onAutocomplete: function(txt) {
            SpecificQuestion(txt);
        }
    });
}


function ShearQuestion(page, sq){
    
    var sql_send = "false";
    if(sq != undefined){ sql_send = sq;}
    
    var isvali = bandDocente;    
    var conEnunciado = bandEnun;    

    var parametros = {"action":"ajax","page":page, "sql_send":sql_send, "IsValidor":isvali, "IsEnunciado":conEnunciado};
    
    $.ajax({
        url:'php/AjxShearQuestion.php',
        data: parametros,			 
        success:function(data){  
            //console.log(data);
            var result = jQuery.parseJSON(data); 
            //console.log(result);
            $("#TablaBodyResultados").html(result['data']);		
            $("#NumResulados").html(result['NoRes']);	            		
        }
    })
}



function SpecificQuestion(opc){
    
    var espacio = $('#InputBuscar').val().replace(/ {2,}/g, ' ');
    $('#InputBuscar').val(espacio);
    var string = "";

    if(opc != undefined){ string = opc;}

    else{ string = $('#InputBuscar').val(); }

    if(string == "" || string== null|| string== " " ){
        ShearQuestion(1);        
    }
    else{
        ShearQuestion(1,string);       
    }
   
}

$("#IsValidator").click(function() {  
    if($("#IsValidator").is(':checked')) {  
         bandDocente = true;
         SpecificQuestion();
    } 
    else{
        bandDocente = false;
        SpecificQuestion();
    }
}); 


$("#chkEnunciado").click(function() {      
    if($("#chkEnunciado").is(':checked')) {  
        bandEnun = true;
        SpecificQuestion();
    } 
    else{
        bandEnun = false;
        SpecificQuestion();
    }
}); 


