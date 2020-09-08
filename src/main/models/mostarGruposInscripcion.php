<?php
     include_once ($_SERVER['DOCUMENT_ROOT'].'/config_.php');
     include_once (ROOT_INCLUDE."/connect.php");  
     include_once (ROOT_INCLUDE.'/fetch_array.php'); 
     include_once (ROOT_MAIN.'/views/sesion_student.php'); 
     if( $_SESSION['error_user'] != FALSE && $_SESSION['user_student'] == NULL) { header('Location: '.ROOT_MEDIA_USER.'/');   } 

    $userLogueado = $userlog['cod_estudiante'];
    
    
    //******************************* */
    $id_prueba = $_POST['id_prueba'];

    $card = "";
    $BtnDisabled = false;
    // CONSULTA DEL NOMBRE DE LA PRUEBA
    //print_r( $id_prueba);

    //REALIZAR CONSULTA DE GRUPOS DE LA PRUEBA
    $sql2="SELECT * FROM prueba WHERE 
    prueba.id_prueba = '".$id_prueba."'";
    
    
    $pruebaResult=$conex->query($sql2);        

    if($pruebaResult->num_rows > 0){
        $datos1 = $pruebaResult->fetch_assoc();
        $nombrePrueba = $datos1['prueba'];
    }

    
    //REALIZAR CONSULTA DE GRUPOS DE LA PRUEBA
    $sql="SELECT * FROM grupo, prueba WHERE 
    grupo.id_prueba = prueba.id_prueba AND (
    grupo.id_estado_grupo = 2  OR  grupo.id_estado_grupo = 3 ) AND
    grupo.id_prueba = '".$id_prueba."'";
    
    
    $LosDatos=$conex->query($sql);    
    

    if($LosDatos->num_rows > 0){
        while($datos = $LosDatos->fetch_assoc())
            {
                $elGrupo = $datos['id_grupo'];

                $resultcupos = NumCuposGrupo($elGrupo,$conex);

                if(!$resultcupos){
                    $card = $card.'<tr><td><label><input disabled name="groups" class="with-gap yellow" type="radio" value="'.$datos['id_grupo'].'" /><span></span></label></td><td>'.$datos['grupo'].'</td><td>'.$datos['aula_grupo'].'</td><td>'.$datos['horario_grupo'].'</td><td><a class="btn red">'.($datos['cupos_ofrecidos_grupo']-$datos['total_inscritos_grupo'].' / '.$datos['cupos_ofrecidos_grupo']).'</a></td></tr>';
                    
                    $SqlActualizaEstadoGrupo = "UPDATE grupo SET id_estado_grupo='3' WHERE id_grupo='".$datos['id_grupo']."'";
                    $EjecutaSql = $conex->query($SqlActualizaEstadoGrupo);

                }
                else{
                    $card = $card.'<tr><td><label><input onclick="GrupoSelect('.$datos['id_grupo'].')" name="groups" class="with-gap yellow" type="radio" value="'.$datos['id_grupo'].'" /><span></span></label></td><td>'.$datos['grupo'].'</td><td>'.$datos['aula_grupo'].'</td><td>'.$datos['horario_grupo'].'</td><td><a class="btn green">'.($datos['cupos_ofrecidos_grupo']-$datos['total_inscritos_grupo'].' / '.$datos['cupos_ofrecidos_grupo']).'</a></td></tr>';

                    $SqlActualizaEstadoGrupo = "UPDATE grupo SET id_estado_grupo='2' WHERE id_grupo='".$datos['id_grupo']."'";
                    $EjecutaSql = $conex->query($SqlActualizaEstadoGrupo);

                }


                
            }; 
    }
    else {
        $card = '<tr><td colspan="5"><b class="red-text">Aún no hay grupos activos o cupos disponibles para la prueba. <br> Intentelo de nuevo en unos minutos</b></td></tr>';
        $BtnDisabled = true;
    };

    $ArrayResult = array();
    
    $ArrayResult[0] = $card;
    $ArrayResult[1] = htmlentities($nombrePrueba, ENT_QUOTES, "UTF-8");
    $ArrayResult[2] = $BtnDisabled;
    
    //var_dump($ArrayResult);
    
    print json_encode($ArrayResult, JSON_UNESCAPED_UNICODE);
    //echo json_encode($ArrayResult);
    
    $conex->close();
    


?>