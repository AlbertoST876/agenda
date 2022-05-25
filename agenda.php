<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Alberto Sánchez Torreblanca">

        <?php include "./modules/functions.php"; ?>

        <link rel="stylesheet" href="./resources/style.css">
        <link rel="icon" href="./resources/icon.png">
        <title>Agenda - Mi Agenda</title>
    </head>

    <body>
        <header>
            <nav>
                <a href="./index.html"><img src="./resources/icon.png"></a>

                <ul>
                    <li><a href="./index.html">Inicio</a></li>
                    <li><a id="actual" href="./agenda.php">Mi Agenda</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <h1>Mi Agenda</h1>

            <hr>

            <?php include "./modules/agenda/agenda.php"; ?>
        </main>
    </body>
</html>