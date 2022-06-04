<?php
/**
 * @ Author: Alberto Sanchez Torreblanca
 * @ Create Time: 03-04-2022 13:39:53
 * @ Modified by: Alberto Sanchez Torreblanca
 * @ Modified time: 04-06-2022 13:34:37
 * @ Description: Funciones que registran al usuario en la base de datos
 */

/**
 * Registra al usuario en la base de datos
 *
 * @param string $nombre
 * @param string $contraseña
 * @param string $email
 * @return array
 */
function RegistrarUsuario(string $nombre, string $contraseña, string $email):array {
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
                echo "<span>Ha ocurrido un error, inténtalo de nuevo mas tarde</span>";
            }
        } else {
            echo "<span>Ya existe este nombre de usuario, por favor utiliza otro distinto</span>";
        }
    }

    mysqli_close($connect);

    return [];
}

/**
 * Comprueba si existe un usuario con el mismo nombre introducido, si no hay coincidencias devuelve true
 *
 * @param mysqli $connect
 * @param string $nombre
 * @return bool
 */
function EstaLibreNombreUsuario(mysqli $connect, string $nombre):bool {
    $SQL = "SELECT username FROM users WHERE username = '$nombre'";
    $result = mysqli_query($connect, $SQL);

    return mysqli_num_rows($result) == 0;
}

/**
 * Si el registro se ha llevado con éxito, devuelve la información del usuario
 *
 * @param mysqli $connect
 * @param string $nombre
 * @return array
 */
function ObtenerUsuarioPorNombre(mysqli $connect, string $nombre):array {
    $SQL = "SELECT id, username, email FROM users WHERE username = '$nombre'";
    $result = mysqli_query($connect, $SQL);
    
    return mysqli_fetch_assoc($result);
}

/**
 * Devuelve la información del usuario por su id
 *
 * @param mysqli $connect
 * @param int $id
 * @return array
 */
function ObtenerUsuarioPorID(mysqli $connect, int $id):array {
    $SQL = "SELECT id, username, email FROM users WHERE id = '$id'";
    $result = mysqli_query($connect, $SQL);
    
    return mysqli_fetch_assoc($result);
}

?>