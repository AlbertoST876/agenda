<?php
/**
 * @ Author: Alberto Sanchez Torreblanca
 * @ Create Time: 23-05-2022 10:05:58
 * @ Modified by: Alberto Sanchez Torreblanca
 * @ Modified time: 01-06-2022 11:41:38
 * @ Description: Librería en cargada de notificar por correo
 */

/**
 * Notifica a todos los usuarios por correo los eventos que quedan menos de un dia
 *
 * @return void
 */
function NotificarPorCorreo():void {
    // Conexión a la Base de Datos
    include "../db/db.php";

    // Obtiene los eventos que tienen un dia menos al actual
    $now = date("Y-m-d");
    $yesterday = date("Y-m-d", strtotime($now . " - 1 day"));

    // Obtención de Datos
    $SQL = "SELECT * FROM events WHERE DATEDIFF('$now', '$yesterday') <= 1";
    $result = mysqli_query($connect, $SQL);

    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row["userid"];
        $nombre = $row["nombre"];
        $descripcion = $row["descripcion"];

        // Obtener Email Usuario
        $email = ObtenerEmailUsuario($connect, $id);

        // Enviar Correo
        echo EnviarCorreo($email, $nombre, $descripcion);
    }

    mysqli_close($connect);
}

/**
 * Obtiene el email de un usuario por su id
 *
 * @param mysqli $connect
 * @param int $id
 * @return string
 */
function ObtenerEmailUsuario(mysqli $connect, int $id):string {
    $SQL = "SELECT email FROM users WHERE id = '$id'";
    $result = mysqli_query($connect, $SQL);
    $row = mysqli_fetch_assoc($result);

    return $row["email"];
}

/**
 * Enviar el correo final al usuario
 *
 * @param string $destino
 * @param string $asunto
 * @param string $cuerpo
 * @return string
 */
function EnviarCorreo(string $destino, string $asunto, string $cuerpo):string {
    return mail($destino, $asunto, $cuerpo) ? "Enviado" : "Error";
}

NotificarPorCorreo();

?>