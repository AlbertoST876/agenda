<?php
/**
 * @ Author: Alberto Sanchez Torreblanca
 * @ Create Time: 04-04-2022 22:47:35
 * @ Modified by: Alberto Sanchez Torreblanca
 * @ Modified time: 12-04-2022 01:59:58
 * @ Description: Formulario para registrar un evento en HTML
 */
?>

<details>
    <summary><h3 class="new">Nuevo</h3></summary>

    <form class="new" action="./agenda.php" method="post">
        <select name="categoria" required>
            <?php ObtenerListaCategorias(); ?>
        </select>
        
        <label for="nombre">Titulo:</label>
        <input type="text" name="nombre" maxlength="50" required>
        
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" maxlength="200" required></textarea>
        
        <label for="recordar">Fecha (se recordará el dia anterior):</label>
        <input type="date" name="recordar" value=<?php echo date("Y-m-d"); ?> min=<?php echo date("Y-m-d"); ?> max="2030-12-31" required>
        
        <input type='hidden' name='id' value=<?php echo $id; ?>>
        <input type="submit" name="agregar" value="Agregar">
        <input type="reset" value="Borrar">
    </form>
</details>