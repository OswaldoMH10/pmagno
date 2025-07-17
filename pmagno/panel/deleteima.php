<?php
require_once '../config/conexion.php';

$bd = new Mysql();

// Verificar si se recibió el ID de la imagen a eliminar
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    // Verificar si la imagen existe
    if ($bd->existeImagen($id)) {
        // Intentar eliminar la imagen
        if ($bd->deleteImage($id)) {
            // Redirigir con mensaje de éxito
            header('Location: imagenes.php');
            exit();
        } else {
            // Redirigir con mensaje de error
            header('Location: imagenes.php');
            exit();
        }
    } else {
        // Redirigir con mensaje de que no existe
        header('Location: imagenes.php');
        exit();
    }
} else {
    // Redirigir con mensaje de ID inválido
    header('Location: imagenes.php');
    exit();
}
?>