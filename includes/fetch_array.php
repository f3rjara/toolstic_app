<?php

//FUNCION QUE ACTUALIZA AUTOMATICAMENTE LAS PRUEBAS A LA FECHA
function ActualizaEstadoPrueba($conex){
    $SqlActualiza = "SELECT id_prueba,fecha_aplicacion_prueba,id_estado_prueba FROM prueba";
    
    $LosDatos=$conex->query($SqlActualiza);        

    if($LosDatos->num_rows > 0){
        while($datos = $LosDatos->fetch_assoc())
        {            
            date_default_timezone_set('America/Bogota');
            $fecha_actual = date("Y-m-d");
            $fecha_aplicacion = $datos['fecha_aplicacion_prueba'];
            $estadoPrueba = $datos['id_estado_prueba'];
            $idPrueba = $datos['id_prueba'];;
           
            if((strtotime($fecha_actual) == strtotime($fecha_aplicacion)) AND $estadoPrueba == 2)
            {                
                $SqlActualizaEstado = "UPDATE prueba SET id_estado_prueba='3' WHERE id_prueba='".$idPrueba."'";
                $EjecutaActualizacion = $conex->query($SqlActualizaEstado); 
            }
            else if ((strtotime($fecha_actual) > strtotime($fecha_aplicacion)) AND ($estadoPrueba == 2 OR $estadoPrueba == 3) )
            {                
                $SqlActualizaEstado = "UPDATE prueba SET id_estado_prueba='4' WHERE id_prueba='".$idPrueba."'";
                $EjecutaActualizacion = $conex->query($SqlActualizaEstado);
            }           
        }// FIN WHILE
    } // fin IF
}

//FUNCION COMPRUEBA LA FECHA DE INSCRIPCION
function CompruebaFechaInscripcion($conex, $id_prueba ){
    $SqlActualiza = "SELECT id_prueba,fecha_inscripcion_prueba,id_estado_prueba FROM prueba WHERE id_prueba ='".$id_prueba."'";
    
    $LosDatos=$conex->query($SqlActualiza);        

    if($LosDatos->num_rows > 0){
        $datos = $LosDatos->fetch_assoc();                   
            date_default_timezone_set('America/Bogota');
            $fecha_actual = date("Y-m-d");
            $fecha_inscripcion = $datos['fecha_inscripcion_prueba'];
            $estadoPrueba = $datos['id_estado_prueba'];            
            
            if (strtotime($fecha_inscripcion) >= strtotime($fecha_actual) )
            {                
                return "true";
            }           
            else{
                return "false";
            }        
    } // fin IF
}

//require './../../conex.php';
//FUNCION QUE ME MUESTRA TODAS LAS PRUEBAS ACTIVAS
function pruebasActive($conex){   
    $sql = "SELECT * 
    FROM prueba, estado_prueba, sede, periodo

    WHERE         
    prueba.id_sede = sede.id_sede AND
    prueba.id_periodo = periodo.id_periodo AND
    prueba.id_estado_prueba = estado_prueba.id_estado_prueba AND

    (prueba.id_estado_prueba = '2' OR
    prueba.id_estado_prueba = '3')
    ";
    
    $result = $conex->query($sql);

    if ($result->num_rows > 0) { 
        while($row = $result->fetch_array())
            {
                $rows[] = $row;
            };       
    return $rows;
    }
    else{
        return false;
    };

    $conex->close();
}; // fin


//FUNCION QUE EXTRAE LA FECHA Y HORA ACTUAL DEL SERVIDOR
function ObtenerDateTime(){
    date_default_timezone_set('America/Bogota');
    $Date = date("Y-m-d H:i:s");
    list($fecha, $hora) = explode(" ",$Date);
    $arrayDate = array("date"=>$Date, "fecha"=>$fecha, "hora"=>$hora);
    return $arrayDate;
}; //fin

