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


//funcion que verifica si el usuario ya existe
function verificaExistenciaUser($id_user,$conex){
    $SqlUser = "SELECT COUNT(*) as num_usuarios FROM usuario WHERE id_usuario='".$id_user."'";
    $SqlResult = $conex->query($SqlUser);
    if($SqlResult->num_rows == 0){
        $res = 'true';
    }
    else{
        $res= 'false';
    };
    return $res;
};

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


//FUNCION QUE ME CUENTA LA CANTIDAD DE ESTUDIANTES ENN LA PALTAFORMA
function NumDeEstudiantes($conex){
    $SqlNumEstudent = "SELECT COUNT(*) AS NumStudnet FROM estudiante";
    $SqlResult = $conex->query($SqlNumEstudent);
    $data = $SqlResult->fetch_assoc();
    return $data;
}

//FUNCION QUE ME CUENTA LA CANTIDAD DE ESTUDIANTES INSCRITOS EN UNA PRUEBA O GRUPO
function NumDeEstudiantesInscritos($conex){
    $SqlNumEstudentIns = "SELECT COUNT(*) AS NumStudnetIns FROM inscripcion_prueba";
    $SqlResult = $conex->query($SqlNumEstudentIns);
    $data = $SqlResult->fetch_assoc();
    return $data;
}


//FUNCION QUE ME CUENTA LA CANTIDAD GRUPOS HABILITADOS
function NumDeGruposHabilitados($conex){
    $SqlNumGrupos = "SELECT COUNT(*) AS NumGrupos FROM grupo WHERE id_estado_grupo = '2' OR id_estado_grupo = '3'";
    $SqlResult = $conex->query($SqlNumGrupos);
    $data = $SqlResult->fetch_assoc();
    return $data;
}


//FUNCION QUE ME CUENTA LA CANTIDAD PRUEBAS HABILITADAS O EN CURSO 
function NumPruebasHabilitadas($conex){
    $SqlNumPruebas = "SELECT COUNT(*) AS NumPruebas FROM prueba WHERE id_estado_prueba = '2' OR id_estado_prueba = '3'";
    $SqlResult = $conex->query($SqlNumPruebas);
    $data = $SqlResult->fetch_assoc();
    return $data;
}

//CONSULTA LOS ESTUIANTES REGISTRADOS
function EstudiantesRegistrados($conex){    
    $SqlER = "SELECT cod_estudiante FROM estudiante WHERE realizo_prueba = '0' AND estudiante_habilitado = '1'";
    $ResultSql = $conex->query($SqlER);

    $EstuRegistrados = array();
    while($dataER = $ResultSql->fetch_array()){
        $EstuRegistrados[] = $dataER[0];
    };

    return $EstuRegistrados;
}


//CONSULTA LOS ESTUIANTES INSCRITOS EN UNA GRUPO O PRUEBA 
function EstudiantesInscritos($conex){    
    $SqlEI = "SELECT cod_estudiante FROM inscripcion_prueba";
    $ResultSql = $conex->query($SqlEI);

    $EstuInscritos = array();
    while($dataEI = $ResultSql->fetch_array()){
        $EstuInscritos[] = $dataEI[0];
    };

    return $EstuInscritos;
}


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


//FUNCION DE CONSULTAR CUANTOS CUPOS HAY EN GRUPO Y SI ACTUALIZA SU ESTADO A COMPLETO
function NumUpdCuposGrupo($idGr, $conex){
    $idGrupo = $idGr;

    $CuposEnGrupo = "SELECT cupos_ofrecidos_grupo, total_inscritos_grupo FROM grupo WHERE id_grupo='".$idGrupo."'";

    $resultSQL = $conex->query($CuposEnGrupo);

    if($resultSQL->num_rows > 0){
        $datos = $resultSQL->fetch_assoc();        
        
        $ofrecidos = $datos['cupos_ofrecidos_grupo'];
        $inscritos = $datos['total_inscritos_grupo'];            
        
        if($inscritos == $ofrecidos) { 
            $GrupoLleno = "UPDATE grupo SET id_estado_grupo = '3' WHERE id_grupo='".$idGrupo."'";
            $resultGLL = $conex->query($GrupoLleno);
            return false;                          
        }
        else{
            return true;
        }
    };
}; //FIN


