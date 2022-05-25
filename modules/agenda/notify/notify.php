<?php

// Conexion a la Base de Datos
include "../db/db.php";

// Obtencion de Datos
$now = date("Y-m-d");
$yesterday = date("Y-m-d", strtotime($now . " - 1 day"));

$eventos = "SELECT * FROM events WHERE DATEDIFF('$now', '$yesterday') <= 1";
$event = mysqli_query($connect, $eventos);

while ($evento = mysqli_fetch_assoc($event)) {
    $userid = $evento["userid"];
    $nombre = $evento["nombre"];
    $descripcion = $evento["descripcion"];

    // Obtener Usuario
    $usuarios = "SELECT email FROM users WHERE id = '$userid'";
    $users = mysqli_query($connect, $usuarios);
    $usuario = mysqli_fetch_assoc($users);

    // Enviar Correo
    $email = $usuario["email"];
    $correo = mail($email, $nombre, $descripcion);

    $resultado = $correo ? "Enviado" : "Error";
    echo $resultado;
}

mysqli_close($connect);

?>