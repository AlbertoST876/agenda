<?php
/**
 * @ Author: Alberto Sanchez Torreblanca
 * @ Create Time: 12-04-2022 02:18:57
 * @ Modified by: Alberto Sanchez Torreblanca
 * @ Modified time: 13-04-2022 03:33:17
 * @ Description: Función que muestra los eventos de determinado usuario
 */

/**
 * Obtiene los eventos categorizados de un usuario
 *
 * @param Int $usuario
 * @return Void
 */
function ObtenerEventosUsuario($usuario) {
    include "./modules/db/db.php";

    $SQL = "SELECT * FROM categories";
    $result = mysqli_query($connect, $SQL);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<h3>" . $row["nombre"] . "s</h3>";
        
        ObtenerEventosCategoria($connect, $usuario, $row["id"]);
    }

    mysqli_close($connect);
}

/**
 * Obtiene los eventos de una categoría y de un usuario especificado
 *
 * @param Mysqli $connect
 * @param Int $usuario
 * @param Int $categoria
 * @return Void
 */
function ObtenerEventosCategoria($connect, $usuario, $categoria) {
    $SQL = "SELECT id, nombre, descripcion, DATE_FORMAT(fecha, '%d/%m/%Y') AS fechaESP FROM events WHERE usuario = '$usuario' AND categoria = '$categoria'";
    $result = mysqli_query($connect, $SQL);

    echo "
        <table>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
    ";

    while ($row = mysqli_fetch_assoc($result)) {
        if ($result) {
            echo "

                <tr>
                    <td>" . $row["nombre"] . "</td>
                    <td>" . $row["descripcion"] . "</td>
                    <td>" . $row["fechaESP"] . "</td>

                    <td>
                        <form action='./agenda.php' method='post'>
                            <input type='hidden' name='id' value='$usuario'>
                            <input type='hidden' name='event' value=" . $row["id"] . ">
                            <input type='submit' name='borrar' value='Borrar'>
                        </form>
                    </td>
                </tr>
            ";
        } else {
            echo "
                <tr>
                    <td colspan='4'>Ha ocurrido un error, intentalo de nuevo más tarde</td>
                </tr>
            ";
        }
    }

    echo "</table>";
}

?>