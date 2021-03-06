<?php
/**
 * @ Author: Alberto Sanchez Torreblanca
 * @ Create Time: 04-04-2022 22:47:34
 * @ Modified by: Alberto Sanchez Torreblanca
 * @ Modified time: 04-06-2022 13:32:12
 * @ Description: Función que elimina un evento de la base de datos
 */

/**
 * Borra un evento de la base de datos
 *
 * @param int $id
 * @param int $evento
 * @return array|void
 */
function BorrarEvento(int $id, int $evento):array {
    include "./modules/db/db.php";

    $SQL = "DELETE FROM events WHERE (id = '$evento')";
    $result = mysqli_query($connect, $SQL);

    if ($result) {
        return ObtenerUsuarioPorID($connect, $id);
    } else {
        echo "<span>Ha ocurrido un error, inténtalo de nuevo más tarde</span>";
    }

    mysqli_close($connect);

    return [];
}

?>