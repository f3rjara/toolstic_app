<?php

session_start();
    if(isset($_SESSION['user_docente'])){ $userlog = $_SESSION['user_docente']; }
    else{ header('Location: ../../'); }

    require "./../../conex.php";  
    include "./fetch_record.php";

    $id_grupo = $_POST['id_grupo'];  
    
    $SqlEstuGrupo = "SELECT estudiante.cod_estudiante, estudiante.nombres_estudiante, estudiante.apellidos_estudiante, programa.programa FROM estudiante, programa, inscripcion_prueba WHERE inscripcion_prueba.cod_estudiante= estudiante.cod_estudiante AND estudiante.id_programa = programa.id_programa AND inscripcion_prueba.id_grupo = '".$id_grupo."'";

    $fila = "";
    $num = 1;
    $ResultSql = $conex->query($SqlEstuGrupo); 
    while($data = $ResultSql->fetch_assoc()){
        $fila = $fila.
        "<tr><td>".$num."</td><td>".$data['cod_estudiante']."</td><td>".utf8_encode($data['nombres_estudiante'])."</td><td>".utf8_encode($data['apellidos_estudiante'])."</td><td>".utf8_encode($data['programa'])."</td></tr>";
        $num++;
    }

    if($ResultSql->num_rows < 1){
        $fila = "<tr><td colpan='5'>No hay estudiantes en el grupo</td></tr>";
    }
     
    $conex->close();

    echo json_encode(array("FILAS"=>$fila)); 

?>