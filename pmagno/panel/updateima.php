<?php

$id= $_POST["idImagen"];
$nombre = $_POST["nombre"];
$categoria = $_POST["imgcategoria"];
$descripcion = $_POST["imgdescripcion"];
// Si se sube una nueva imagen
if (!empty($_FILES["fileToUpload"]["name"])) {
    // Procesar la nueva imagen
    $imagen = $_FILES["fileToUpload"]["name"];
} else {
    // Mantener la imagen anterior
    $imagen = $_POST['foto_anterior'];
}

// $imagen = $_FILES["fileToUpload"]["name"];
echo $id . "-" . $nombre . "-" . $descripcion . "-" . $imagen;

require '../config/conexion.php';
$db = new MySQL();
$db->updateFoto($id, $nombre, $categoria, $descripcion, $imagen);

echo "Subiendo archivo";
$target_dir = "../img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif" ) 

// Por esta:
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
if(!in_array($imageFileType, $allowedExtensions)) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
header('Location: imagenes.php');

?>