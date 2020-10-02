<?php
session_start();

if(isset($_SESSION['user_docente'])){
    $userlog = $_SESSION['user_docente'];
}
else{
    header('Location: ../../');
}

// BUSCAR Y ENVIAR DATOS DE  EVIDENCIA

require('../../conex.php');

$id_competencia = $_POST['id_competencia'];

$sql = "SELECT * FROM evidencia WHERE id_competencia = '".$id_competencia."' ";
$result = $conex->query($sql);


$cadena = '<option value="0" selected >Seleccione una opción</option>';

while($datos = $result->fetch_assoc()){ 
    $cadena = $cadena.'<option value="'.$datos['id_evidencia'].'">'.utf8_encode($datos['evidencia']).'</option>';
}
//echo "<script> alert('".$cadena."'); </script>";

echo $cadena;


?>