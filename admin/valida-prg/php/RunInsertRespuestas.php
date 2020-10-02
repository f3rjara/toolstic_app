<?php
    session_start();
    if(isset($_SESSION['user_docente'])){ $userlog = $_SESSION['user_docente']; }
    else{ header('Location: ../../'); }

    require "../../conex.php";
    include "fetch_records.php";
        
    
    $id_Prg = $_POST['id_Prg'];
    $TxOpcion1 = $_POST['TxOpcion1'];
    $TxOpcion2 = $_POST['TxOpcion2'];
    $TxOpcion3 = $_POST['TxOpcion3'];
    $TxOpcion4 = $_POST['TxOpcion4'];

    $PesoTxOpcion1 = $_POST['PesoTxOpcion1'];
    $PesoTxOpcion2 = $_POST['PesoTxOpcion2'];
    $PesoTxOpcion3 = $_POST['PesoTxOpcion3'];
    $PesoTxOpcion4 = $_POST['PesoTxOpcion4'];

    $Pun1 = $PesoTxOpcion1*0.10/100;
    $Pun2 = $PesoTxOpcion2*0.10/100;
    $Pun3 = $PesoTxOpcion3*0.10/100;
    $Pun4 = $PesoTxOpcion4*0.10/100;


    $punPeso1 = number_format($Pun1, 3);
    $punPeso2 = number_format($Pun2, 3);
    $punPeso3 = number_format($Pun3, 3);
    $punPeso4 = number_format($Pun4, 3);


    
    $sqlGuardaRes = "INSERT INTO opcion_respuesta (id_pregunta, opcion_respuesta, peso_opcion_respuesta, puntaje_opcion_respuesta) VALUES   ('".$id_Prg."', '".$TxOpcion1."', '".$PesoTxOpcion1."', '".$punPeso1."'), ('".$id_Prg."', '".$TxOpcion2."', '".$PesoTxOpcion2."', '".$punPeso2."'), ('".$id_Prg."', '".$TxOpcion3."', '".$PesoTxOpcion3."', '".$punPeso3."'), ('".$id_Prg."', '".$TxOpcion4."', '".$PesoTxOpcion4."', '".$punPeso4."'), ('".$id_Prg."', 'Sin Contestar', '0', '0.000')";
        
        $EjecutaInsert = $conex->query($sqlGuardaRes);        
        if($EjecutaInsert == true){             
            $restext = "Las respuestas se guardaron correctamente";           
            $respuesta = true;
        }
        else{  
            $restext = "Hubo un problema al guardar las respuestas";
            $respuesta = false; 
        }//fin del else inscripcion


    echo json_encode(array("res"=>$respuesta,"restext"=>$restext)); 


?>