//FUNCION DE CONSULTAR CUANTOS CUPOS HAY Y SI HAY DISPONIBLES SUMAR UNO
function CuposGrupos($idGr, $conex){
    $idGrupo = $idGr;

    $CuposEnGrupo = "SELECT cupos_ofrecidos_grupo, total_inscritos_grupo FROM grupo WHERE id_grupo='".$idGrupo."'";

    $resultSQL = $conex->query($CuposEnGrupo);

    if($resultSQL->num_rows > 0){
        $datos = $resultSQL->fetch_assoc();        
        
        $ofrecidos = $datos['cupos_ofrecidos_grupo'];
        $inscritos = $datos['total_inscritos_grupo'];            
        
        if($inscritos < $ofrecidos) {           
            $SqlAumenta = "UPDATE grupo
            SET total_inscritos_grupo=".($inscritos + 1)."
            WHERE id_grupo='".$idGrupo."'";
            $EjecutaAumento = $conex->query($SqlAumenta); 
                if($EjecutaAumento == true){                          
                    return true;
                }            
        }
        else{
            return false;
        }
    };
}; //FIN


//FUNCION DE CONSULTAR CUANTOS CUPOS HAY EN GRUPO
function NumCuposGrupo($idGr, $conex){
    $idGrupo = $idGr;

    $CuposEnGrupo = "SELECT cupos_ofrecidos_grupo, total_inscritos_grupo FROM grupo WHERE id_grupo='".$idGrupo."'";

    $resultSQL = $conex->query($CuposEnGrupo);

    if($resultSQL->num_rows > 0){
        $datos = $resultSQL->fetch_assoc();        
        
        $ofrecidos = $datos['cupos_ofrecidos_grupo'];
        $inscritos = $datos['total_inscritos_grupo'];            
        
        if($inscritos == $ofrecidos) { 
            return false;                          
        }
        else{
            return true;
        }
    };
}; //FIN


//FUNCION CONSULTA SI EL ESTUDIANTE YA ESTA INSCRITO
function EstudianteInscrito($cod, $conex){    
    //$codigo = intval($cod);
    $SqlInscritoEstu = "SELECT * FROM inscripcion_prueba WHERE cod_estudiante = '".$cod."'";
    
    $ResultSql = $conex->query($SqlInscritoEstu); 
    
        if($ResultSql->num_rows > 0){            
            $datos = $ResultSql->fetch_assoc();
            $ArrayResult = array("bandera"=> true, "data"=>$datos);
            return $ArrayResult;
        }
        else{
            $ArrayResult = array("bandera"=> false);
            return $ArrayResult;
        }
        
   
};


//FUNCION MUESTRA TODOS LOS DATOS DE INSCRIPCION, GRUPOS Y PRUEBAS
function FullDatosInsctipcion($idGr, $conex){

    $SqlUsuIns = "SELECT prueba.id_prueba, prueba.prueba, prueba.id_estado_prueba, estado_prueba.estado_prueba, estado_prueba.bgcolor_estado_prueba, sede.sede, periodo.periodo, periodo.year_periodo, grupo.grupo, prueba.fecha_aplicacion_prueba, grupo.horario_grupo, grupo.aula_grupo, sede.lugar_sede FROM grupo, prueba, periodo,sede, estado_prueba WHERE grupo.id_grupo = '".$idGr."' AND grupo.id_prueba = prueba.id_prueba AND prueba.id_sede = sede.id_sede AND prueba.id_periodo = periodo.id_periodo AND prueba.id_estado_prueba = estado_prueba.id_estado_prueba";

    $resultSQL = $conex->query($SqlUsuIns);

    if($resultSQL->num_rows > 0){
        $datos = $resultSQL->fetch_assoc(); 
        return $datos;
    }

}

