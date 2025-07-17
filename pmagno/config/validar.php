<?php
require '../config/conexion.php';

//Leer
$email = $_POST["usuario"];
$password = $_POST["password"];

$db = new MySQL();
$usuario = $db->existeUser($email, $password);

if ($usuario) {
    session_start();
    $_SESSION["admin"] = "foto";
    //$_SESSION["admin"] = $usuario['nombre'];
    //$_SESSION["email"] = $usuario['email'];
    //$_SESSION["user_id"] = $usuario['id'];

    header('Location: ../panel/tablero.php');
    exit();
} else {
    header('Location: ../panel/login.php');
    exit();
}


//Validar Usuario
// if ( $user == "magno" && $contra == "fotos123" )
// {
//     session_start();
//     $_SESSION["admin"] = "foto";
//     header('Location: ../panel/tablero.php');
// }
// else
// {
//     header('Location: index.php');
// }

?>