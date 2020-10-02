<?php 

include('./../../conex.php');

$id_usuario = $_POST['id_docente'];

$SqlTotal = "SELECT COUNT(*) AS TOTAL FROM pregunta  WHERE validador_pregunta = '".$id_usuario."'";
    $resultSQL = $conex->query($SqlTotal);        
    $data = array();
    
    $TotalPreVyA = 0;
    $TotalPrePC = 0;
    $TotalPreAySV = 0;
    $TotalPreNoAc = 0;


    if($resultSQL->num_rows > 0 ) {        
        $TotalPreT = $resultSQL->fetch_assoc();        
               
        //total de preguntas validadas y aceptadas
        $SqlTotalVyA = "SELECT COUNT(*) AS TOTALVyA FROM pregunta WHERE id_estado_pregunta = '4' AND validador_pregunta = '".$id_usuario."'";
        $resultSQLVyA = $conex->query($SqlTotalVyA); 
        if($resultSQLVyA->num_rows > 0) {
            $TotalVyA = $resultSQLVyA->fetch_assoc(); 
            $TotalPreVyA = intval($TotalVyA['TOTALVyA']);
        }


        //total de preguntas validadas y aceptadas
        $TotalPrePC = "SELECT COUNT(*) AS TotalPrePC FROM pregunta WHERE id_estado_pregunta = '3' AND validador_pregunta = '".$id_usuario."'";
        $resultSQL1 = $conex->query($TotalPrePC); 
        if($resultSQL1->num_rows > 0) {
            $TotalPC = $resultSQL1->fetch_assoc(); 
            $TotalPrePC = intval($TotalPC['TotalPrePC']);
        }


        
        //total de preguntas ASIGNADA Y SIN VALIDAR
        $SqlTotalAySV = "SELECT COUNT(*) AS TOTALSV FROM pregunta WHERE (id_estado_pregunta = '1' OR id_estado_pregunta = '7' OR id_estado_pregunta = '5') AND validador_pregunta = '".$id_usuario."'";
        $resultSQLAySV = $conex->query($SqlTotalAySV); 
        if($resultSQLAySV->num_rows > 0) {
            $TotalAySV = $resultSQLAySV->fetch_assoc(); 
            $TotalPreAySV = intval($TotalAySV['TOTALSV']);
        }


        //total de preguntas NO aceptadas
        $SqlTotalNoAc = "SELECT COUNT(*) AS TOTALNoAc FROM pregunta WHERE id_estado_pregunta = '2' AND validador_pregunta = '".$id_usuario."'";
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

        $data[] = array("bandera" => $band, "TotalPre" => intval($TotalPreT['TOTAL']), "TotalPreVyA"=> $TotalPreVyA, "TotalPrePC" => $TotalPrePC, "TotalPreSV" => $TotalPreAySV, "TotalPreNoAc" => $TotalPreNoAc);
        
    }
    else{
        $data[] = array("bandera" => "false", "TotalPre" => intval($TotalPreT['TOTAL']), "TotalPreVyA"=> $TotalPreVyA,  "TotalPrePC" => $TotalPrePC, "TotalPreAySV" => $TotalPreAySV, "TotalPreNoAc" => $TotalPreNoAc);
    }

    echo json_encode($data);

?>