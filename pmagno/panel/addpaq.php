<?php

require '../config/conexion.php';
// $id= $_POST["id"];
$nombre = $_POST["nombrep"];
$descripcion = $_POST["descripcionp"];
$precio = $_POST["preciop"];
$categoria = $_POST["peqcategoria"];
echo $nombre . "-" . $descripcion . "-" . $precio;

$db = new MySQL();
$db->addPaque($nombre, $precio, $descripcion, $categoria);

header('Location: paquetes.php');

?>