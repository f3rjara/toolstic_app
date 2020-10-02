jQuery(document).on('submit','#Form_Grupos', function(event){
    
    event.preventDefault();   
    event.stopPropagation();

    console.log("Recuperando datos para crear usuario");
    var grupo_select = $('#GrupoSelect').val();
   
    if(grupo_select===null || grupo_select=="" || grupo_select == 0){
        Toast.fire({
              type: 'error',
              title: 'Debes seleccionar un grupo'
            });
        $('#GrupoSelect').focus();       
        return false;
    }
    else{
        setTimeout(function(){ 
            window.open('./resultPrint.php?tk=4001f77c7e6670877f2dba8bff6686d3&grid='+grupo_select, '_blank');
        }, 600); 
        
    }

    


    


});