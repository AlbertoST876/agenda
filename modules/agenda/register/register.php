<?php
/**
 * @ Author: Alberto Sanchez Torreblanca
 * @ Create Time: 03-04-2022 13:39:53
 * @ Modified by: Alberto Sanchez Torreblanca
 * @ Modified time: 12-04-2022 02:02:01
 * @ Description: Funciones que registran al usuario en la base de datos
 */

/**
 * Registra al usuario en la base de datos
 *
 * @param String $nombre
 * @param String $contraseña
 * @param String $email
 * @return Array|Void
 */
function RegistrarUsuario($nombre, $contraseña, $email) {
    include "./modules/db/db.php";

    if (empty($nombre) || empty($contraseña) || empty($email)) {
        echo "<span>Faltan uno o más campos por rellenar</span>";
    } else {
        $nombre = mysqli_real_escape_string($connect, $nombre);
        $contraseña = mysqli_real_escape_string($connect, password_hash($contraseña, PASSWORD_DEFAULT));
        $email = mysqli_real_escape_string($connect, $email);
        $date = date("d/m/Y - H:i:s");

        if (EstaLibreNombreUsuario($connect, $nombre)) {
            $SQL = "INSERT INTO users(username, password, email, ultimoacceso, registrado) VALUES ('$nombre', '$contraseña', '$email', '$date', '$date')";
            $result = mysqli_query($connect, $SQL);

            if ($result) {
                mysqli_close($connect);

                return ObtenerUsuarioPorNombre($connect, $nombre);
            } else {
                echo "<span>Ha ocurrido un error, intentalo de nuevo mas tarde</span>";
            }
        } else {
            echo "<span>Ya existe este nombre de usuario, por favor utiliza otro distinto</span>";
        }
    }

    mysqli_close($connect);
}

/**
 * Comprueba si existe un usuario con el mismo nombre introducido, si no hay coincidencias devuelve true
 *
 * @param Mysqli $connect
 * @param String $nombre
 * @return Bool
 */
function EstaLibreNombreUsuario($connect, $nombre) {
    $SQL = "SELECT username FROM users WHERE username = '$nombre'";
    $result = mysqli_query($connect, $SQL);

    return mysqli_num_rows($result) == 0;
}

/**
 * Si el registro se ha llevado con éxito, devuelve la información del usuario
 *
 * @param Mysqli $connect
 * @param String $nombre
 * @return Array
 */
function ObtenerUsuarioPorNombre($connect, $nombre) {
    $SQL = "SELECT id, username, email FROM users WHERE username = '$nombre'";
    $result = mysqli_query($connect, $SQL);
    
    return mysqli_fetch_assoc($result);
}

/**
 * Devuelve la información del usuario por su id
 *
 * @param Mysqli $connect
 * @param Int $id
 * @return Array
 */
function ObtenerUsuarioPorID($connect, $id) {
    $SQL = "SELECT id, username, email FROM users WHERE id = '$id'";
    $result = mysqli_query($connect, $SQL);
    
    return mysqli_fetch_assoc($result);
}

?>