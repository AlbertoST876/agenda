<?php
/**
 * @ Author: Alberto Sanchez Torreblanca
 * @ Create Time: 04-04-2022 22:47:35
 * @ Modified by: Alberto Sanchez Torreblanca
 * @ Modified time: 13-04-2022 03:29:00
 * @ Description: Funciones para insertar un nuevo evento en la base de datos
 */

/**
 * Inserta en la base de datos un nuevo evento
 *
 * @param Int $id
 * @param Int $category
 * @param String $nombre
 * @param String $descripcion
 * @param String $recordar
 * @return Array|Void
 */
function NuevoEvento($id, $category, $nombre, $descripcion, $recordar) {
    include "./modules/db/db.php";

    if (empty($category) || empty($nombre) || empty($descripcion)) {
        echo "<span>Faltan uno o más campos por rellenar</span>";
    } else {
        $nombre = mysqli_real_escape_string($connect, $nombre);
        $descripcion = mysqli_real_escape_string($connect, $descripcion);
        $date = date("d/m/Y - H:i:s");

        $SQL = "INSERT INTO events (usuario, categoria, nombre, descripcion, fecha, ultimaedicion, registrado) VALUES ('$id', '$category', '$nombre', '$descripcion', '$recordar', '$date', '$date')";
        $result = mysqli_query($connect, $SQL);

        if ($result) {
            return ObtenerUsuarioPorID($connect, $id);
        } else {
            echo "<span>Ha ocurrido un error, intentalo de nuevo más tarde</span>";
        }
    }

    mysqli_close($connect);
}

/**
 * Devuelve las categorías de los eventos
 *
 * @return Void
 */
function ObtenerListaCategorias() {
    include "./modules/db/db.php";

    $SQL = "SELECT * FROM categories";
    $result = mysqli_query($connect, $SQL);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value=" . $row["id"] . ">" . $row["nombre"] . "</option>";
    }

    mysqli_close($connect);
}

?>