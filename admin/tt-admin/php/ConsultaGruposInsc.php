<?php
    session_start();
    if(isset($_SESSION['user_docente'])){ $userlog = $_SESSION['user_docente']; }
    else{ header('Location: ../../'); }

    require "./../../conex.php";  
    include "./fetch_record.php";

   
    $SqlConGrupos = "SELECT id_grupo, grupo , (cupos_ofrecidos_grupo - total_inscritos_grupo) AS Cupos_Libres FROM grupo"; 
    
    $ResultSQl = $conex->query($SqlConGrupos);    
    $data2 = array();
    $i = 0;
    while($data = $ResultSQl->fetch_assoc())
    {
        $data2[$i] = $data;
        $i++;
    };

    echo json_encode(array("data2"=>$data2)); 


?>