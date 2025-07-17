<?php
// guardar_comentario.php
require '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $comentario = $_POST['comentario'];
    $fecha = date('Y-m-d'); // Fecha actual

    $db = new MySQL();
    $agregar = $db->guardarComentario($nombre, $comentario);
    
    header('Location: ../index.php');
    exit();
}
?>