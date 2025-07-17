<?php
require_once '../config/conexion.php';

$bd = new Mysql();

// Verificar si se recibió el ID de la imagen a eliminar
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    // Verificar si la imagen existe
    if ($bd->existePaque($id)) {
        // Intentar eliminar la imagen
        if ($bd->deletePaque($id)) {
            // Redirigir con mensaje de éxito
            header('Location: paquetes.php');
            exit();
        } else {
            // Redirigir con mensaje de error
            header('Location: paquetes.php');
            exit();
        }
    } else {
        // Redirigir con mensaje de que no existe
        header('Location: paquetes.php');
        exit();
    }
} else {
    // Redirigir con mensaje de ID inválido
    header('Location: paquetes.php');
    exit();
}
?>