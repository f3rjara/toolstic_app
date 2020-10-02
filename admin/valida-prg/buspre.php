<div class="row">
    <div class="col s12">
    <ul class="collapsible">
    <li>
        <div class="collapsible-header">
            <b><i class="material-icons">search</i></b>
            <b>Buscar y visualizar preguntas</b>
        </div>
        <div class="collapsible-body">
            <div class="row">
                <div class="col s12 m10 push-m1">
                    Puede buscar y visualizar una pregunta, digitando en los campos correspondientes que usted considere necesario. para ver con más detalle una pregunta de clic en el campo <b>Visualizar</b> en cada resultado.
                </div>
            </div>
            <br>
            <div class="row">            
                <br>
                <div class="input-field col s12 m12" > 
                    <i class="material-icons prefix">search</i>
                    <input id="InputBuscar" onkeyup="SpecificQuestion()" placeholder="Puedes buscar por: creador de pregunta, docente validador de la pregunta, enunciado de la pregunta, competencia, estado pregunta" type="text" class="validate autocomplete">
                    <label for="InputBuscar">Otros parametros de busqueda</label>

                    <div class="input-field col s12 m6"> 
                        <label>
                            <input type="checkbox" id="IsValidator" class="filled-in" />
                            <span class="black-text">Es docente experto temático</span>
                        </label>
                    </div>

                    <div class="input-field col s12 m6"> 
                        <label>
                            <input type="checkbox" id="chkEnunciado" class="filled-in" />
                            <span class="black-text">Buscar en el enunciado de la pregunta</span>
                        </label>
                    </div>
                </div>

                
                


            </div>
            <br>
            <div class="row">
                <div class="progress">
                    <div class="indeterminate"></div>
                </div>
            </div>
            

            <div class="row rigth">
                <div class="col s12 rigth">
                    <div class="chip ToolsticAzul-dark white-text ">
                        <b>Nº de resultados encontrados</b>
                    </div>   
                    <div class="chip ToolsticAzul white-text ">
                        <b id="NumResulados">0</b>
                    </div>
                </div>
            </div>
                            
            <div class="row">
                <table class="centered responsive-table">
                    <thead>
                        <tr>
                            <th width="2%">No</th>
                            <th width="13%">Cod. Pregunta</th>
                            <th width="49%">Competencia</th>
                            <th width="21%">Estado Pregunta</th>
                            <th width="5%">Visualizar</th>                            
                        </tr>
                    </thead>
                    <tbody id="TablaBodyResultados">
                        
                    </tbody>
                </table>

            </div>
        </div>
    </li>
    </ul>
    </div>
</div>