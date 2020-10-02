<?php 
    // NUMERO DE ESTUDIANTES MATRICULADOS EN TOOLSTIC
    function result_CountEstudiantesMatriculados ( $conex ) {
        $Sqldata = "SELECT COUNT(*) AS result FROM estudiante";
        $resultSQL = $conex->query($Sqldata);    
        $datos = $resultSQL->fetch_assoc();      
        return $datos;
    }

    // NUMERO DE ESTUDIANTES INSCRITOS EN UN GRUPO O DE UNA PRUEBA TOOLSTIC
    function result_CountEstudiantesInscritos ( $conex ) {
        $Sqldata = "SELECT COUNT(*) AS result FROM inscripcion_prueba";
        $resultSQL = $conex->query($Sqldata);    
        $datos = $resultSQL->fetch_assoc();      
        return $datos;
    }


    // NUMERO DE ESTUDIANTES QUE PRESENTARON UNA PRUEBA TOOLSTIC
    function result_CountEstudiantesPresentanPruebas ( $conex ) {
        $Sqldata = "SELECT COUNT(*) AS result FROM estudiante, inscripcion_prueba WHERE estudiante.cod_estudiante = inscripcion_prueba.cod_estudiante AND estudiante.realizo_prueba = 1";
        $resultSQL = $conex->query($Sqldata);    
        $datos = $resultSQL->fetch_assoc();      
        return $datos;
    }


    // NUMERO DE ESTUDIANTES QUE NO HAN PRESENTARON UNA PRUEBA TOOLSTIC Y ESTAN INSCRITOS
    function result_CountEstudiantesNoPresentanPruebas ( $conex ) {
        $Sqldata = "SELECT COUNT(*) AS result FROM estudiante, inscripcion_prueba WHERE estudiante.cod_estudiante = inscripcion_prueba.cod_estudiante AND estudiante.realizo_prueba = 0";
        $resultSQL = $conex->query($Sqldata);    
        $datos = $resultSQL->fetch_assoc();      
        return $datos;
    }

    
    // NUMERO DE ESTUDIANTES PRESENTARON UNA PRUEBA TOOLSTIC Y ESTAN APROBADOS
    function result_CountEstudiantesPresentadosAprobados ( $conex ) {
        $Sqldata = "SELECT COUNT(*) AS result FROM estudiante, cuestionario, resultado_cuestionario WHERE estudiante.cod_estudiante = cuestionario.cod_estudiante AND cuestionario.cod_estudiante = resultado_cuestionario.cod_estudiante AND cuestionario.id_cuestionario = resultado_cuestionario.id_cuestionario AND resultado_cuestionario.puntaje_final >= 3";
        $resultSQL = $conex->query($Sqldata);    
        $datos = $resultSQL->fetch_assoc();      
        return $datos;
    }


    // NUMERO DE ESTUDIANTES PRESENTARON UNA PRUEBA TOOLSTIC Y ESTAN REPROBADOS
    function result_CountEstudiantesPresentadosReprobados ( $conex ) {
        $Sqldata = "SELECT COUNT(*) AS result FROM estudiante, cuestionario, resultado_cuestionario WHERE estudiante.cod_estudiante = cuestionario.cod_estudiante AND cuestionario.cod_estudiante = resultado_cuestionario.cod_estudiante AND cuestionario.id_cuestionario = resultado_cuestionario.id_cuestionario AND resultado_cuestionario.puntaje_final < 3";
        $resultSQL = $conex->query($Sqldata);    
        $datos = $resultSQL->fetch_assoc();      
        return $datos;
    }

    



?>