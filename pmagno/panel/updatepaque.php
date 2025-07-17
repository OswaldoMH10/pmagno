<?php

require '../config/conexion.php';
$id= $_POST["id"];
$nombre = $_POST["nombrep"];
$descripcion = $_POST["descripcionp"];
$precio = $_POST["preciop"];
$categoria = $_POST["peqcategoria"];
echo $id . "-" . $nombre . "-" . $descripcion . "-" . $precio;

$db = new MySQL();
$db->updatePaquete($id, $nombre, $descripcion, $precio, $categoria);

header('Location: paquetes.php');

?>