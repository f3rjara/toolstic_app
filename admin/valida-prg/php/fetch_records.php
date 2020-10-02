<?php
//FUNCION QUE EXTRAE LA FECHA Y HORA ACTUAL DEL SERVIDOR
function ObtenerDateTime(){
    date_default_timezone_set('America/Bogota');
    $Date = date("Y-m-d H:i:s");
    list($fecha, $hora) = explode(" ",$Date);
    $arrayDate = array("date"=>$Date, "fecha"=>$fecha, "hora"=>$hora);
    return $arrayDate;
}; //fin



//FUNCION QUE mME GENERA EL FORMATO CORRSPONIDENTE LA FECHA Y HORA ENVIADA
function ObtenerFormatoFechaHora($Date){
    date_default_timezone_set('America/Bogota'); 
    list($fecha, $hora) = explode(" ",$Date);

    $FO_Fecha = strftime("%d de %b del %Y",strtotime($fecha));
    $FO_Hora = strftime("%I:%M %p",strtotime($hora));

    $arrayFF = array("FO_Fecha"=>$FO_Fecha, "FO_Hora"=>$FO_Hora);
    return $arrayFF;
}


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


//FUNCION QUE ME GENERA EL CÓDIGO CORRESPONDIENTE A LA PREGUNTA CREADA
function GenerarCodPrg($idTarea, $conex){
    $contarPrgTare = "SELECT COUNT(*) AS numPrg, tarea.cod_tarea FROM pregunta, tarea WHERE tarea.id_tarea = '".$idTarea."' AND pregunta.id_tarea = tarea.id_tarea"; 
    $resultSQL = $conex->query($contarPrgTare);    
    $datos = $resultSQL->fetch_assoc();  
    $cod = $datos['cod_tarea'];
    $num = $datos['numPrg']+1;       
    $codigoPrg = $cod."P".$num;
    return $codigoPrg;
}; //FIN

//FUNCION QUE OBTIENE EL ID DE LA PREGUNTA CREADA
function ObtenerIdPrgCreada($date, $creador, $conex){
    $SqlId = "SELECT id_pregunta FROM pregunta WHERE fecha_creacion_pregunta = '".$date."' AND creador_pregunta = '".$creador."'";

    $resultSQL = $conex->query($SqlId);    
    $datos = $resultSQL->fetch_assoc();  
    $idPrg = $datos['id_pregunta'];
    return $idPrg;
}; //FIN


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

//FUNCION QUE ME OBTIENE TODOS LOS DATOS DE UN USUARIO
function UserFullData($idUser, $conex){
    $SqlUser = "SELECT * FROM usuario  WHERE id_usuario = '".$idUser."'";
    $ResultSQl = $conex->query($SqlUser);
    $datos = $ResultSQl->fetch_assoc();
    return $datos;
};

//FUNCION QUE ME OBTIENE full datos  DE LA PREGUNTA
function PreguntaFullAll($idPrg, $conex){
    $SqlPregunta = "SELECT * FROM pregunta, estado_pregunta, usuario WHERE pregunta.id_estado_pregunta = estado_pregunta.id_estado_pregunta AND pregunta.creador_pregunta = usuario.id_usuario AND pregunta.id_pregunta = '".$idPrg."'";
    $ResultSQl = $conex->query($SqlPregunta);
    $datos = $ResultSQl->fetch_assoc();
    return $datos;
};


//FUNCION QUE ME OBTIENE LAS PREGUNTAS QUE NO HAN SIDO ASIGNADAS Y SU ESTADO ES SIN VALIDAR O EDITAS POR COMPETENCIA DADA
function PreguntasSinAsignar($idComp, $conex){
    $SqlPreguntaSA ="SELECT pregunta.id_pregunta, pregunta.cod_pregunta, usuario.nombres_usuario, usuario.apellidos_usuario, pregunta.fecha_creacion_pregunta, estado_pregunta.estado_pregunta FROM pregunta, estado_pregunta, usuario WHERE (pregunta.id_estado_pregunta = '1' OR pregunta.id_estado_pregunta = '5') AND pregunta.pregunta_asignada = '0' AND pregunta.id_estado_pregunta = estado_pregunta.id_estado_pregunta AND pregunta.creador_pregunta = usuario.id_usuario ORDER BY pregunta.fecha_creacion_pregunta ASC";
    $SqlResult = $conex->query($SqlPreguntaSA);
    $data = array();
    if($SqlResult->num_rows > 0){
        while($dataPrg = $SqlResult->fetch_assoc()){
            $id_comp = ObtenerCompetenciaPrg($dataPrg['id_pregunta'], $conex);
            if($id_comp['id_competencia'] == $idComp ){
                $data [] = $dataPrg;
             }           
        }
    }
    return $data;
}


