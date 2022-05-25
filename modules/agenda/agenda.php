<?php
/**
 * @ Author: Alberto Sanchez Torreblanca
 * @ Create Time: 03-04-2022 13:39:53
 * @ Modified by: Alberto Sanchez Torreblanca
 * @ Modified time: 13-04-2022 03:31:17
 * @ Description: Lógica de la agenda para poder funcionar correctamente
 */

if (isset($_POST["register"])) {
    $usuario = RegistrarUsuario($_POST["username"], $_POST["password"], $_POST["email"]);
} elseif (isset($_POST["login"])) {
    $usuario = IniciarSesion($_POST["username"], $_POST["password"]);
} elseif (isset($_POST["agregar"])) {
    $usuario = NuevoEvento($_POST["id"], $_POST["categoria"], $_POST["nombre"], $_POST["descripcion"], $_POST["recordar"]);
} elseif (isset($_POST["borrar"])) {
    $usuario = BorrarEvento($_POST["id"], $_POST["event"]);
} else {
    echo "<span>Para acceder a tu Agenda antes debes Iniciar Sesión</span>";
}

if (!isset($usuario) || empty($usuario)) {
    include "./modules/agenda/login/login_form.php";
} else {
    //Obtener Credenciales de Usuario
    $id = $usuario["id"];
    $nombre = $usuario["username"];
    $email = $usuario["email"];

    //Bienvenida
    echo "<h2>" . $nombre . "</h2>";

    //Formulario para agregar eventos
    include "./modules/agenda/new/new_form.php";

    //Presentación de los eventos
    ObtenerEventosUsuario($id);
}

?>