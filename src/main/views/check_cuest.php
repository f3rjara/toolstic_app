<?php          
$IpUsuario = ObtenerIpConex();     
$FechaSistema = ObtenerDateTime();
$DataInscripcionEstu = EstudianteInscrito($userlog['cod_estudiante'], $conex );

// OBTENCION DE DATOS PARA CUESTIOANRIO
$DataNewCues = array(
    "id_inscripcion" => $DataInscripcionEstu['data']['id_inscripcion_prueba'],
    "cod_estudiante" => $StudneReload['cod_estudiante'],
    "creacion_cuestionario" => $FechaSistema['date'],
    "inicio_cuestionario" => $FechaSistema['date'],
    "estado_cuestionario" => "3",
    "ip_estudiante" => $IpUsuario,
    "accede_cuestionario" => "1"
);

$NumPrgSave = 0;
//VERIFICAR EL CUESTIONARIO Y CANTIDAD
$TieneCuestionarios = IntenoStudent($conex, $StudneReload['cod_estudiante']);


if( $TieneCuestionarios !== NULL && count($TieneCuestionarios) > 0 ){
    if ($TieneCuestionarios['id_estado_cuestionario'] == 3) {
        # EL CUESTIONARIO ESTA EN CURSO 
        $ReiniciarTempo = True;
        
        // SE RECUPERAN RESPUESTAS GUARDADAS
        $ResponseCuestionario = array('res'=> 'true', 'ResTex'=>'Usted ya tiene un cuestionario en curso');
        $RespuestasGuardadas = RecoveryRespuSave($conex, $TieneCuestionarios['id_cuestionario'], $userlog['cod_estudiante']);         

        //ACTUALIZA LA FECHA DE INICIO CUESTIONARIO 
        $Fecha_Ingreso = ObtenerDateTime(); 
        $diff = abs(strtotime($TieneCuestionarios['fecha_creacion_cuestionario']) - strtotime($Fecha_Ingreso['date'])); 
        $horaRestante = explode(".",number_format($diff/60, 2, '.', ''));  

        // SE RESTA EL TIEMPO DE ACUERDO A LA HORA DEL SISTEMA
        $MinnutosRestantes = intdiv($diff, 60);    

        $NumPrgSave = count($RespuestasGuardadas);       
        
        $PGC1 = PreguntasGuardadasXCompe($conex, $RespuestasGuardadas, 1);
        $PGC2 = PreguntasGuardadasXCompe($conex, $RespuestasGuardadas, 2);
        $PGC3 = PreguntasGuardadasXCompe($conex, $RespuestasGuardadas, 3);
        $PGC4 = PreguntasGuardadasXCompe($conex, $RespuestasGuardadas, 4);
        
        // SE GENERAN PREGUNTAS ALEATORIAS
        
        $PreAleXComp1 = PreguntasDeCompetencia(1,(10-count($PGC1)), $conex, $RespuestasGuardadas, 0); 
        $PreAleXComp2 = PreguntasDeCompetencia(2,( 8-count($PGC2)), $conex, $RespuestasGuardadas, 0); 
        $PreAleXComp3 = PreguntasDeCompetencia(3,(16-count($PGC3)), $conex, $RespuestasGuardadas, 0); 
        $PreAleXComp4 = PreguntasDeCompetencia(4,(16-count($PGC4)), $conex, $RespuestasGuardadas, 0);         
        
        $FullPregunCues = array_merge($PGC1,$PGC2,$PGC3,$PGC4,$PreAleXComp1,$PreAleXComp2,$PreAleXComp3,$PreAleXComp4);

    }
    else{
        //SE CREA UN NUEVO CUESTIONARIO                 
        $ResponseCuestionario =  NuevoCuestionario($conex, $DataNewCues); 

        // SE GENERAN PREGUNTAS ALEATORIAS
        $PreAleXComp1 = PreguntasDeCompetencia(1, 10, $conex, 0, 1); 
        $PreAleXComp2 = PreguntasDeCompetencia(2, 8,  $conex, 0, 1); 
        $PreAleXComp3 = PreguntasDeCompetencia(3, 16, $conex, 0, 1); 
        $PreAleXComp4 = PreguntasDeCompetencia(4, 16, $conex, 0, 1);
        
        $FullPregunCues = array_merge($PreAleXComp1,$PreAleXComp2,$PreAleXComp3,$PreAleXComp4);
    }
}
else{           
    //SE CREA UN NUEVO CUESTIONARIO PARA EL ESTUDIANTE
    $ResponseCuestionario =  NuevoCuestionario($conex, $DataNewCues);

    // SE GENERAN PREGUNTAS ALEATORIAS
    $PreAleXComp1 = PreguntasDeCompetencia(1, 10, $conex, 0, 1);             
    $PreAleXComp2 = PreguntasDeCompetencia(2, 8,  $conex, 0, 1); 
    $PreAleXComp3 = PreguntasDeCompetencia(3, 16, $conex, 0, 1); 
    $PreAleXComp4 = PreguntasDeCompetencia(4, 16, $conex, 0, 1); 
    
    $FullPregunCues = array_merge($PreAleXComp1,$PreAleXComp2,$PreAleXComp3,$PreAleXComp4);
}

?>