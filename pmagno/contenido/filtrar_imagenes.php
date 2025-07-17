<?php
// filtrar_imagenes.php
require_once '../config/conexion.php'; // Ajusta la ruta según tu estructura

$bd = new MySQL(); // Ajusta según el nombre de tu clase

$categoria = $_POST['categoria'] ?? 'todas';

switch($categoria) {
    case 'todas':
        $bd->getAllImagenes();
        break;
    case 'social':
        $bd->getImagenesPorCategoria('social');
        break;
    case 'empresarial':
        $bd->getImagenesPorCategoria('empresarial');
        break;
    default:
        $bd->getAllImagenes();
        break;
}
?>