<?php
    require "./conex.php";  
    //require "./tt-admin/php/fetch_record.php";
    require "./valida-prg/php/fetch_records.php";

    if(isset($_POST['nombre']))
    {
        $destino ="toolsticweb@gmail.com";
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $mensaje = '<html>
        <head>
          <title>Recordatorio de cumpleaños para Agosto</title>
        </head>
        <body>
          <p>¡Estos son los cumpleaños para Agosto!</p>
          <table>
            <tr>
              <th>Quien</th><th>Día</th><th>Mes</th><th>Año</th>
            </tr>
            <tr>
              <td>Joe</td><td>3</td><td>Agosto</td><td>1970</td>
            </tr>
            <tr>
              <td>Sally</td><td>17</td><td>Agosto</td><td>1973</td>
            </tr>
          </table>
        <img src="https://k60.kn3.net/E/7/F/2/4/8/472.gif">
        </body>
        </html>';

        $contenido = "nombre: ".$nombre." \n Correo: ".$email." \n \n Mensaje: ".$mensaje;
        if(mail($destino,"PRUEBA DESDE XAMP",$contenido)){            
            echo "mensaje enviado";
        }
        else {
            echo "error al enviar mensaje";
        }
    }
    
    
    
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/materialize.css">
    <title>PRUEBAS CRUD</title>
</head>
<body>

<?php
    $var = 15;
    $puntaje1 = $var * 0.10 /100;
    //echo $puntaje1;
    $result = number_format($puntaje1, 3);
    //echo "<br>";
    //echo $result ;
?>

<br>
<br>
<br>
<br>

***************

<?php 

    $query = "SELECT *  FROM pregunta";
    $ResultSql = $conex->query($query);
    $data = array();
    if($ResultSql->num_rows > 0) {
        while($DataResult = $ResultSql->fetch_assoc()){
            $data[]= $DataResult;
        }
    }
    //var_dump($data);

    echo count($data);
    echo " *************** <br>";
    for($i = 0; $i < count($data); $i++){
        $Full1 = PreguntaFullAll($data[$i]['id_pregunta'], $conex);
        $comp1 = ObtenerCompetenciaPrg($data[$i]['id_pregunta'], $conex); 
        $DocVal = DataDocentesET($conex, $data[$i]['validador_pregunta']);
        //var_dump($DocVal);

        echo "<br>";
        echo " id_pregunta - ".$data[$i]['id_pregunta']."<br>";  
        echo " fecha_creacion_pregunta - ".$data[$i]['fecha_creacion_pregunta']."<br>";
        echo " estado_pregunta - ".$Full1['estado_pregunta']."<br>";
        echo " competecnia - ".utf8_encode($comp1['competencia'])."<br>";
        echo " creador_pregunta - ".$data[$i]['creador_pregunta']."<br>";
        echo " observaciones_validacion - ".$data[$i]['observaciones_validacion']."<br>";
        echo " Validado por: ".utf8_encode($DocVal[0]['nombres_usuario'])." ".utf8_encode($DocVal[0]['apellidos_usuario'])."<br>";

        
        echo " fecha_validacion - ".$data[$i]['fecha_validacion']."<br>";
        echo " cod_pregunta - ".$data[$i]['cod_pregunta']."<hr>";
    }
?>



***************




<hr>
<br>
<br>
<br>
<br>













<hr>
<hr>











<style>
    .div{       
        width: 200px;
        height: 200px;
    }
</style>
<?php       
    
