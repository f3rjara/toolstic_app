<?php

function getReport($datos_reporte){

    $report = '
    <body >
        <div class="head" >
            <div class="enc1">
                <img src="'.ROOT_PUBLIC.'/img/report_insc/Enc1.png" alt="">
            </div>
            <div class="enc2">
                <img src="'.ROOT_PUBLIC.'/img/report_insc/Logotipo3.png" alt="">
            </div>
        </div>
        <div class="img-report">
            <img src="'.ROOT_PUBLIC.'/img/report_insc/reporte.png" alt="">
        </div><br>
        <div class="titleReport" style="font-family:comfortabold">
            REPORTE INSCRIPCIÓN
        </div>
        <div class="titleReport-2" style="font-family:comfortaligth">
                PRUEBA LENGUAJE Y HERRAMIENTAS INFORMÁTICAS 
        </div>
        <hr class="line-title">
        <div class="datos" style="font-family:comforta">
            <div class="title">
                <div class="text-title" >
                    DATOS ESTUDIANTE
                </div>
            </div>
            <div class="campos" style="font-family:comforta">
                <div class="icon">
                    <img src="'.ROOT_PUBLIC.'/img/report_insc/documento.png" width="5%" alt="">
                </div>
                <div class="info" >
                    <div class="title-subtitle" style="font-family:comfortabold">
                        Tipo y número de documento identidad
                    </div>
                    <div class="text-subtitle">
                        '.$datos_reporte->documento_estudiante.'
                        <hr>
                    </div>
                </div>
                
            </div>

            <div class="campos-2" style="font-family:comforta" >
                <div class="icon">
                    <img src="'.ROOT_PUBLIC.'/img/report_insc/id.png" width="5%" alt="">
                </div>
                <div class="info">
                    <div class="title-subtitle">
                        Código estudiantil
                    </div>
                    <div class="text-subtitle">
                        '.$datos_reporte->codigo_estudiante.'
                        <hr>
                    </div>
                </div>
            </div>

            <div class="campos" style="font-family:comforta">
                <div class="icon">
                    <img src="'.ROOT_PUBLIC.'/img/report_insc/user.png" width="5%" alt="">
                </div>
                <div class="info">
                    <div class="title-subtitle">
                        Nombres y apellidos
                    </div>
                    <div class="text-subtitle">
                        '.$datos_reporte->nombre_completo.'
                        <hr>
                    </div>
                </div>
            </div>

            <div class="campos-2" style="font-family:comforta">
                <div class="icon">
                    <img src="'.ROOT_PUBLIC.'/img/report_insc/mail.png" width="5%" alt="">
                </div>
                <div class="info">
                    <div class="title-subtitle">
                        Correo electrónico
                    </div>
                    <div class="text-subtitle">
                        '.$datos_reporte->correo.'
                        <hr>
                    </div>
                </div>
            </div>

            <div class="campos" style="font-family:comforta">
                <div class="icon">
                    <img src="'.ROOT_PUBLIC.'/img/report_insc/star.png" width="5%" alt="">
                </div>
                <div class="info">
                    <div class="title-subtitle">
                        Semestre
                    </div>
                    <div class="text-subtitle">
                        '.$datos_reporte->semestre.' Semestre
                        <hr>
                    </div>
                </div>
            </div>

            <div class="campos-2" style="font-family:comforta">
                <div class="icon">
                    <img src="'.ROOT_PUBLIC.'/img/report_insc/book.png" width="5%" alt="">
                </div>
                <div class="info">
                    <div class="title-subtitle">
                        Programa
                    </div>
                    <div class="text-subtitle">
                        '.$datos_reporte->programa.'
                        <hr>
                    </div>
                </div>
            </div>

            
        </div>

        <div class="datos" style="font-family:comforta">
            <div class="title">
                <div class="text-title" >
                    INFORMACIÓN DE LA PRUEBA
                </div>
            </div>
            <div class="campos" style="font-family:comforta">
                <div class="icon">
                    <img src="'.ROOT_PUBLIC.'/img/report_insc/cuestionario.png" width="5%" alt="">
                </div>
                <div class="info" >
                    <div class="title-subtitle">
                        Prueba
                    </div>
                    <div class="text-subtitle">
                        '.$datos_reporte->prueba.'
                        <hr>
                    </div>
                </div>
                
            </div>

            <div class="campos-2" style="font-family:comforta" >
                <div class="icon">
                    <img src="'.ROOT_PUBLIC.'/img/report_insc/epoca.png" width="5%" alt="">
                </div>
                <div class="info">
                    <div class="title-subtitle">
                        Periodo
                    </div>
                    <div class="text-subtitle">
                        '.$datos_reporte->periodo_aplicacion.'
                        <hr>
                    </div>
                </div>
            </div>

            <div class="campos" style="font-family:comforta">
                <div class="icon">
                    <img src="'.ROOT_PUBLIC.'/img/report_insc/calendario.png" width="5%" alt="">
                </div>
                <div class="info">
                    <div class="title-subtitle">
                        Fecha de aplicación de la prueba
                    </div>
                    <div class="text-subtitle">
                        '.$datos_reporte->fecha_aplicacion.'
                        <hr>
                    </div>
                </div>
            </div>

            <div class="campos-2" style="font-family:comforta">
                <div class="icon">
                    <img src="'.ROOT_PUBLIC.'/img/report_insc/reloj.png" width="5%" alt="">
                </div>
                <div class="info">
                    <div class="title-subtitle">
                        Hora de presentación
                    </div>
                    <div class="text-subtitle">
                        '.$datos_reporte->hora_aplicacion.'
                        <hr>
                    </div>
                </div>
            </div>

            <div class="campos" style="font-family:comforta">
                <div class="icon">
                    <img src="'.ROOT_PUBLIC.'/img/report_insc/casa.png" width="5%" alt="">
                </div>
                <div class="info">
                    <div class="title-subtitle">
                        Sede
                    </div>
                    <div class="text-subtitle">
                        '.$datos_reporte->sede_aplicacion.'
                        <hr>
                    </div>
                </div>
            </div>

            <div class="campos-2" style="font-family:comforta">
                <div class="icon">
                    <img src="'.ROOT_PUBLIC.'/img/report_insc/ubicacion.png" width="5%" alt="">
                </div>
                <div class="info">
                    <div class="title-subtitle">
                        Lugar de presentación
                    </div>
                    <div class="text-subtitle">
                        '.$datos_reporte->lugar_presentacion.'
                        <hr>
                    </div>
                </div>
            </div>

        </div>

         <div class="datos" style="font-family:comforta">
            <div class="title">
                <div class="text-title" >
                    DETALLE DE LA INSCRIPCIÓN
                </div>
            </div>
            <div class="campos" style="font-family:comforta">
                <div class="icon">
                    <img src="'.ROOT_PUBLIC.'/img/report_insc/group.png" width="5%" alt="">
                </div>
                <div class="info" >
                    <div class="title-subtitle">
                        Grupo inscrito
                    </div>
                    <div class="text-subtitle">
                        '.$datos_reporte->grupo_inscripcion.'
                        <hr>
                    </div>
                </div>
                
            </div>

            <div class="campos-2" style="font-family:comforta" >
                <div class="icon">
                    <img src="'.ROOT_PUBLIC.'/img/report_insc/pencil.png" width="5%" alt="">
                </div>
                <div class="info">
                    <div class="title-subtitle">
                        Fecha de inscripción del estudiante
                    </div>
                    <div class="text-subtitle">
                        '.$datos_reporte->fecha_inscripcion.'
                        <hr>
                    </div>
                </div>
            </div>

            <div class="campos" style="font-family:comforta">
                <div class="icon">
                    <img src="'.ROOT_PUBLIC.'/img/report_insc/aula.png" width="5%" alt="">
                </div>
                <div class="info">
                    <div class="title-subtitle">
                        Aula de presentación
                    </div>
                    <div class="text-subtitle">
                        '.$datos_reporte->aula_presentacion.'
                        <hr>
                    </div>
                </div>
            </div>

            <div class="campos-2" style="font-family:comforta">
                <div class="icon">
                    <img src="'.ROOT_PUBLIC.'/img/report_insc/state.png" width="5%" alt="">
                </div>
                <div class="info">
                    <div class="title-subtitle">
                        Estado de la prueba
                    </div>
                    <div class="text-subtitle">
                        '.$datos_reporte->estado_prueba.'
                        <hr>
                    </div>
                </div>
            </div>

        </div>

        <div class="datos">
            <div class="texto-info">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laborum sed nisi, amet corporis fuga totam, consequuntur
                esse nihil laboriosam consequatur cumque voluptatibus distinctio quas ipsa earum veritatis, tempore aspernatur
                asperiores!
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ex iusto itaque aut aspernatur fugit exercitationem,
                porro quas eveniet officia dolores dicta eos officiis. Obcaecati ullam consequuntur ipsum rerum maiores.
            </div>
            <div class="img-qr">
                <img class="qr" src="https://borealtech.com/wp-content/uploads/2018/10/codigo-qr-1024x1024.jpg"  alt="">
                <div class="inf-calendar">
                    MÁS INFORMACIÓN SOBRE FECHAS SOBRE CALENDARIOS ACADÉMICOS UNIVERSIDAD DE NARIÑO
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="img-footer">
                <img src="'.ROOT_PUBLIC.'/img/report_insc/footer.png" alt="">
            </div>
            
        </div>

    </body>
    
    ';


    return $report;
}



?>

