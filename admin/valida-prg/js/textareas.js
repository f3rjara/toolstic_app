function HabilitarTexarea(){    
    //$('#TxEnunciado').summernote('fontName', 'Arial');
    //$('#TxEnunciado').summernote('fontSize', 40);
    $('.summernote').summernote('fontSize', 40);

    $('#TxEnunciado').summernote({
        placeholder: 'Digite el enunciado de la pregunta; si va a copiar texto aquí, utilice la combinación de teclas: CONTROL + SHIFT + V',   
        lang: 'es-ES',
        toolbar: [
            //[groupName, [list of button]]
            //['font', [ 'fontname', 'fontsize']],
            ['aling', ['justifyLeft', 'justifyCenter', 'justifyRight' , 'justifyFull' ]],
            ['para', ['ul', 'ol', 'paragraph-left']],
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['insert', ['picture', 'link', 'table']],
            ['misc', ['undo', 'redo']]
        ],
        height: 200,
             
    });
    


    //OPCIÓN DE RESPUESTA No 1

    $('#TxOpcion1').summernote({
        placeholder: 'Digite la opción de respuesta No 1; si va a copiar texto aquí, utilice la combinación de teclas: CONTROL + SHIFT + V',
        lang: 'es-ES',
        toolbar: [
            // [groupName, [list of button]] 
            ['aling', ['justifyLeft', 'justifyCenter', 'justifyRight' , 'justifyFull' ]],
            ['para', ['ul', 'ol', 'paragraph-left']],
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['insert', ['picture', 'link', 'table']],
            ['misc', ['undo', 'redo']]
        ],
        height: 80
        //,
          //  onImageUpload: function(files, editor, welEditable) {
            //    sendFile(files[0], editor, welEditable);}
        
    });


    //OPCIÓN DE RESPUESTA No 2

    $('#TxOpcion2').summernote({
        placeholder: 'Digite la opción de respuesta No 2; si va a copiar texto aquí, utilice la combinación de teclas: CONTROL + SHIFT + V',
        lang: 'es-ES',
        toolbar: [
            // [groupName, [list of button]] 
            ['aling', ['justifyLeft', 'justifyCenter', 'justifyRight' , 'justifyFull' ]],
            ['para', ['ul', 'ol', 'paragraph-left']],
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['insert', ['picture', 'link', 'table']],
            ['misc', ['undo', 'redo']]
        ],
        height: 80
        //,
          //  onImageUpload: function(files, editor, welEditable) {
            //    sendFile(files[0], editor, welEditable);}
        
    });



    //OPCIÓN DE RESPUESTA No 3

    $('#TxOpcion3').summernote({
        placeholder: 'Digite la opción de respuesta No 3; si va a copiar texto aquí, utilice la combinación de teclas: CONTROL + SHIFT + V',
        lang: 'es-ES',
        toolbar: [
            // [groupName, [list of button]]  
            ['aling', ['justifyLeft', 'justifyCenter', 'justifyRight' , 'justifyFull' ]],
            ['para', ['ul', 'ol', 'paragraph-left']],
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['insert', ['picture', 'link', 'table']],
            ['misc', ['undo', 'redo']]
        ],
        height: 80
        //,
          //  onImageUpload: function(files, editor, welEditable) {
            //    sendFile(files[0], editor, welEditable);}
        
    });


    //OPCIÓN DE RESPUESTA No 4

    $('#TxOpcion4').summernote({
        placeholder: 'Digite la opción de respuesta No 4; si va a copiar texto aquí, utilice la combinación de teclas: CONTROL + SHIFT + V',
        lang: 'es-ES',
        toolbar: [
            // [groupName, [list of button]]  
            ['aling', ['justifyLeft', 'justifyCenter', 'justifyRight' , 'justifyFull' ]],
            ['para', ['ul', 'ol', 'paragraph-left']],
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['insert', ['picture', 'link', 'table']],
            ['misc', ['undo', 'redo']]
        ],
        height: 80
        //,
          //  onImageUpload: function(files, editor, welEditable) {
            //    sendFile(files[0], editor, welEditable);}
        
    });


}
