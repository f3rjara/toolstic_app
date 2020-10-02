<div class="row">
    <div class="col s12 m10 push-m1 l5 push-l1 center">
        <?php 
            $TotalesPre = TotalesPrgToolsTIC($conex);
            if($TotalesPre[0]['bandera'] == 'false') {
        ?>
        <img src="./../../img/sin_datos.svg" class="img_graf" width="40%"> <br>
        <a class="btn ToolsticAzul">No hay preguntas registradas en el sistema</a>
        <?php } else { ?>              
            <canvas id="GrafPreTotales" width="98%"  ></canvas>            
        <?php }; ?>   
        <br>
    </div>    
    <div class="col s12 m10 push-m1 l5 push-l1 center">  
        <?php 
            $TotalesUser = TotalesMisPrg($conex, $userlog['id_usuario']);            
            if($TotalesUser[0]['bandera'] == 'false') {
        ?>
        <img src="./../../img/sin_datos.svg" class="img_graf" width="40%"> <br>
        <a class="btn ToolsticAzul">No tienes preguntas creadas</a>
            <?php } else {  ?>              
            <canvas id="GrafMisPre" width="98%" ></canvas>   
            <?php  }; ?>   
        <br>
    </div> 
</div>
<br> <br>