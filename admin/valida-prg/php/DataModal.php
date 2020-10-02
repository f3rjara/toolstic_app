<?php

require'./../../conex.php';
include'./fetch_records.php';



$id_preg = $_POST['id_pregunta'];

$badera = true;

$dataCompe = ObtenerCompetenciaPrg($id_preg, $conex);
$DataFull = PreguntaFullAll($id_preg, $conex);
$DataRes = ObtenerOpcionesRespuestas($id_preg, $conex);

$cod_pregunta = $DataFull['cod_pregunta'];
$estado_pregunta = $DataFull['estado_pregunta'];
$bg_estado_pregunta =  $DataFull['bgcolor_estado_pregunta'];
$competencia = $dataCompe['competencia'];
$def_competencia = $dataCompe['afirmacion_competencia'];
$evidencia = $dataCompe['evidencia'];
$tarea = $dataCompe['tarea'];

$enunciado = $DataFull['enunciado_pregunta'];


$peso1 = $DataRes[0]['peso_opcion_respuesta'];
$peso2 = $DataRes[1]['peso_opcion_respuesta'];
$peso3 = $DataRes[2]['peso_opcion_respuesta'];
$peso4 = $DataRes[3]['peso_opcion_respuesta']; 
$respu1 = $DataRes[0]['opcion_respuesta'];
$respu2 = $DataRes[1]['opcion_respuesta'];
$respu3 = $DataRes[2]['opcion_respuesta'];
$respu4 = $DataRes[3]['opcion_respuesta'];


$fecha_creacion = $DataFull['fecha_creacion_pregunta'];
//SE OBTINE ID PARA DATOS PERSONALES
$id_creador_pregunta = $DataFull['creador_pregunta'];
$id_validador_pregunta = $DataFull['validador_pregunta'];

$creator = UserFullData($id_creador_pregunta, $conex);
$validator = UserFullData($id_validador_pregunta, $conex);

$creador_pregunta = utf8_encode($creator['nombres_usuario'])." ".utf8_encode($creator['apellidos_usuario'])." ";
$validador_pregunta = utf8_encode($validator['nombres_usuario'])." ".utf8_encode($validator['apellidos_usuario'])." ";



echo json_encode(array(
    "cod_pregunta"=>$cod_pregunta,
    "estado_pregunta" => $estado_pregunta,
    "bg_estado_pregunta" => $bg_estado_pregunta,   
    "competencia" => utf8_encode($competencia),
    "def_competencia" => utf8_encode($def_competencia),
    "evidencia" => utf8_encode($evidencia),
    "tarea" => utf8_encode($tarea),
    "enunciado" => $enunciado,
    "peso1" => strval($peso1)." %",
    "peso2" => strval($peso2)." %",
    "peso3" => strval($peso3)." %",
    "peso4" => strval($peso4)." %",
    "respu1" => $respu1,
    "respu2" => $respu2,
    "respu3" => $respu3,
    "respu4" => $respu4,
    "fecha_creacion" => strftime("%d de %b del %Y, %I:%M:%S %p",strtotime($fecha_creacion)),
    "creador_pregunta" => htmlentities($creador_pregunta),
    "validador_pregunta" =>htmlentities($validador_pregunta) 
 ));
?>