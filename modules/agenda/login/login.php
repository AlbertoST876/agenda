<?php
/**
 * @ Author: Alberto Sanchez Torreblanca
 * @ Create Time: 04-04-2022 22:47:34
 * @ Modified by: Alberto Sanchez Torreblanca
 * @ Modified time: 01-06-2022 11:40:16
 * @ Description: Funciones para el usuario poder iniciar sesión
 */

/**
 * Inicia la sesión del usuario
 *
 * @param string $nombre
 * @param string $contraseña
 * @return array
 */
function IniciarSesion(string $nombre, string $contraseña):array {
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
                    echo "<span>Tus credenciales son incorrectas, inténtalo de nuevo</span>";
                }
            } else {
                echo "<span>Tus credenciales son incorrectas, inténtalo de nuevo</span>";
            }
        } else {
            echo "<span>Ha ocurrido un error, inténtalo de nuevo mas tarde</span>";
        }
    }

    mysqli_close($connect);
}

/**
 * Comprueba si el usuario es único y correcto
 *
 * @param mysqli $connect
 * @param string $nombre
 * @return bool
 */
function EsCorrectoUsuario(mysqli $connect, string $nombre):bool {
    $SQL = "SELECT username FROM users WHERE username = '$nombre'";
    $result = mysqli_query($connect, $SQL);

    return mysqli_num_rows($result) == 1;
}

/**
 * Comprueba si la contraseña del usuario es correcta
 * 
 * @param mysqli $connect
 * @param string $nombre
 * @param string $contraseña
 * @return bool
 */
function EsCorrectaContraseña(mysqli $connect, string $nombre, string $contraseña):bool {
    $SQL = "SELECT password FROM users WHERE username = '$nombre'";
    $result = mysqli_query($connect, $SQL);
    $row = mysqli_fetch_assoc($result);
        
    return password_verify($contraseña, $row["password"]);
}

/**
 * Actualiza en la base de datos el ultimo acceso del usuario
 *
 * @param mysqli $connect
 * @param int $id
 * @param string $date
 * @return void
 */
function ActualizarUltimoAcceso(mysqli $connect, int $id, string $date):void {
    $SQL = "UPDATE users SET ultimoacceso = '$date' WHERE id = '$id'";
    mysqli_query($connect, $SQL);
}

?>