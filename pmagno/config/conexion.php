<?php
class Mysql
{

    private $connection;
    public $result;

    function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "bdphotomagno";
        // Create connection
        $this->connection = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    function getFotos()
    {
        $sql = 'SELECT idimagenes, nombre, categoria, descripcion, archivo FROM imagenes';
        $result = $this->connection->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->showFoto($row["idimagenes"], $row["nombre"], $row["categoria"], $row["descripcion"], $row["archivo"]);
            }
        }
    }

    function showFoto($id, $nombre, $categoria, $descripcion, $foto)
    {
        echo '<tr>';
        // echo '<td>'. $id .'</td>';
        echo '<td><img src="../img/' . $foto . '" width="120px"/></td>';
        echo '<td>' . $nombre . '</td>';
        echo '<td>' . $categoria . '</td>';
        echo '<td>' . $descripcion . '</td>';
        echo '<td><A href="editarimagen.php?id=' . $id . '&nombre=' . $nombre . '&categoria=' . $categoria . '&descripcion=' . $descripcion . '&foto=' . $foto . '"><button type="button" class="btn btn-warning">EDITAR</button></A></td>';
        echo '<td><button type="button" class="btn btn-danger" onclick="confirmarEliminacion(' . $id . ', \'' . $nombre . '\')">ELIMINAR</button></td>';
        echo '</tr>';
    }

    function deleteImage($id)
    {
        // Primero obtener el nombre del archivo para eliminarlo del servidor
        $sql = "SELECT archivo FROM imagenes WHERE idimagenes = '$id'";
        $result = $this->connection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $archivo = $row['archivo'];

            // Eliminar el registro de la base de datos
            $sql = "DELETE FROM imagenes WHERE idimagenes = '$id'";
            if ($this->connection->query($sql) === TRUE) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    // Método para verificar si existe una imagen
    function existeImagen($id)
    {
        $sql = "SELECT idimagenes FROM imagenes WHERE idimagenes = '$id'";
        $result = $this->connection->query($sql);
        return $result->num_rows > 0;
    }

    function updateFoto($id, $nombre, $categoria, $descripcion, $imagen)
    {
        $sql = "UPDATE
                `imagenes`
            SET
                idimagenes = '$id',
                nombre = '$nombre',
                categoria = '$categoria',
                descripcion = '$descripcion',
                archivo = '$imagen'
            WHERE
                imagenes.idimagenes = '$id'";
        $this->connection->query($sql);
    }

    function addFoto($id, $nombre, $categoria, $descripcion, $imagen)
    {
        $sql = "INSERT INTO
                `imagenes` (nombre, categoria, descripcion, archivo)
            VALUES
                ('$nombre', '$categoria', '$descripcion', '$imagen');";
        $this->connection->query($sql);
    }

    // Método que obtiene todas las imágenes
    function getAllImagenes()
    {
        $sql = "SELECT
            idimagenes, nombre, categoria, descripcion, archivo
        FROM
            imagenes
        ORDER BY
            idimagenes ASC";

        $result = $this->connection->query($sql);
        $this->mostrarImagenes($result);
    }

    // Método que obtiene imágenes por categoría
    function getImagenesPorCategoria($categoria)
    {
        $sql = "SELECT
            idimagenes, nombre, categoria, descripcion, archivo
        FROM
            imagenes
        WHERE
            categoria = '" . $categoria . "'
        ORDER BY
            idimagenes ASC";

        $result = $this->connection->query($sql);
        $this->mostrarImagenes($result);
    }

    // Método helper para mostrar las imágenes
    function mostrarImagenes($result)
    {
        $contador = 0;

        if ($result->num_rows > 0) {
            echo '<div class="w3-row-padding">';

            while ($row = $result->fetch_assoc()) {
                $contador++;

                $this->showImagen(
                    $row["nombre"],
                    $row["descripcion"],
                    $row["archivo"],
                    $row["categoria"]
                );

                // Crear nueva fila cada 3 elementos
                if ($contador % 3 == 0 && $contador < $result->num_rows) {
                    echo '</div><div class="w3-row-padding">';
                }
            }

            echo '</div>';
        } else {
            echo '<div class="w3-container w3-center w3-padding-64">';
            echo '<h3>No hay imágenes disponibles en esta categoría</h3>';
            echo '</div>';
        }
    }

    // Tu método showImagen permanece igual
    function showImagen($nombre, $descripcion, $foto, $categoria)
    {
        echo '<div class="w3-third w3-container w3-margin-bottom">';
        echo '<img src="../img/' . $foto . '" alt="' . $nombre . '" style="width:100%; height:190px;" class="w3-hover-opacity">';
        echo '<div class="w3-container w3-white">';
        echo '<p><b>' . $nombre . '</b></p>';
        echo '<p>' . $descripcion . '</p>';
        echo '</div>';
        echo '</div>';
    }


    // function showLineaUno($nombre, $descripcion, $foto)
    // {
    //     echo
    //         '<div class="w3-third w3-container w3-margin-bottom">
    //             <img src="../img/' . $foto . '" alt="Norway" style="width:100%" class="w3-hover-opacity">
    //             <div class="w3-container w3-white">
    //                 <p><b>' . $nombre . '</b></p>
    //                 <p>' . $descripcion . '</p>
    //             </div>
    //         </div>';
    // }

    // function primerLinea()
    // {
    //     $sql = "SELECT
    //             idimagenes, nombre, categoria, descripcion, archivo
    //         FROM
    //             imagenes
    //         WHERE idimagenes BETWEEN 1 and 3";
    //     $result = $this->connection->query($sql);
    //     if ($result->num_rows > 0) {
    //         while ($row = $result->fetch_assoc()) {
    //             $this->showLineaUno($row["nombre"], $row["descripcion"], $row["archivo"]);
    //         }
    //     }
    //     $this->connection->query($sql);
    // }

    // function showLineaDos($nombre, $descripcion, $foto)
    // {
    //     echo
    //         '<div class="w3-third w3-container w3-margin-bottom">
    //             <img src="../img/' . $foto . '" alt="Norway" style="width:100%" class="w3-hover-opacity">
    //             <div class="w3-container w3-white">
    //                 <p><b>' . $nombre . '</b></p>
    //                 <p>' . $descripcion . '</p>
    //             </div>
    //         </div>';
    // }

    // function segundaLinea()
    // {
    //     $sql = "SELECT
    //             idimagenes, nombre, descripcion, archivo
    //         FROM
    //             imagenes
    //         WHERE idimagenes BETWEEN 4 and 6";
    //     $result = $this->connection->query($sql);
    //     if ($result->num_rows > 0) {
    //         while ($row = $result->fetch_assoc()) {
    //             $this->showLineaUno($row["nombre"], $row["descripcion"], $row["archivo"]);
    //         }
    //     }
    //     $this->connection->query($sql);
    // }

    // function showLineaTres($nombre, $descripcion, $foto)
    // {
    //     echo
    //         '<div class="w3-third w3-container w3-margin-bottom">
    //             <img src="../img/' . $foto . '" alt="Norway" style="width:100%" class="w3-hover-opacity">
    //             <div class="w3-container w3-white">
    //                 <p><b>' . $nombre . '</b></p>
    //                 <p>' . $descripcion . '</p>
    //             </div>
    //         </div>';
    // }

    // function tercerLinea()
    // {
    //     $sql = "SELECT
    //             idimagenes, nombre, descripcion, archivo
    //         FROM
    //             imagenes
    //         WHERE idimagenes BETWEEN 7 and 9";
    //     $result = $this->connection->query($sql);
    //     if ($result->num_rows > 0) {
    //         while ($row = $result->fetch_assoc()) {
    //             $this->showLineaUno($row["nombre"], $row["descripcion"], $row["archivo"]);
    //         }
    //     }
    //     $this->connection->query($sql);
    // }

    // function getPaquetes()
    // {
    //     $sql = 'SELECT idpaquete, nombre, precio, descripcion, categoria FROM paquete';
    //     $result = $this->connection->query($sql);
    //     if ($result->num_rows > 0) {
    //         while ($row = $result->fetch_assoc()) {
    //             $this->showPaquete($row["idpaquete"], $row["nombre"], $row["precio"], $row["descripcion"], $row["categoria"]);
    //         }
    //     }
    // }

    function getPaquetes()
    {
        $sql = 'SELECT p.idpaquete, p.nombre, p.precio, p.descripcion, c.nombre as categoria 
            FROM paquete p 
            JOIN categorias c ON p.categoria = c.idcategorias';
        $result = $this->connection->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->showPaquete($row["idpaquete"], $row["nombre"], $row["precio"], $row["descripcion"], $row["categoria"]);
            }
        }
    }

    function showPaquete($id, $nombre, $precio, $descripcion, $categoria)
    {
        echo '<tr>';
        // echo '<td>'. $id .'</td>';
        echo '<td>' . $nombre . '</td>';
        echo '<td>';
        echo '<ul><li>' . $descripcion . '</li></ul>';
        echo '</td>';
        echo '<td>$' . $precio . '</td>';
        echo '<td>' . $categoria . '</td>';
        echo '<td><a href="editarpaquetes.php?id=' . $id . '&nombre=' . $nombre . '&precio=' . $precio . '&descripcion=' . $descripcion . '&categoria=' . $categoria . '"><button type="button" class="btn btn-warning">EDITAR</button></a></td>';
        echo '<td><button type="button" class="btn btn-danger" onclick="confirmarEliminacion(' . $id . ', \'' . $nombre . '\')">ELIMINAR</button></td>';
        echo '</tr>';
    }

    function deletePaque($id)
    {
        // Primero obtener el nombre del archivo para eliminarlo del servidor
        $sql = "SELECT nombre FROM paquete WHERE idpaquete = '$id'";
        $result = $this->connection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Eliminar el registro de la base de datos
            $sql = "DELETE FROM paquete WHERE idpaquete = '$id'";
            if ($this->connection->query($sql) === TRUE) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    // Método para verificar si existe una imagen
    function existePaque($id)
    {
        $sql = "SELECT idpaquete FROM paquete WHERE idpaquete = '$id'";
        $result = $this->connection->query($sql);
        return $result->num_rows > 0;
    }

    function updatePaquete($id, $nombre, $descripcion, $precio, $categoria)
    {
        $sql = "UPDATE
                paquete
            SET
                idpaquete = '$id',
                nombre = '$nombre',
                descripcion = '$descripcion',
                precio = '$precio',
                categoria = '$categoria'
            WHERE
                paquete . idpaquete = '$id'";
        $this->connection->query($sql);
    }

    function addPaque($nombre, $precio, $descripcion, $categoria)
    {
        $sql = "INSERT INTO
                `paquete` (nombre, precio, descripcion, categoria)
            VALUES
                ('$nombre', '$precio', '$descripcion', '$categoria');";
        $this->connection->query($sql);
    }

    // function getPaquetesIndex1()
    // {
    //     $sql = "SELECT 
    //             idpaquete, nombre, precio, descripcion 
    //         FROM 
    //             paquete
    //         WHERE 
    //             paquete.idpaquete = '1'";
    //     $result = $this->connection->query($sql);
    //     if ($result->num_rows > 0) {
    //         while ($row = $result->fetch_assoc()) {
    //             $this->showPaquete1($row["idpaquete"], $row["nombre"], $row["precio"], $row["descripcion"]);
    //         }
    //     }
    //     $this->connection->query($sql);
    // }

    // function getPaquetesIndex2()
    // {
    //     $sql = "SELECT 
    //             idpaquete, nombre, precio, descripcion 
    //             FROM 
    //             paquete
    //         WHERE 
    //             paquete.idpaquete = '2'";
    //     $result = $this->connection->query($sql);
    //     if ($result->num_rows > 0) {
    //         while ($row = $result->fetch_assoc()) {
    //             $this->showPaquete2($row["idpaquete"], $row["nombre"], $row["precio"], $row["descripcion"]);
    //         }
    //     }
    //     $this->connection->query($sql);
    // }

    // function getPaquetesIndex3()
    // {
    //     $sql = "SELECT 
    //             idpaquete, nombre, precio, descripcion 
    //             FROM 
    //             paquete
    //         WHERE 
    //             paquete.idpaquete = '3'";
    //     $result = $this->connection->query($sql);
    //     if ($result->num_rows > 0) {
    //         while ($row = $result->fetch_assoc()) {
    //             $this->showPaquete3($row["idpaquete"], $row["nombre"], $row["precio"], $row["descripcion"]);
    //         }
    //     }
    //     $this->connection->query($sql);
    // }

    // function showPaquete1($id, $nombre, $precio, $descripcion)
    // {
    //     echo '<div class="w3-third w3-margin-bottom">';
    //     echo '<ul class="w3-ul w3-border w3-white w3-center w3-opacity w3-hover-opacity-off">';
    //     echo '<li class="w3-black w3-xlarge w3-padding-32">' . $nombre . '</li>';
    //     echo '<li class="w3-padding-16">' . $descripcion . '</li>';
    //     echo '<li class="w3-padding-16">';
    //     echo '<h2>$' . $precio . '</h2>';
    //     echo '</li>';
    //     echo '</ul>';
    //     echo '</div>';
    // }

    // function showPaquete2($id, $nombre, $precio, $descripcion)
    // {
    //     echo '<div class="w3-third w3-margin-bottom">';
    //     echo '<ul class="w3-ul w3-border w3-white w3-center w3-opacity w3-hover-opacity-off">';
    //     echo '<li class="w3-black w3-xlarge w3-padding-32">' . $nombre . '</li>';
    //     echo '<li class="w3-padding-16">' . $descripcion . '</li>';
    //     echo '<li class="w3-padding-16">';
    //     echo '<h2>$' . $precio . '</h2>';
    //     echo '</li>';
    //     echo '</ul>';
    //     echo '</div>';
    // }

    // function showPaquete3($id, $nombre, $precio, $descripcion)
    // {
    //     echo '<div class="w3-third">';
    //     echo '<ul class="w3-ul w3-border w3-white w3-center w3-opacity w3-hover-opacity-off">';
    //     echo '<li class="w3-black w3-xlarge w3-padding-32">' . $nombre . '</li>';
    //     echo '<li class="w3-padding-16">' . $descripcion . '</li>';
    //     echo '<li class="w3-padding-16">';
    //     echo '<h2>$' . $precio . '</h2>';
    //     echo '</li>';
    //     echo '</ul>';
    //     echo '</div>';
    // }

    function getAllPaquetes()
    {
        $sql = "SELECT 
            idpaquete, nombre, precio, descripcion, categoria
        FROM 
            paquete 
        ORDER BY 
            idpaquete ASC";

        $result = $this->connection->query($sql);
        $contador = 0;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $contador++;

                // Determinar la clase CSS según la posición
                $claseCSS = $this->getClaseCSS($contador, $result->num_rows);

                $this->showPaquete2(
                    $row["idpaquete"],
                    $row["nombre"],
                    $row["precio"],
                    $row["descripcion"],
                    $row["categoria"],
                    $claseCSS
                );

                // Crear nueva fila cada 3 elementos (opcional)
                if ($contador % 3 == 0 && $contador < $result->num_rows) {
                    echo '</div><div class="w3-row-padding" style="margin:0 -16px">';
                }
            }
        }
    }

    // Método para determinar la clase CSS
    function getClaseCSS($posicion, $total)
    {
        $resto = $posicion % 3;
        $esUltimo = ($posicion == $total);

        if ($resto == 1) {
            // Primer elemento de la fila
            return "w3-third w3-margin-bottom";
        } elseif ($resto == 2) {
            // Segundo elemento de la fila
            return "w3-third w3-margin-bottom";
        } else {
            // Tercer elemento de la fila
            return $esUltimo ? "w3-third" : "w3-third w3-margin-bottom";
        }
    }

    // Método único para mostrar cualquier paquete
    function showPaquete2($id, $nombre, $precio, $descripcion, $categoria, $claseCSS)
    {
        echo '<div class="' . $claseCSS . '">';
        echo '<ul class="w3-ul w3-border w3-white w3-center w3-opacity w3-hover-opacity-off">';
        echo '<li class="w3-black w3-xlarge w3-padding-32">' . $nombre . '</li>';

        // Mostrar categoría si existe
        if (!empty($categoria)) {
            echo '<li class="w3-light-grey w3-padding-8"><small>Categoría: ' . $categoria . '</small></li>';
        }

        echo '<li class="w3-padding-16">' . $descripcion . '</li>';
        echo '<li class="w3-padding-16">';
        echo '<h2>$' . $precio . '</h2>';
        echo '</li>';
        echo '</ul>';
        echo '</div>';
    }


    function existeUser($email, $password)
    {
        $sql = "SELECT id, nombre, email, pass FROM usuario WHERE email = '$email' and pass = SHA2('$password', 256)";
        $result = $this->connection->query($sql);
        return $result->num_rows > 0;
    }

    // Para guardar comentarios
    function guardarComentario($nombre, $comentario)
    {
        $fecha = date('Y-m-d');
        $sql = "INSERT INTO comentarios (fecha, nombre, descripcion) VALUES (?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("sss", $fecha, $nombre, $comentario);
        return $stmt->execute();
    }

    // Para obtener comentarios
    function obtenerComentarios()
    {
        $sql = "SELECT fecha, nombre, descripcion FROM comentarios ORDER BY fecha DESC, idcomentarios DESC";
        $result = $this->connection->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function getComentarios()
    {
        $sql = 'SELECT fecha, nombre, descripcion FROM comentarios ORDER BY fecha DESC, idcomentarios DESC';
        $result = $this->connection->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->showComentarios($row["fecha"], $row["nombre"], $row["descripcion"]);
            }
        } else {
            echo '<p class="text-muted">No hay comentarios aún. ¡Sé el primero en comentar!</p>';
        }
    }

    function showComentarios($fecha, $nombre, $descripcion)
    {
        // echo '<tr>';
        // // echo '<td>'. $id .'</td>';
        // echo '<td>' . $nombre . '</td>';
        // echo '<td>';
        // echo '<ul><li>' . $descripcion . '</li></ul>';
        // echo '</td>';
        // echo '<td>$' . $precio . '</td>';
        // echo '<td>' . $categoria . '</td>';
        // echo '<td><a href="editarpaquetes.php?id=' . $id . '&nombre=' . $nombre . '&precio=' . $precio . '&descripcion=' . $descripcion . '&categoria=' . $categoria . '"><button type="button" class="btn btn-warning">EDITAR</button></a></td>';
        // echo '<td><button type="button" class="btn btn-danger" onclick="confirmarEliminacion(' . $id . ', \'' . $nombre . '\')">ELIMINAR</button></td>';
        // echo '</tr>';

        echo '<div class="card mb-3">';
        echo '  <div class="card-body">';
        echo '    <h5 class="card-title">' . htmlspecialchars($nombre) . '</h5>';
        echo '    <h6 class="card-subtitle mb-2 text-muted">' . date('d/m/Y', strtotime($fecha)) . '</h6>';
        echo '    <p class="card-text">' . nl2br(htmlspecialchars($descripcion)) . '</p>';
        echo '  </div>';
        echo '</div>';
    }
}
?>