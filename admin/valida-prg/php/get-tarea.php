<?php
// BUSCAR Y ENVIAR DATOS DE  EVIDENCIA

require('../../conex.php');

$id_evidencia = $_POST['id_evidencia'];

$sql = "SELECT * FROM tarea WHERE id_evidencia = '".$id_evidencia."' ";
$result = $conex->query($sql); 
$cadena = '<option value="0" selected disabled>Seleccione una opción</option>';

while($datos = $result->fetch_assoc()){ 
    $cadena = $cadena.'<option value="'.$datos['id_tarea'].'">'.utf8_encode($datos['tarea']).'</option>';
}
//echo "<script> alert('".$cadena."'); </script>";

echo $cadena;


?>