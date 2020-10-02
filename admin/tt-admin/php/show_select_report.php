<?php
    $CountEstuMatriculados = result_CountEstudiantesMatriculados ( $conex );
    $CountEstuInscritos = result_CountEstudiantesInscritos ( $conex ) ;
    $CountEstuNOInscritos = ( $CountEstuMatriculados['result'] - $CountEstuInscritos['result'] );
    $CountEstuRealizaronPrueba = result_CountEstudiantesPresentanPruebas ( $conex );
    $CountEstuNORealizaronPrueba = result_CountEstudiantesNoPresentanPruebas ( $conex );
    $CountEstuPresentadosAprobados = result_CountEstudiantesPresentadosAprobados ( $conex );
    $CountEstuPresentadosReprobados = result_CountEstudiantesPresentadosReprobados ( $conex );

    
?>

<div class="row container">
    <ul class="collapsible popout">

        <li>
            <div class="collapsible-header"><i class="material-icons">assignment</i>
                ESTUDIANTES MATRICULADOS EN TOOLSTIC <hr>
                <b> 
                    <?php echo $CountEstuMatriculados['result'] ?>
                </b>
            </div>
            <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
        </li>
        
        <br> <li>
            <div class="collapsible-header"><i class="material-icons">assignment</i>
                ESTUDIANTES INSCRITOS A UNA PRUEBA<hr>
                <b> 
                    <?php echo $CountEstuInscritos['result'] ?>  
                </b>
            </div>
            <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
        </li>


        <br> <li>
            <div class="collapsible-header"><i class="material-icons">assignment</i>
                ESTUDIANTES NO INSCRITOS A UNA PRUEBA<hr>
                <b> 
                    <?php echo $CountEstuNOInscritos ?>  
                </b>
            </div>
            <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
        </li>
        
        <br><li>
            <div class="collapsible-header"><i class="material-icons">assignment</i>
                ESTUDIANTES INSCRITOS Y PRESENTARON UNA PRUEBA<hr>
                <b> 
                    <?php echo $CountEstuRealizaronPrueba['result'] ?>   
                </b>
            </div>
            <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
        </li>

        <br><li>
            <div class="collapsible-header"><i class="material-icons">assignment</i>
                ESTUDIANTES INSCRITOS Y NO HAN PRESENTADO UNA PRUEBA <hr>
                <b> 
                    <?php echo $CountEstuNORealizaronPrueba['result'] ?>  
                </b>
            </div>
            <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
        </li>

        <br><li>
            <div class="collapsible-header"><i class="material-icons">assignment</i>
                ESTUDIANTES PRESENTADOS EN UNA PRUEBA Y APROBADOS  <hr>
                <b> 
                    <?php echo $CountEstuPresentadosAprobados['result'] ?>    
                </b>
            </div>
            <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
        </li>

        <br><li>
            <div class="collapsible-header"><i class="material-icons">assignment</i>
                ESTUDIANTES PRESENTADOS EN UNA PRUEBA Y REPROBADOS <hr>
                <b> 
                    <?php echo $CountEstuPresentadosReprobados['result'] ?>    
                </b>
            </div>
            <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
        </li>

    </ul>
</div>