//LISTADO DE USUARIOS EXPERTOS TEMATICOS
function ListDocentesET($conex){
    $SqlDocentesET = "SELECT id_usuario, nombres_usuario, apellidos_usuario FROM usuario WHERE id_tipo_usuario = '3'";
    $ResultSql = $conex->query($SqlDocentesET);
    $data = array();
    if($ResultSql->num_rows > 0) {
        while($DataResult = $ResultSql->fetch_assoc()){
            $data[]= $DataResult;
        }
    }
    return $data;
}


//DATOS DE UN USUARIO EXPERTOS TEMATICOS
function DataDocentesET($conex, $id_docente){
    $SqlDocentesET = "SELECT id_usuario, nombres_usuario, apellidos_usuario FROM usuario WHERE id_tipo_usuario = '3' AND id_usuario = '".$id_docente."'";
    $ResultSql = $conex->query($SqlDocentesET);
    $data = array();
    if($ResultSql->num_rows > 0) {
        while($DataResult = $ResultSql->fetch_assoc()){
            $data[]= $DataResult;
        }
    }
    return $data;
}


//OBTENER PREGUNTAS ASIGNAS A UN USUARIO
function PreguntasAsignadasList($Id_docente,$conex){
    $SqlPreAsiDoce = "SELECT * FROM pregunta, usuario, estado_pregunta WHERE pregunta.validador_pregunta = '".$Id_docente."' AND pregunta.validador_pregunta = usuario.id_usuario AND pregunta.id_estado_pregunta = estado_pregunta.id_estado_pregunta AND pregunta.id_estado_pregunta != '6' ORDER BY pregunta.id_estado_pregunta DESC, pregunta.id_pregunta DESC ";
    $ResultSql = $conex->query($SqlPreAsiDoce);
    $data =array();
    if($ResultSql->num_rows > 0){
        while($DatosArray = $ResultSql->fetch_assoc()){
            $data[] = $DatosArray;
        }
    }
    return $data;
}


//FUNCION QUE TOTALES DE PREGUNTAS EN GENERAL
function TotalesPrgToolsTIC($conex){
    $SqlTotal = "SELECT COUNT(*) AS TOTAL FROM pregunta";
    $resultSQL = $conex->query($SqlTotal);        
    $data = array();
    
    if($resultSQL->num_rows > 0) {
        
        $TotalPreT = $resultSQL->fetch_assoc(); 
        

        
        
        $TotalPreVyA = 0;
        $TotalPreAySV = 0;
        $TotalPreNoAc = 0;

        
        //total de preguntas validadas y aceptadas
        $SqlTotalVyA = "SELECT COUNT(*) AS TOTALVyA FROM pregunta WHERE id_estado_pregunta = '4' OR id_estado_pregunta = '3'";
        $resultSQLVyA = $conex->query($SqlTotalVyA); 
        if($resultSQLVyA->num_rows > 0) {
            $TotalVyA = $resultSQLVyA->fetch_assoc(); 
            $TotalPreVyA = intval($TotalVyA['TOTALVyA']);
        }
        
        //total de preguntas ASIGNADA Y SIN VALIDAR
        $SqlTotalAySV = "SELECT COUNT(*) AS TOTALAySV FROM pregunta WHERE id_estado_pregunta = '1' OR id_estado_pregunta = '7' OR id_estado_pregunta = '5'";
        $resultSQLAySV = $conex->query($SqlTotalAySV); 
        if($resultSQLAySV->num_rows > 0) {
            $TotalAySV = $resultSQLAySV->fetch_assoc(); 
            $TotalPreAySV = intval($TotalAySV['TOTALAySV']);
        }

        //total de preguntas NO aceptadas
        $SqlTotalNoAc = "SELECT COUNT(*) AS TOTALNoAc FROM pregunta WHERE id_estado_pregunta = '2'";
        $resultSQLNoAc = $conex->query($SqlTotalNoAc); 
        if($resultSQLNoAc->num_rows > 0) {
            $TotalNoAc = $resultSQLNoAc->fetch_assoc(); 
            $TotalPreNoAc = intval($TotalNoAc['TOTALNoAc']);
        }

        $data[] = array("bandera" => 'true', "TotalPre" => intval($TotalPreT['TOTAL']), "TotalPreVyA"=> $TotalPreVyA, "TotalPreAySV" => $TotalPreAySV, "TotalPreNoAc" => $TotalPreNoAc);
        }
    
    else{
        $data[] = array("bandera" => 'false');
    }

    return $data;
} //FIN