//FUNCION QUE MUESTRA LOS GRUPOS ACTIVOS Y COMPLETOS POR SEDE
function MostrarGruposXSede($conex, $id_sede) {
    $SqlGS = "SELECT grupo.id_grupo, grupo.grupo, prueba.prueba FROM grupo, prueba, sede WHERE grupo.id_prueba = prueba.id_prueba AND prueba.id_sede= sede.id_sede AND (grupo.id_estado_grupo = '2' OR grupo.id_estado_grupo='3') AND prueba.id_sede = '".$id_sede."'";

    $arrayGrupos = array();
    $ResultSql = $conex->query($SqlGS);
    while($data = $ResultSql->fetch_assoc()){
        $arrayGrupos[] = $data;
    }
    return $arrayGrupos;
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

//FUNCION QUE ME LISTA TODOS LOS ESTUDAINTES INSCRITOS EN UN GRUPO DE UNA PRUEBA 
function ListaEstudiantesGrupo($idGrupo, $conex){
    $SqlEstudiantes = "SELECT estudiante.cod_estudiante, estudiante.nombres_estudiante, estudiante.apellidos_estudiante, programa.programa, programa.id_programa FROM estudiante, programa, inscripcion_prueba WHERE inscripcion_prueba.cod_estudiante= estudiante.cod_estudiante AND estudiante.id_programa = programa.id_programa AND inscripcion_prueba.id_grupo = '".$idGrupo."'";

    $i = 0;
    $arrayData = array();

    $ResultSql = $conex->query($SqlEstudiantes); 
    while($data = $ResultSql->fetch_assoc()){
        $arrayData[] = $data;
    }
    return $arrayData;

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


//FUNCION QUE ME RETORNA UN ARRAY DE LOS ESTUDIANTES QUE NOO ESTAN INSCRITOS A UN GRUPO PRUEBA
function EstudiantesNoInscritos($conex){
    //ESTUDIANTES QUE TIENEN UNA INSCRIPCION REALIZADA
    $EstInsc = "SELECT cod_estudiante FROM inscripcion_prueba";
    $ResultEI = $conex->query($EstInsc);
    $List_EsIns = array();
    while($data = $ResultEI->fetch_assoc()){
        $List_EsIns[] = $data['cod_estudiante'];
    }
    // -> ARRAY CON RESUL 1 $List_EsIns;

    //TOTAL DE ESTUDIANTES REGISTRADOS
    $Estu_Reg = "SELECT cod_estudiante FROM estudiante WHERE realizo_prueba='0' AND estudiante_habilitado='1'";
    $ResultEsRe = $conex->query($Estu_Reg);
    $List_EsRe = array();
    while($data_2 = $ResultEsRe->fetch_assoc()){
        $List_EsRe[] = $data_2['cod_estudiante'];
    }
    // -> ARRAY CON RESUL 2 $List_EsRe;

    $resultado = array_diff($List_EsRe, $List_EsIns);
        

    return $resultado;


}


//CONSULTA LA INFORMACION DE UN  ESTUIANTE 
function EstudiantesInfo($conex, $cod){    
    $SqlEsInfo = "SELECT * FROM estudiante, programa WHERE estudiante.id_programa = programa.id_programa AND estudiante.cod_estudiante = '".$cod."'";
    
    $ResultEsInfo = $conex->query($SqlEsInfo);
   
    $dataEsInfo = $ResultEsInfo->fetch_array();      

    return $dataEsInfo;
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


///DATOS DEL ESTUDIANTE RECARGADO
function DatosEstudiantesReload($conex,$cod_estu){
    $Sqldata = "SELECT * FROM estudiante WHERE cod_estudiante = '".$cod_estu."'";
    $resultSQL = $conex->query($Sqldata);    
    $datos = $resultSQL->fetch_assoc();      
    return $datos;
}

?>

