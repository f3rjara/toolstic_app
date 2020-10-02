<?php
    session_start();
    if(isset($_SESSION['user_docente'])){ $userlog = $_SESSION['user_docente']; }
    else{ header('Location: ../../'); }

    require "./../../conex.php";  
    include "./fetch_record.php";

    $id_grupo = $_POST['id_grupo'];
    $codigos = $_POST['codigos'];
    $CodigosRecibidos = preg_split("/[\s,]+/", $codigos);
    
    //ARRAY QUE ME GUARDA LOS ESTUDIANTES QUE ESTAN REGISTRADOS EN LA PLATAFORMA
    $EstuRegistrados =  EstudiantesRegistrados($conex);

    //ARRAY QUE OBTIENE LOS ESTUDIANTES INSCRITOS EN UNA PRUEBA 
    $EstuInscritos =  EstudiantesInscritos($conex);

    $EstuHabilitados = array();
    $EstuNoHabilitados = array();
    //GENERA ARRAY DE ESTUDIANTES NO INSCRITOS A NINGUNA PRUEBA Y ESTAN HABILITADOS PARA INSCRIBIRLOS
    for($i=0; $i<count($EstuRegistrados); $i++ ){
        if(in_array($EstuRegistrados[$i], $EstuInscritos)) {
            $EstuNoHabilitados[] = $EstuRegistrados[$i];
        }
        else{
            $EstuHabilitados[] = $EstuRegistrados[$i];
        }
    };

    //DE LOS COFDIGOS DIGITADOS VER SI ESTAN  REGISTRADOS Y HABILITADOS 
    // $EstuHabilitados TIENE LOS ESTUDIANTES QUE PUEDEN SER INSCRITOS
    $Cod_Digi_Habiltados = array();
    $Cod_Digi_NO_Habiltados = array();

    for($j=0; $j < count($CodigosRecibidos); $j++ ){
        if(in_array($CodigosRecibidos[$j], $EstuHabilitados)) {
            $Cod_Digi_Habiltados[] = $CodigosRecibidos[$j];
        }
        else{
            $Cod_Digi_NO_Habiltados[] = $CodigosRecibidos[$j];
        }
    };
    

    $SqlComprobarCupos = "SELECT (cupos_ofrecidos_grupo - total_inscritos_grupo) AS CuposLibres FROM grupo WHERE id_grupo = '".$id_grupo."'";

    $ResultCG = $conex->query($SqlComprobarCupos);
    $CuposLibres = $ResultCG->fetch_assoc();
    $num = (string)count($Cod_Digi_NO_Habiltados);
    $est  = (string)count($Cod_Digi_Habiltados);
    
    if(count($Cod_Digi_Habiltados) <= $CuposLibres['CuposLibres'] ){

        $Hoyes = ObtenerDateTime();

        for($reg = 0; $reg < count($Cod_Digi_Habiltados) ;$reg++){
            $SqlNewInscripcion = "INSERT INTO inscripcion_prueba (id_grupo, cod_estudiante, fecha_inscripcion) VALUES ('".$id_grupo."', '".$Cod_Digi_Habiltados[$reg]."', '".$Hoyes['date']."')"; 
            $ResultSQlIns = $conex->query($SqlNewInscripcion); 
            CuposGrupos($id_grupo, $conex);
            NumUpdCuposGrupo($id_grupo, $conex);
        }       

        $restext = "Se registraron <b>".$est."</b> estudiantes <br> Estudiantes que no pudieron ser inscritos = ".$num."<br> <code>".json_encode($Cod_Digi_NO_Habiltados)."</code>";
        $respuesta = true; 

    }else{
        $restext = "No hay cupos suficientes en el grupo";
        $respuesta = false; 
    } 
        

    echo json_encode(array("res"=>$respuesta,"restext"=>$restext, "GRUPO SELECT"=>$id_grupo, "COD_DIGITADOS"=>$CodigosRecibidos, "CODIGOS_DIGITADOS_HABILITADOS"=>$Cod_Digi_Habiltados,"CODIGOS_DIGITADOS_NO_HABILITADOS"=>$Cod_Digi_NO_Habiltados,"Num_CUPOS"=>$CuposLibres)); 


?>