//FUNCION QUE TOTALES DE PREGUNTAS DE UN DOCENTE 
function TotalesMisPrg($conex, $id_usuario){
    $SqlTotal = "SELECT COUNT(*) AS TOTAL FROM pregunta  WHERE creador_pregunta = '".$id_usuario."'";
    $resultSQL = $conex->query($SqlTotal);        
    $data = array();
    
    if($resultSQL->num_rows > 0 ) {        
        $TotalPreT = $resultSQL->fetch_assoc();        
       

        $TotalPreVyA = 0;
        $TotalPreAySV = 0;
        $TotalPreNoAc = 0;

        
        //total de preguntas validadas y aceptadas
        $SqlTotalVyA = "SELECT COUNT(*) AS TOTALVyA FROM pregunta WHERE (id_estado_pregunta = '4' OR id_estado_pregunta = '3') AND creador_pregunta = '".$id_usuario."'";
        $resultSQLVyA = $conex->query($SqlTotalVyA); 
        if($resultSQLVyA->num_rows > 0) {
            $TotalVyA = $resultSQLVyA->fetch_assoc(); 
            $TotalPreVyA = intval($TotalVyA['TOTALVyA']);
        }


        
        //total de preguntas ASIGNADA Y SIN VALIDAR
        $SqlTotalAySV = "SELECT COUNT(*) AS TOTALAySV FROM pregunta WHERE (id_estado_pregunta = '1' OR id_estado_pregunta = '7' OR id_estado_pregunta = '5') AND creador_pregunta = '".$id_usuario."'";
        $resultSQLAySV = $conex->query($SqlTotalAySV); 
        if($resultSQLAySV->num_rows > 0) {
            $TotalAySV = $resultSQLAySV->fetch_assoc(); 
            $TotalPreAySV = intval($TotalAySV['TOTALAySV']);
        }


        //total de preguntas NO aceptadas
        $SqlTotalNoAc = "SELECT COUNT(*) AS TOTALNoAc FROM pregunta WHERE id_estado_pregunta = '2' AND creador_pregunta = '".$id_usuario."'";
        $resultSQLNoAc = $conex->query($SqlTotalNoAc); 
        if($resultSQLNoAc->num_rows > 0) {
            $TotalNoAc = $resultSQLNoAc->fetch_assoc(); 
            $TotalPreNoAc = intval($TotalNoAc['TOTALNoAc']);
        }

        if(intval($TotalPreT['TOTAL']) <= 0){
            $band = "false";
        }
        else{
            $band = "true";
        }

        $data[] = array("bandera" => $band, "TotalPre" => intval($TotalPreT['TOTAL']), "TotalPreVyA"=> $TotalPreVyA, "TotalPreAySV" => $TotalPreAySV, "TotalPreNoAc" => $TotalPreNoAc);
        
    }
    else{
        $data[] = array("bandera" => 'false');
    }

    return $data;
} //FIN

//FUNCION QUE OBTIENE EL ID DEL ESATDO DE UNA PREGUNTA
function ObtenerID_EstadoPrg($IdPrg, $conex){
    $SqlId = "SELECT id_estado_pregunta FROM pregunta WHERE id_pregunta='".$IdPrg."'";

    $resultSQL = $conex->query($SqlId);   

    $datos = $resultSQL->fetch_assoc();      
    return $datos;
}; //FIN


?>