//FUNCION QUE ME DETERMINA LA IP DE DONDE SE ESTA CONECTADO EL USUARIO
function ObtenerIpConex(){
    if (getenv('HTTP_CLIENT_IP')) {
        $ip = getenv('HTTP_CLIENT_IP');
    } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    } elseif (getenv('HTTP_X_FORWARDED')) {
        $ip = getenv('HTTP_X_FORWARDED');
    } elseif (getenv('HTTP_FORWARDED_FOR')) {
        $ip = getenv('HTTP_FORWARDED_FOR');
    } elseif (getenv('HTTP_FORWARDED')) {
        $ip = getenv('HTTP_FORWARDED');
    } else {
        // Método por defecto de obtener la IP del usuario
        // Si se utiliza un proxy, esto nos daría la IP del proxy
        // y no la IP real del usuario.
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

//FUNCION QUE ME RETORNA UN ARRAY DE LOS PROGRAMAS POR SEDE
function ProgramasXsede($conex, $id_sede){
    $SqlProgramas = "SELECT id_programa, programa FROM programa WHERE id_sede = '".$id_sede."' ORDER BY programa ASC";
    $ResultSql = $conex->query($SqlProgramas);
    $Programa = array();
    while($data = $ResultSql->fetch_assoc()){
        $Programa[] = $data;
    }
    return $Programa;
}


//FUNCION QUE OBTIENE LA COMPETENCIA DE LA PREGUNTA 
function ObtenerCompetenciaPrg($IdPrg, $conex){
    $SqlCompe = "SELECT competencia.id_competencia, competencia.competencia, evidencia.evidencia, tarea.tarea, competencia.afirmacion_competencia FROM competencia, evidencia, tarea, pregunta WHERE pregunta.id_pregunta='".$IdPrg."' AND pregunta.id_tarea = tarea.id_tarea AND tarea.id_evidencia = evidencia.id_evidencia AND evidencia.id_competencia = competencia.id_competencia";

    $resultSQL = $conex->query($SqlCompe);    
    $datos = $resultSQL->fetch_assoc();  
    //Retorna -> id_competencia y ->competencia -> evidencia y -> tarea
    return $datos;
}; //FIN

//FUNCION QUE ME OBTIENE TODAS LAS RESPUESTAS DE UNA PREGUNTA 
function ObtenerOpcionesRespuestas($IdPrg, $conex){
    $SqlRespuestas = "SELECT opcion_respuesta.* FROM opcion_respuesta, pregunta WHERE opcion_respuesta.id_pregunta = pregunta.id_pregunta AND opcion_respuesta.id_pregunta = '".$IdPrg."'";
    
    $ResultSql = $conex->query($SqlRespuestas);

    while($datos =  $ResultSql->fetch_assoc()){
        $datosArray[] = (array("id_opcion_respuesta"=>$datos['id_opcion_respuesta'],"id_pregunta"=>$datos['id_pregunta'], "opcion_respuesta"=>$datos['opcion_respuesta'], "peso_opcion_respuesta"=>$datos['peso_opcion_respuesta'], "puntaje_opcion_respuesta"=>$datos['puntaje_opcion_respuesta']));
    };

    return $datosArray;
}

//FUNCION QUE OBTIENE EL ID DE  COMPETENCIA EVIDENCIA Y TAREA DE LA PREGUNTA 
function ObtenerICETprg($IdPrg, $conex){
    $SqlCompe = "SELECT competencia.id_competencia, evidencia.id_evidencia, tarea.id_tarea FROM competencia, evidencia, tarea, pregunta WHERE pregunta.id_pregunta='".$IdPrg."' AND pregunta.id_tarea = tarea.id_tarea AND tarea.id_evidencia = evidencia.id_evidencia AND evidencia.id_competencia = competencia.id_competencia";

    $resultSQL = $conex->query($SqlCompe);    
    $datos = $resultSQL->fetch_assoc();  
    //Retorna -> id_competencia y ->competencia -> evidencia y -> tarea
    return $datos;
}; //FIN

//FUNCION QUE ME OBTIENE TODOS LOS DATOS DE LA PREGUNTA
function PreguntaAll($idPrg, $conex){
    $SqlPregunta = "SELECT * FROM pregunta  WHERE id_pregunta = '".$idPrg."'";
    $ResultSQl = $conex->query($SqlPregunta);
    $datos = $ResultSQl->fetch_assoc();
    return $datos;
};

// GENERA ARRAY DE PREGUNTAS ALETARORIAS DE UNA COMPETENCIA
function PreguntasDeCompetencia($idComp, $num_preg, $conex, $ArraySave, $cuesSave){

    $datosArray = array();
    

    if($num_preg > 0 && $cuesSave == 0 && count($ArraySave) > 0 ){
        $StringIdes = "";
        for($i=0; $i < count($ArraySave); $i++){
            $IdsSaveds[] = $ArraySave[$i]['id_pregunta'];
        }
        $StringIdes = implode(",", $IdsSaveds);
        $Norepite = "(".$StringIdes.")";

        $SqlPreguntas = "SELECT pregunta.* FROM pregunta, tarea, evidencia, competencia  WHERE pregunta.id_tarea = tarea.id_tarea AND tarea.id_evidencia = evidencia.id_evidencia AND evidencia.id_competencia = competencia.id_competencia AND pregunta.id_estado_pregunta = '4' AND competencia.id_competencia = '".$idComp."' AND pregunta.id_pregunta NOT IN ".$Norepite." ORDER BY RAND() LIMIT ".$num_preg;
        $ResultSQl = $conex->query($SqlPreguntas);
    }
    else {
        $SqlPreguntas = "SELECT pregunta.* FROM pregunta, tarea, evidencia, competencia  WHERE pregunta.id_tarea = tarea.id_tarea AND tarea.id_evidencia = evidencia.id_evidencia AND evidencia.id_competencia = competencia.id_competencia AND pregunta.id_estado_pregunta = '4' AND competencia.id_competencia = '".$idComp."' ORDER BY RAND() LIMIT ".$num_preg;
        $ResultSQl = $conex->query($SqlPreguntas);        
    }


    while($datos =  $ResultSQl->fetch_assoc()){
        $datosArray[] = (array("id_pregunta"=>$datos['id_pregunta'],"cod_pregunta"=>$datos['cod_pregunta'], "enunciado_pregunta"=>$datos['enunciado_pregunta'], "id_estado_pregunta"=>$datos['id_estado_pregunta']));
    };

    return $datosArray;

    
}

// FUNCION QUE ME DEVUELVE EL No DE INTENO DEL CUESTIONARIO

function IntenoStudent($conex, $cod_estu){
    $SqlIntento = "SELECT * FROM cuestionario, estado_cuestionario WHERE cuestionario.cod_estudiante = '".$cod_estu."' AND cuestionario.id_estado_cuestionario = estado_cuestionario.id_estado_cuestionario ORDER BY cuestionario.fecha_creacion_cuestionario DESC";
    $resultSQL = $conex->query($SqlIntento);    
    $datos =  $resultSQL->fetch_assoc() ;
    return $datos;
}


function VerificacionHorarioGrupo($id_estado_prueba,$horario_grupo){
    if($id_estado_prueba == 3){
                                
        $hora = new DateTime("now", new DateTimeZone('America/Bogota'));
        $hora_actual = date_format($hora, 'G');
        
        if ($horario_grupo == "8:00 a 10:00")
        {
            // hora de inicio
            $hora_inicio = 8;
            // hora de finalizacion
            $hora_final = 9;
        }
        if ($horario_grupo == "10:00 a 12:00")
        {
            // hora de inicio
            $hora_inicio = 10;
            // hora de finalizacion
            $hora_final = 11;
        }
        if ($horario_grupo == "2:00 a 4:00")
        {
            // hora de inicio
            $hora_inicio = 14;
            // hora de finalizacion
            $hora_final = 15;
        }
        if ($horario_grupo == "4:00 a 6:00")
        {
            // hora de inicio
            $hora_inicio = 16;
            // hora de finalizacion
            $hora_final = 17;
        }
        
        if( $hora_actual >=  $hora_inicio  &&  $hora_actual <= $hora_final ){
            $ResponseTime = array("bandera"=>true,"ResTex"=>"Puedes resolver la prueba");
            return  $ResponseTime;
        }
        else{
            //Es el dia pero no la hora
            $ResponseTime = array("bandera"=>false,"ResTex"=>"Es el día pero no el momento oportuno");
            return  $ResponseTime;
        }

    }
    else{
        $ResponseTime = array("bandera"=>false,"ResTex"=>"No puedes resolver la prueba");
        return  $ResponseTime;                      
     }
}


///DATOS DEL ESTUDIANTE FULL ESTUDIANTE Y PROGRAMA
function DatosEstudianteFull($conex, $cod_estu){
    $Sqldata = "SELECT * FROM estudiante, programa WHERE cod_estudiante = '".$cod_estu."'";
    $resultSQL = $conex->query($Sqldata);    
    $datos = $resultSQL->fetch_assoc();      
    return $datos;
}


///DATOS DEL ESTUDIANTE RECARGADO
function DatosEstudiantesReload($conex,$cod_estu){
    $Sqldata = "SELECT * FROM estudiante WHERE cod_estudiante = '".$cod_estu."'";
    $resultSQL = $conex->query($Sqldata);    
    $datos = $resultSQL->fetch_assoc();      
    return $datos;
}

function NuevoCuestionario($conex, $arrayData){

    $NoCuesti = $conex->query("SELECT COUNT(*) FROM cuestionario WHERE cod_estudiante = '".$arrayData['cod_estudiante']."' ");
    $intentos = $NoCuesti->fetch_row();   
    $NoInte = $intentos[0] + 1;

    $sqlCuest = "INSERT INTO cuestionario (id_inscripcion_prueba, cod_estudiante, fecha_creacion_cuestionario, id_estado_cuestionario, inicio_cuestionario, ip_estudiante, accede_cuestionario, intento ) VALUES('".$arrayData['id_inscripcion']."','".$arrayData['cod_estudiante']."','".$arrayData['creacion_cuestionario']."','".$arrayData['estado_cuestionario']."','".$arrayData['inicio_cuestionario']."','".$arrayData['ip_estudiante']."','".$arrayData['accede_cuestionario']."','".$NoInte."')";
    
        
    $EjecutaCreacion = $conex->query($sqlCuest);   

    if($EjecutaCreacion == true){ 
        $restext = "Se creo correctamente el cuestionario";           
        $res = 'true';
    }
    else{  
        $restext = "Hubo un problema crear el cuestionario, sus respuestas no seran guardadas!";
        $res = 'false'; 
    }//fin del else inscripcion

    $result = array("res"=> $res ,"ResTex" => $restext);
    return $result;
}

function RecoveryRespuSave($conex, $id_cuestionario, $cod_estu){
    //consulta para ver las respuestas guardadas
    $SqlRespuSend = "SELECT * FROM rta_enviada_estudiante WHERE id_cuestionario = '".$id_cuestionario."' AND cod_estudiante = '".$cod_estu."'";

    $ResultSql_1 = $conex->query($SqlRespuSend);

    $data1Array = array();

    while($data1 = $ResultSql_1->fetch_assoc()){
        $data1Array[] = array(
            "id_rta_enviada" => $data1['id_rta_enviada_estudiante'],
            "id_cuestionario" => $data1['id_cuestionario'],            
            "cod_estudiante" => $data1['cod_estudiante'],
            "id_pregunta" => $data1['id_pregunta'],
            "id_opc_respuesta" => $data1['id_opcion_respuesta'],
            "fecha_opc_respuesta" => $data1['fecha_rta_enviada'],
            "ip_estudiante" => $data1['ip_estudiante'],
            "id_estado_rta_enviada" => $data1['id_estado_rta_enviada']            
        );
    }      

    return $data1Array;
}

function PreguntasGuardadasXCompe($conex, $arrayS, $id_compe){
    $datosArray  = array();
    for($i = 0; $i < count($arrayS); $i++){

        $compePrg = ObtenerCompetenciaPrg($arrayS[$i]['id_pregunta'], $conex);
        $FullDataPrg = PreguntaAll($arrayS[$i]['id_pregunta'], $conex);

        if($compePrg['id_competencia'] == $id_compe){       

            $datosArray[] = (array("id_pregunta"=>$FullDataPrg['id_pregunta'],"cod_pregunta"=>$FullDataPrg['cod_pregunta'], "enunciado_pregunta"=>$FullDataPrg['enunciado_pregunta'], "id_estado_pregunta"=>$FullDataPrg['id_estado_pregunta'],"id_opcion_respuesta"=>$arrayS[$i]['id_opc_respuesta']));
        }   
    
    }
    return $datosArray;    
}


//FUNCION QUE ME OBTIENE EL ID DE LA PREGUNTA A PARTIR DE UNA OPCION DE RESPUESTA
function IdPreDeOPR($idOpRes, $conex){
    $SqlIdPrg = "SELECT id_pregunta FROM opcion_respuesta WHERE id_opcion_respuesta = '".$idOpRes."'";
    $ResultSQl = $conex->query($SqlIdPrg);
    
    $fila = $ResultSQl->fetch_row();
    return $fila[0];
};


//FUNCION QUE ME ACTULIZA EL CUESTIONARIO COMO FINALIZADO O COMO NO RESUELTO O COMO SIN TERMINAR
// 1 Inactivo - 2 Activo - 3- En curso - 4 Finalizado - 5 Vencido - 6 No presentado

function UpdateCuestion($idCuestion, $estadoCues, $cod_estu, $fecha, $conex){    

    $sqlUpdate = "UPDATE cuestionario SET id_estado_cuestionario = '".$estadoCues."', fin_cuestionario = '".$fecha."', accede_cuestionario = '0' WHERE cuestionario.id_cuestionario = '".$idCuestion."' AND cuestionario.cod_estudiante = '".$cod_estu."'";
        
    $EjecutaQuery = $conex->query($sqlUpdate);   

    if($EjecutaQuery == true){ 
        $restext = "El cuestionario se actualizó correctamente";
        $respuesta = true; 
    }
    else{  
        $restext = "Hubo un problema al actualizar el cuestionario";
        $respuesta = false; 
    }

    $datos = array("res"=>$respuesta,"restext"=>$restext); 

    return $datos;
};

// FUNCION QUE ACTUALIZA AL ESTUDIANTE Y SU INTENTO DE RESOLVER LA PRUEBA
function UpdateEstudianteFin($cod_estu, $conex){    

    $sqlUpdateEs = "UPDATE estudiante SET realizo_prueba = '1', estudiante_habilitado = '0' WHERE estudiante.cod_estudiante = '".$cod_estu."'";
        
    $EjecutaQuery = $conex->query($sqlUpdateEs);   

    if($EjecutaQuery == true){ 
        $restext = "El estudiante fue actualizado correctamente";
        $respuesta = true; 
    }
    else{  
        $restext = "Hubo un problema al actualizar el estudiante";
        $respuesta = false; 
    }

    $datos = array("res"=>$respuesta,"restext"=>$restext); 

    return $datos;
};

//FUNCION QUE ME CALCULA  EL RESUMEN DEL RESULTADO 
function SaveResultCuestionario( $cod_estudiante, $id_cuestionario, $conex ){
    
    $SqlData = "SELECT rta_enviada_estudiante.cod_estudiante, rta_enviada_estudiante.id_cuestionario, competencia.id_competencia, competencia.peso_competencia, rta_enviada_estudiante.id_pregunta,  rta_enviada_estudiante.id_opcion_respuesta, opcion_respuesta.peso_opcion_respuesta, opcion_respuesta.puntaje_opcion_respuesta FROM rta_enviada_estudiante, opcion_respuesta, pregunta, tarea, evidencia, competencia WHERE rta_enviada_estudiante.id_opcion_respuesta = opcion_respuesta.id_opcion_respuesta AND pregunta.id_tarea = tarea.id_tarea AND tarea.id_evidencia = evidencia.id_evidencia AND evidencia.id_competencia = competencia.id_competencia AND rta_enviada_estudiante.id_pregunta = pregunta.id_pregunta AND rta_enviada_estudiante.cod_estudiante = '".$cod_estudiante."' AND rta_enviada_estudiante.id_cuestionario = '".$id_cuestionario."' ORDER BY competencia.id_competencia ASC";

    $ResultSql = $conex->query($SqlData);   
    
    $PuntajeFinal = 0;
    $PuntajeC1 = 0;
    $PuntajeC2 = 0;
    $PuntajeC3 = 0;
    $PuntajeC4 = 0;

    while($datos =  $ResultSql->fetch_assoc()){    
        
        $DataResul[] = array($datos);

        $PuntajeFinal += $datos['puntaje_opcion_respuesta'];

        if($datos['id_competencia'] == '1'){
            $PuntajeC1 += $datos['puntaje_opcion_respuesta'];
        }
        else if($datos['id_competencia'] == '2'){
            $PuntajeC2 += $datos['puntaje_opcion_respuesta'];
        }
        else if($datos['id_competencia'] == '3'){
            $PuntajeC3 += $datos['puntaje_opcion_respuesta'];
        }
        else if($datos['id_competencia'] == '4'){
            $PuntajeC4 += $datos['puntaje_opcion_respuesta'];
        }
    };

    $pesoC1 =  ($PuntajeC1*20)/1;
    $pesoC2 =  ($PuntajeC2*13.34)/0.8;
    $pesoC3 =  ($PuntajeC3*33.33)/1.6;
    $pesoC4 =  ($PuntajeC4*33.33)/1.6;
    $pesoTotal =  $pesoC1+$pesoC2+$pesoC3+$pesoC4;

    $ResCues = array(
        "puntaje_final"=>number_format($PuntajeFinal,2),
        "peso_final"=>number_format($pesoTotal,2),
        "puntaje_c1"=>number_format($PuntajeC1,2),
        "peso_c1"=>number_format($pesoC1,2),
        "puntaje_c2"=>number_format($PuntajeC2,2),
        "peso_c2"=>number_format($pesoC2,2),
        "puntaje_c3"=>number_format($PuntajeC3,2),
        "peso_c3"=>number_format($pesoC3,2),
        "puntaje_c4"=>number_format($PuntajeC4,2),
        "peso_c4"=>number_format($pesoC4,2),
        "datos"=> $DataResul
    ); 

    return $ResCues;
}

//FUNCION QUE ME GUARDA LOS RESULTADOS DE UN CUESTIONARIO
function NewResultCues($ArrayResult, $cod_estudiante, $id_cuestionario, $conex){
    $SqlNewResul = "INSERT INTO resultado_cuestionario (id_cuestionario, cod_estudiante, puntaje_final, porcentaje_final, puntaje_c1, porcentaje_c1, puntaje_c2, porcentaje_c2, puntaje_c3, porcentaje_c3, puntaje_c4, porcentaje_c4) VALUES ('".$id_cuestionario."', '".$cod_estudiante."', '".$ArrayResult['puntaje_final']."', '".$ArrayResult['peso_final']."', '".$ArrayResult['puntaje_c1']."', '".$ArrayResult['peso_c1']."', '".$ArrayResult['puntaje_c2']."', '".$ArrayResult['peso_c2']."', '".$ArrayResult['puntaje_c3']."', '".$ArrayResult['peso_c3']."', '".$ArrayResult['puntaje_c4']."', '".$ArrayResult['peso_c4']."')";
    
        
    $ResultSql = $conex->query($SqlNewResul);   

    if($ResultSql == true){ 
        $restext = "Se guardaron correctamente los resultados del cuestionario";           
        $res = 'true';
    }
    else{  
        $restext = "Hubo un problema al guardar los resultados del cuestionario!";
        $res = 'false'; 
    }//fin del else inscripcion

    $result = array("res"=> $res ,"ResTex" => $restext);
    return $result;
}

//FUNCION CONSULTA  TODOS LOS DATOS DE LA INSCRIPCION
function EstudianteFullCuestionario($id_inscripcion, $cod_estudiante, $conex){    
    $SqlFullCuest = "SELECT * FROM cuestionario,estado_cuestionario WHERE cuestionario.cod_estudiante= '".$cod_estudiante."' AND cuestionario.id_inscripcion_prueba = '".$id_inscripcion."' AND cuestionario.id_estado_cuestionario = estado_cuestionario.id_estado_cuestionario";
    
    $ResultSql = $conex->query($SqlFullCuest); 
        if($ResultSql->num_rows > 0){            
            $datos = $ResultSql->fetch_assoc();
            return $datos;
        }
        else{
            $ArrayResult = array("bandera"=> false);
            return $ArrayResult;
        }
};


function get_format($df) {

    $str = '';
    $str .= ($df->invert == 1) ? ' - ' : '';
    if ($df->y > 0) {
        // years
        $str .= ($df->y > 1) ? $df->y . ' Years ' : $df->y . ' Year ';
    } if ($df->m > 0) {
        // month
        $str .= ($df->m > 1) ? $df->m . ' Months ' : $df->m . ' Month ';
    } if ($df->d > 0) {
        // days
        $str .= ($df->d > 1) ? $df->d . ' Days ' : $df->d . ' Day ';
    } if ($df->h > 0) {
        // hours
        $str .= ($df->h > 1) ? $df->h . ' Hours ' : $df->h . ' Hour ';
    } if ($df->i > 0) {
        // minutes
        $str .= ($df->i > 1) ? $df->i . ' Minutes ' : $df->i . ' Minute ';
    } if ($df->s > 0) {
        // seconds
        $str .= ($df->s > 1) ? $df->s . ' Seconds ' : $df->s . ' Second ';
    }

    return $str;
}

//MOSTRAR DATOS FULL INSCRIPION DE UN ESTUDIANTE
function FullDataInscEstu($conex, $cod) {
    $SqlInfoInsc = "SELECT * FROM 
    inscripcion_prueba, grupo, prueba, periodo, sede, estado_prueba WHERE 
    inscripcion_prueba.cod_estudiante = '".$cod."' AND 
    inscripcion_prueba.id_grupo = grupo.id_grupo AND 
    grupo.id_prueba = prueba.id_prueba AND 
    prueba.id_periodo = periodo.id_periodo AND 
    prueba.id_sede = sede.id_sede AND
    prueba.id_estado_prueba = estado_prueba.id_estado_prueba";
    
    $ResultInfo = $conex->query($SqlInfoInsc);
   
    $dataEsInfo = $ResultInfo->fetch_array();      

    return $dataEsInfo;
}


//MOSTRAR DATOS FULL INSCRIPION DE UN ESTUDIANTE
function FullDataResulCuestEstu($conex, $cod) {
    $SqlInfoInsc = "SELECT * FROM 
    cuestionario, estado_cuestionario, resultado_cuestionario WHERE 
    cuestionario.cod_estudiante = '".$cod."' AND 
    cuestionario.id_estado_cuestionario = estado_cuestionario.id_estado_cuestionario AND 
    resultado_cuestionario.id_cuestionario = cuestionario.id_cuestionario ORDER BY cuestionario.id_cuestionario DESC";
    
    $ResultInfo = $conex->query($SqlInfoInsc);
   
    $dataEsInfo = $ResultInfo->fetch_array();      

    return $dataEsInfo;
}



//MOSTRAR DATOS FULL INSCRIPION DE UN ESTUDIANTE
function EstudianteRealizoPrueba($conex, $codigo) {
    $SqlInfoInsc = "SELECT realizo_prueba FROM estudiante WHERE 
    cod_estudiante = '".$codigo."' ";
    
    $ResultInfo = $conex->query($SqlInfoInsc);
   
    $dataEsInfo = $ResultInfo->fetch_array();      

    return $dataEsInfo;
}


function decodificar_quest($quest){
    $rwemplaz = "";
    $rwemplaz= str_replace("â€œ", '"', $quest ); 
    $rwemplaz= str_replace("â€", '"', $rwemplaz ); 
    $rwemplaz= str_replace("", '', $rwemplaz ); 
    $rwemplaz= str_replace("&nbsp;", ' ', $rwemplaz ); 
    $vaar =  ( html_entity_decode ( $rwemplaz , ENT_HTML5, 'UTF-8'));
    $vaar = utf8_decode ( $vaar ); 
    return $vaar;
}


function checkReslut ( $conex , $estudiante ) {
    $EstudianteResultados = "SELECT * FROM resultado_cuestionario WHERE cod_estudiante = '".$estudiante."' ORDER BY id_cuestionario DESC";
    $resutlSql = $conex->query($EstudianteResultados);
    if( $resutlSql->num_rows > 0 ){ 
        $res = TRUE;
        $datosCues = $resutlSql->fetch_assoc();   
    }
    else {
        $res = FALSE;
        $datosCues = NULL;   
    }

    $result = array("result"=> $res ,"data" => $datosCues);
    return $result;
}

?>