?>
<div class="row">    
        <?php        
            for($res=1; $res <= 4; $res++) {            
            ?>
            <div class="col s12 m3">
            <p>
                <label>
                <input class="with-gap" name="GRPP<?php echo $res;?>" id="resp1_prg<?php echo $res;?>" type="radio"  />
                <span>RESPUESTA A PREGUNTA <?php echo $res;?></span>
                </label>
            </p>
            <p>
                <label>
                <input class="with-gap" name="GRPP<?php echo $res;?>" id="resp2_prg<?php echo $res;?>" type="radio" />
                <span>RESPUESTA B PREGUNTA <?php echo $res;?></span>
                </label>
            </p>
            <p>
                <label>
                <input class="with-gap" name="GRPP<?php echo $res;?>" id="resp3_prg<?php echo $res;?>"  type="radio"  />
                <span>RESPUESTA C PREGUNTA <?php echo $res;?></span>
                </label>
            </p>
            <p>
                <label>
                <input class="with-gap" name="GRPP<?php echo $res;?>" id="resp4_prg<?php echo $res;?>"  type="radio"  />
                <span>RESPUESTA D PREGUNTA <?php echo $res;?></span>
                </label>
            </p>

            <p>
                <label>
                <input class="with-gap" name="GRPP<?php echo $res;?>" id="resp5_prg<?php echo $res;?>"  type="radio" checked   />
                <span>SIN RESPONDER PREGUNTA <?php echo $res;?></span>
                </label>
            </p>
            </div>
        <?php }
        ?>
    
</div>


<hr>
<?php
    $id_Prg = 1;  
    $ocpionRespuesta = 3;  
    for($divres=1; $divres <= 4; $divres++) {   
  
?>
<div class="row">
    <?php 
    for($res=1; $res <=4; $res++){ ?>    
    <div class="col s12 m3">
        <div class="div blue" id="OR<?php echo $res;?>PP<?php echo $divres;?>" 
        onclick="Selectoption(<?php echo $res;?>,<?php echo $divres;?> )">
        </div> 
    </div>    
    <?php } ?>
</div>
<hr>
 
<?php } ?>


<script src="../js/jquery-341.js"></script>
<script src="../js/materialize.js"></script>
<script>




function Selectoption(num_repuesta, num_pregunta){       

    if(num_repuesta == 1){
        

        $('#OR1PP'+num_pregunta).addClass('green');
        $('#OR2PP'+num_pregunta).removeClass('green');
        $('#OR3PP'+num_pregunta).removeClass('green');           
        $('#OR4PP'+num_pregunta).removeClass('green'); 
        
        $('#resp2_prg'+num_pregunta).attr( 'checked', false);
        $('#resp3_prg'+num_pregunta).attr( 'checked', false);
        $('#resp4_prg'+num_pregunta).attr( 'checked', false); 
        $('#resp1_prg'+num_pregunta).attr( 'checked', true); 
    }
    if(num_repuesta == 2){
        $('#OR2PP'+num_pregunta).addClass('green');
        $('#OR1PP'+num_pregunta).removeClass('green');
        $('#OR3PP'+num_pregunta).removeClass('green');           
        $('#OR4PP'+num_pregunta).removeClass('green'); 

        $('#resp1_prg'+num_pregunta).attr( 'checked', false);        
        $('#resp3_prg'+num_pregunta).attr( 'checked', false);
        $('#resp4_prg'+num_pregunta).attr( 'checked', false);  
        $('#resp2_prg'+num_pregunta).attr( 'checked', true);
    }
    if(num_repuesta == 3){
        $('#OR3PP'+num_pregunta).addClass('green');
        $('#OR2PP'+num_pregunta).removeClass('green');
        $('#OR4PP'+num_pregunta).removeClass('green');           
        $('#OR1PP'+num_pregunta).removeClass('green'); 

        $('#resp1_prg'+num_pregunta).attr( 'checked', false);
        $('#resp2_prg'+num_pregunta).attr( 'checked', false);
        $('#resp4_prg'+num_pregunta).attr( 'checked', false);  
        $('#resp3_prg'+num_pregunta).attr( 'checked', true);
    }
    if(num_repuesta == 4){
        $('#OR4PP'+num_pregunta).addClass('green');
        $('#OR2PP'+num_pregunta).removeClass('green');
        $('#OR3PP'+num_pregunta).removeClass('green');           
        $('#OR1PP'+num_pregunta).removeClass('green'); 

        $('#resp1_prg'+num_pregunta).attr( 'checked', false);
        $('#resp2_prg'+num_pregunta).attr( 'checked', false);
        $('#resp3_prg'+num_pregunta).attr( 'checked', false);
        $('#resp4_prg'+num_pregunta).attr( 'checked', true);  
    }
           
    
    
}

</script>
</body>
</html>