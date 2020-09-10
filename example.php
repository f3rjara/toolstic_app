<?php
session_start();

$obj = new stdClass();
$obj->name = "Nick";
$obj->surname = "Doe";
$obj->age = 20;
$obj->adresse = null;

// $stdObject referred to this object (stdObject).
echo $obj->name . " " . $obj->surname . " have " . $obj->age . " yrs old. And live in " . $obj->adresse;

$_SESSION['prueba'] = $obj;
echo "<br>";

//var_dump($_SESSION['prueba']);
//echo($_SESSION['prueba']->name);


var_dump($_SESSION['ReportData']);

echo "<hr>";
$full = json_decode($_SESSION['ReportData']);
var_dump($full);
echo "<hr>";
echo($full->nombre_completo);
?>