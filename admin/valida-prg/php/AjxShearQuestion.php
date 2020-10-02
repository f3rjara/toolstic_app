<?php

    require('./../../conex.php');
    

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

	$stringLIKE = "";
	$sql_pag = "";
	$sql = "";
	
	if($action == 'ajax'){
        include 'pagination.php'; //incluir el archivo de paginación
		include 'fetch_records.php'; //incluir el archivo de paginación
		
		header("Content-Type: text/html;charset=utf-8");
        
		//las variables de paginación
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$sqlSend = (isset($_REQUEST['sql_send']) && !empty($_REQUEST['sql_send']))?$_REQUEST['sql_send']:1;	
		$isValidaor = (isset($_REQUEST['IsValidor']) && !empty($_REQUEST['IsValidor']))?$_REQUEST['IsValidor']:1;	
		$IsEnunciado = (isset($_REQUEST['IsEnunciado']) && !empty($_REQUEST['IsEnunciado']))?$_REQUEST['IsEnunciado']:1;	
		
		function eliminar_acentos($cadena)
			{
					
					//Reemplazamos la A y a
					$cadena = str_replace(
					array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
					array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
					$cadena
					);
			
					//Reemplazamos la E y e
					$cadena = str_replace(
					array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
					array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
					$cadena );
			
					//Reemplazamos la I y i
					$cadena = str_replace(
					array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
					array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
					$cadena );
			
					//Reemplazamos la O y o
					$cadena = str_replace(
					array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
					array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
					$cadena );
			
					//Reemplazamos la U y u
					$cadena = str_replace(
					array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
					array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
					$cadena );
			
					//Reemplazamos la N, n, C y c
					$cadena = str_replace(
					array('Ñ', 'ñ', 'Ç', 'ç'),
					array('N', 'n', 'C', 'c'),
					$cadena
					);
					
					return $cadena;
			};	


		$per_page = 10; //la cantidad de registros que desea mostrar
		$adjacents  = 3; //brecha entre páginas después de varios adyacentes
		$offset = ($page - 1) * $per_page;
        //Cuenta el número total de filas de la tabla*/
		
		if($sqlSend != 'false'){

			$stringLIKE = "'%".strtoupper($sqlSend)."%'";
			$stringEnunciado = "'%".strtoupper($sqlSend)."%'";		
			$stringSinT = eliminar_acentos($stringLIKE);

			$TipoUser  = "pregunta.creador_pregunta = usuario.id_usuario";
			if($isValidaor == "true")
			{
				$TipoUser = "pregunta.validador_pregunta = usuario.id_usuario";
			}
			
			if($IsEnunciado == "true"){
				$sql = 
				"SELECT count(*) AS 'numrows'
				 FROM pregunta, estado_pregunta, tarea, evidencia, competencia, usuario 
				 WHERE pregunta.id_estado_pregunta = estado_pregunta.id_estado_pregunta 
				 	AND pregunta.id_tarea = tarea.id_tarea 
					AND tarea.id_evidencia = evidencia.id_evidencia 
					AND evidencia.id_competencia = competencia.id_competencia 
					AND pregunta.creador_pregunta = usuario.id_usuario
					AND pregunta.enunciado_pregunta LIKE $stringEnunciado
					ORDER BY pregunta.id_estado_pregunta 
				";

			}
			else
			{			
				$sql = 
				"SELECT count(*) AS 'numrows', concat_ws(' ', usuario.nombres_usuario, usuario.apellidos_usuario) AS 'persona' 
				 FROM pregunta, estado_pregunta, tarea, evidencia, competencia, usuario 
				 WHERE pregunta.id_estado_pregunta = estado_pregunta.id_estado_pregunta 
				 	AND pregunta.id_tarea = tarea.id_tarea 
					AND tarea.id_evidencia = evidencia.id_evidencia 
					AND evidencia.id_competencia = competencia.id_competencia 
					AND  $TipoUser
					AND (
						competencia.competencia  LIKE $stringSinT
						OR estado_pregunta.estado_pregunta LIKE $stringSinT
						OR usuario.nombres_usuario LIKE $stringSinT
						OR usuario.apellidos_usuario LIKE $stringSinT
						OR concat_ws(' ', usuario.nombres_usuario, usuario.apellidos_usuario)  LIKE $stringSinT 						
						)
					ORDER BY pregunta.id_estado_pregunta 
					";
			}
		}
		//ELSE PARA MOSTRAR TODAS LAS PREGUNTAS
		else{
			$sql = "SELECT count(*) AS numrows FROM pregunta";
		}
                
        $count_query   = $conex->query($sql); 
        
		if ($row = mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
				
		$total_pages = ceil($numrows/$per_page);
		
		$reload = 'listar-preguntas.php';
        //consulta principal para recuperar los datos
		
		
		if($sqlSend != 'false'){				
			$stringLIKE = "'%".strtoupper($sqlSend)."%'";		
			$stringEnunciado = "'%".strtoupper($sqlSend)."%'";		

			$stringSinT = eliminar_acentos($stringLIKE);
			$TipoUser  = "pregunta.creador_pregunta = usuario.id_usuario";

			if($isValidaor == "true")
			{
				$TipoUser = "pregunta.validador_pregunta = usuario.id_usuario";
			}
			
			
			if($IsEnunciado == "true"){
			$sql_pag = 
				"SELECT *
				 FROM pregunta, estado_pregunta, tarea, evidencia, competencia, usuario 
				 WHERE pregunta.id_estado_pregunta = estado_pregunta.id_estado_pregunta 
				 	AND pregunta.id_tarea = tarea.id_tarea 
					AND tarea.id_evidencia = evidencia.id_evidencia 
					AND evidencia.id_competencia = competencia.id_competencia 	
					AND pregunta.creador_pregunta = usuario.id_usuario				
					AND pregunta.enunciado_pregunta LIKE $stringEnunciado
					ORDER BY pregunta.id_estado_pregunta 
					LIMIT $offset,$per_page";
			}
			else
			{
			$sql_pag = 
				"SELECT *, concat_ws(' ', usuario.nombres_usuario, usuario.apellidos_usuario) AS 'persona' FROM pregunta, estado_pregunta, tarea, evidencia, competencia, usuario 
				 WHERE pregunta.id_estado_pregunta = estado_pregunta.id_estado_pregunta 				 	
				 	AND pregunta.id_tarea = tarea.id_tarea 
					AND tarea.id_evidencia = evidencia.id_evidencia 
					AND evidencia.id_competencia = competencia.id_competencia 		
					AND $TipoUser		
					AND (
						competencia.competencia  LIKE $stringSinT
						OR estado_pregunta.estado_pregunta LIKE $stringSinT
						OR usuario.nombres_usuario LIKE $stringSinT
						OR usuario.apellidos_usuario LIKE $stringSinT
						OR concat_ws(' ', usuario.nombres_usuario, usuario.apellidos_usuario)  LIKE $stringSinT 						
						)
					ORDER BY pregunta.id_estado_pregunta 					
					LIMIT $offset,$per_page";
			}
			
		}
		//ELSE PARA MOSTRAR TODAS LAS PREGUNTAS
		else
		{			
			$sql_pag = 
				"SELECT * FROM pregunta, estado_pregunta, tarea, evidencia, competencia 
				 WHERE pregunta.id_estado_pregunta = estado_pregunta.id_estado_pregunta 
					AND pregunta.id_tarea = tarea.id_tarea 
					AND tarea.id_evidencia = evidencia.id_evidencia 
					AND evidencia.id_competencia = competencia.id_competencia 
					ORDER BY pregunta.id_estado_pregunta 
					LIMIT $offset,$per_page";
		}
		
		/*
		ALTER TABLE `pregunta` CHANGE `enunciado_pregunta` `enunciado_pregunta` MEDIUMTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

		ALTER TABLE `competencia` CHANGE `competencia` `competencia` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL;

		ALTER TABLE `estado_pregunta` CHANGE `estado_pregunta` `estado_pregunta` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL;

		ALTER TABLE `estado_pregunta` CHANGE `bgcolor_estado_pregunta` `bgcolor_estado_pregunta` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL;

		ALTER TABLE `usuario` CHANGE `nombres_usuario` `nombres_usuario` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL;

		ALTER TABLE `usuario` CHANGE `apellidos_usuario` `apellidos_usuario` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL;

		ALTER TABLE `pregunta` CHANGE `enunciado_pregunta` `enunciado_pregunta` MEDIUMTEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL;

		*/

        

        $query = $conex->query($sql_pag); 
        $stringRet = "";
        $contador = $offset;
        
        if ($query->num_rows > 0 ){		
           
            while($row = $query->fetch_array())
              {                 
                $contador++;
                $stringRet .='
                <tr>
					<td>'.$contador.'</td>
					<td>'.$row['cod_pregunta'].'</td>
					<td>'.utf8_encode($row['competencia']).'</td>
					<td class="left"><a class="btn '.$row['bgcolor_estado_pregunta'].'">'.$row['estado_pregunta'].'</a></td>
					<td><a style="cursor:pointer" onclick="VerPrgFull('.$row['id_pregunta'].')"><i class="material-icons ToolsTic_Verde-text">remove_red_eye
                    </i></a></td>
				</tr>
				';				
			}
			
			$stringRet .='
            <tr>
				<td colspan="5">'.
                    paginate($reload, $page, $total_pages, $adjacents)
				.'</td>
			</tr>	
            ';

			/*
            
            
            
			*/
		} else {
            
            $stringRet ='
			<tr>
				<td colspan="5">
					<div class="chip ToolsticAzul-dark white-text ">
						<b id="MsgResulados">No hay resultados por mostrar</b>
					</div>
				</td>
			</tr>
			';
		}
    }
    
	echo json_encode(array("data"=>$stringRet,"NoRes"=>$numrows,"SqlSend" => $sql_pag));
?>
