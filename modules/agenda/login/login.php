<?php
/**
 * @ Author: Alberto Sanchez Torreblanca
 * @ Create Time: 04-04-2022 22:47:34
 * @ Modified by: Alberto Sanchez Torreblanca
 * @ Modified time: 12-04-2022 02:01:19
 * @ Description: Funciones para el usuario poder iniciar sesión
 */

/**
 * Inicia la sesión del usuario
 *
 * @param String $nombre
 * @param String $contraseña
 * @return Array
 */
function IniciarSesion($nombre, $contraseña) {
    include "./modules/db/db.php";

    if (empty($nombre) || empty($contraseña)) {
        echo "<span>Faltan uno o más campos por rellenar</span>";
    } else {
        $nombre = mysqli_real_escape_string($connect, $nombre);
        $contraseña = mysqli_real_escape_string($connect, $contraseña);
        $date = date("d/m/Y - H:i:s");
    
        if ($connect) {
            if (EsCorrectoUsuario($connect, $nombre)) {
                if (EsCorrectaContraseña($connect, $nombre, $contraseña)) {
                    $usuario = ObtenerUsuarioPorNombre($connect, $nombre);
                    ActualizarUltimoAcceso($connect, $usuario["id"], $date);
                    
                    mysqli_close($connect);
                    
                    return $usuario;
                } else {
                    echo "<span>Tus credenciales son incorrectas, intentalo de nuevo</span>";
                }
            } else {
                echo "<span>Tus credenciales son incorrectas, intentalo de nuevo</span>";
            }
        } else {
            echo "<span>Ha ocurrido un error, intentalo de nuevo mas tarde</span>";
        }
    }

    mysqli_close($connect);
}

/**
 * Comprueba si el usuario es único y correcto
 *
 * @param Mysqli $connect
 * @param String $nombre
 * @return Bool
 */
function EsCorrectoUsuario($connect, $nombre) {
    $SQL = "SELECT username FROM users WHERE username = '$nombre'";
    $result = mysqli_query($connect, $SQL);

    return mysqli_num_rows($result) == 1;
}

/**
 * Comprueba si la contraseña del usuario es correcta
 * 
 * @param Mysqli $connect
 * @param String $nombre
 * @param String $contraseña
 * @return Bool
 */
function EsCorrectaContraseña($connect, $nombre, $contraseña) {
    $SQL = "SELECT password FROM users WHERE username = '$nombre'";
    $result = mysqli_query($connect, $SQL);
    $row = mysqli_fetch_assoc($result);
        
    return password_verify($contraseña, $row["password"]);
}

/**
 * Actualiza en la base de datos el ultimo acceso del usuario
 *
 * @param Mysqli $connect
 * @param Int $id
 * @param String $date
 * @return void
 */
function ActualizarUltimoAcceso($connect, $id, $date) {
    $SQL = "UPDATE users SET ultimoacceso = '$date' WHERE id = '$id'";
    mysqli_query($connect, $SQL);
}

?>