 <!-- MODAL VER PREGUNTA -->
 <div id="VerFullPrg" class="modal modal-fixed-footer">
     <div class="modal-content">
         <div class="row">
             <div class="col s12 m6 center">
                <b>Código Pregunta:</b>
                    <a class="btn ToolsticAzul white-text" id="MF_cod_pregunta">
                        123
                    </a>
             </div>
             <div class="col s12 m6 center">
                    <a class="btn white-text" id="MF_estado_pregunta">
                        estado pregunta
                    </a>
             </div>
             <br>
         </div>

         <div class="row">
             <br>
             <ul class="collapsible">
                 <li>
                     <div class="collapsible-header">
                            <i class="material-icons">bookmark</i>
                            <span>
                                <b id="MF_competencia">
                                    MF_competencia
                                </b>
                            </span>
                     </div>

                     <div class="collapsible-body">
                            <span id="MF_def_competencia">
                                    la defincionde la competencia
                            </span>
                     </div>


                 </li>
                 <li>
                     <div class="collapsible-header">
                            <i class="material-icons">description</i>
                            <span>
                                <b>
                                    EVIDENCIA
                                </b>
                            </span>
                     </div>

                     <div class="collapsible-body">
                            <span id="MF_evidencia">
                                    evidencia
                            </span>
                     </div>
                 </li>
                 <li>
                     <div class="collapsible-header">
                            <i class="material-icons">import_contacts</i>
                            <span>
                                <b>
                                    TAREA
                                </b>
                            </span>
                     </div>

                     <div class="collapsible-body">
                            <span id="MF_tarea">
                                TAREA
                            </span>
                     </div>
                 </li>
             </ul>
         </div>

        <div class="row">
            <br>
            <div class="chip ToolsticAzul accent-4 white-text ">               
                <b>Enunciado</b>
            </div>            
            <div class="TexEnunciado white black-text card-panel" id="MF_enunciado">
                 enunciado
            </div>
            
            <br>
            <div class="chip ToolsticAzul accent-4 white-text ">               
                <b>Opción de respuesta No 1</b>
            </div>              
            <a class="btn green white-text">
                <b>Peso de respuesta</b></a> 
                <a class="btn green white-text">
                <b id="MF_pesoP1">100 %</b>
            </a>
        
            <div class="TexEnunciado white black-text card-panel" id="MF_opcionR1">
                respuesta 1
            </div>


            <br>
            <div class="chip ToolsticAzul accent-4 white-text ">               
                <b>Opción de respuesta No 2</b>
            </div> 
            <a class="btn blue white-text">
                <b>Peso de respuesta</b></a> 
                <a class="btn blue white-text">
                <b id="MF_pesoP2">100 %</b>
            </a>
        
            <div class="TexEnunciado white black-text card-panel" id="MF_opcionR2">
                respuesta 2
            </div>


            <br>
            <div class="chip ToolsticAzul accent-4 white-text ">               
                <b>Opción de respuesta No 3</b>
            </div> 
            <a class="btn orange darken-4 white-text">
                <b>Peso de respuesta</b></a> 
                <a class="btn orange darken-4 white-text">
                <b id="MF_pesoP3">100 %</b>
            </a>
        
            <div class="TexEnunciado white black-text card-panel" id="MF_opcionR3">
                respuesta 3
            </div>


            <br>
            <div class="chip ToolsticAzul accent-4 white-text ">               
                <b>Opción de respuesta No 4</b>
            </div> 
            <a class="btn red darken-3 white-text">
                <b>Peso de respuesta</b></a> 
                <a class="btn red darken-3 white-text">
                <b id="MF_pesoP4">100 %</b>
            </a>
        
            <div class="TexEnunciado white black-text card-panel" id="MF_opcionR4">
                respuesta 4
            </div>
            
         </div>

         <div class="row">
                <div class="row">
                    <br>
                    <label>Creada el: 
                        <b id="MF_fecha_creacion_pregunta">
                            strftime("%d de %b del %Y, %I:%M:%S %p",strtotime($MisPrg['']))                       
                        </b>
                    </label> <br>
                    
                    <label>Creada por:
                        <b id="MF_creador_pregunta">
                            Luis FErnando JArmilo
                        </b>
                    </label> <br>

                    <label>Validada por:
                        <b id="MF_validador_pregunta">
                            Luis FErnando JArmilo
                        </b>
                    </label> <br>


                </div>
                             
         </div>
         <br>
     </div>
     <div class="modal-footer">
         <a href="#!" class="modal-close red darken-4 white-text btn-flat">Cerrar</a>
     </div>
 </div>
 <!-- FIN DEL MODAL MODAL VER PREGUNTA -->