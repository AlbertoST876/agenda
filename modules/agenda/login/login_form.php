<?php
/**
 * @ Author: Alberto Sanchez Torreblanca
 * @ Create Time: 04-04-2022 22:47:34
 * @ Modified by: Alberto Sanchez Torreblanca
 * @ Modified time: 23-05-2022 18:07:54
 * @ Description: Formulario de inicio de sesión en HTML
 */
?>

<aside>
    <form action="./agenda.php" method="post">
        <label for="username">Nombre de Usuario:</label>
        <input type="text" name="username" maxlength="25" required>
    
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>
    
        <input type="submit" name="login" value="Iniciar Sesión">
        <div><a href="./register.html">Registrarse ahora</a></div>
    </form>
</aside>