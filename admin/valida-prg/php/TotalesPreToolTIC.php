<?php
require_once './../../conex.php';

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

    echo json_encode($data);

?>