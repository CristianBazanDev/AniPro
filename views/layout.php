<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Mi sitio' ?></title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/components.css">
    <link rel="stylesheet" href="./css/layout.css">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/register-client.css">
    <link rel="stylesheet" href="./css/clients.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous"></head>
<body>
    <article class="layout">
        <header>
            <a href="./index.php?view=home" style="color: #ffffff !important">
                <h1><?= $title ?? 'Mi sitio' ?></h1>
            </a>
   
            <nav>
                <a href="./index.php?view=home">Inicio</a>
                <a href="./index.php?view=contactos">Contactos</a>
                <a href="./index.php?view=empresa">Nosotros</a>
            </nav>
        </header>

        <main>
            <?php
            if (isset($content)) {
                echo $content;
            }
            ?>
        </main>

        <footer>
            <p>Todos los derechos reservados <?= date('Y') ?></p>
        </footer>
    </article>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>
