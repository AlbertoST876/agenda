<?php
/**
 * @ Author: Alberto Sanchez Torreblanca
 * @ Create Time: 03-04-2022 13:39:53
 * @ Modified by: Alberto Sanchez Torreblanca
 * @ Modified time: 25-05-2022 09:49:11
 * @ Description: Librería con la conexión a la base de datos
 */

// Rellene los siguientes campos para la conexión a su base de datos
$hostname = ""; // Servidor - Por defecto: "localhost"
$username = ""; // Usuario - Por defecto: "root"
$password = ""; // Contraseña
$database = ""; // Base de Datos - Por defecto: "es_agenda"

$connect = mysqli_connect($hostname, $username, $password, $database);
mysqli_set_charset($connect, "UTF8");

if (!$connect) {
    die("<p>Fallo al conectar con la Base de Datos: " . mysqli_connect_error() . "</p>");
}

?>