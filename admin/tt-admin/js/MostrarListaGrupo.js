function MoEstInsGru(){    
    $('#GrupoSelect option:selected').each(function(){        
        id_grupo = $(this).val();         
        $.ajax({        
            type: "POST",
            data: { id_grupo:id_grupo },         
            url: "php/VerEstuGrupo.php",       
            success: function(res){             
                var data = jQuery.parseJSON(res);   
                $('#TBODY_Estudiantes').html(data['FILAS']);                
            }//Fin success       
        }) // FIN DE AJAX

    })  // FIN DEL SELECT

}; //FIN DE LA FUNCION 



