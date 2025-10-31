<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Mi sitio' ?></title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/components.css">
    <link rel="stylesheet" href="./css/layout/layout.css">
    <link rel="stylesheet" href="./css/layout/header.css">
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

            <div class="options">
                <nav>
                    <a href="./index.php?view=home">Inicio</a>
                    <a href="./index.php?view=home">Tienda</a>
                    <a href="./index.php?view=contactos">Contactos</a>
                    <a href="./index.php?view=empresa">Nosotros</a>
                </nav>

                |

                <svg class='profile-icon' xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="-5.0 -10.0 110.0 135.0">
                    <path fill='none' d="m49.996 0c-12.969 0-23.527 10.586-23.527 23.555 0 12.965 10.562 23.527 23.527 23.527 12.969 0 23.555-10.562 23.555-23.527 0-12.965-10.586-23.555-23.555-23.555zm0 6.25c9.5898 0 17.305 7.7148 17.305 17.305 0 9.5898-7.7148 17.277-17.305 17.277s-17.297-7.6914-17.297-17.277c0-9.5898 7.707-17.305 17.297-17.305zm0 43.719c-23.359 0-42.262 18.902-42.262 42.262v4.6562c0.003906 0.82812 0.33594 1.6211 0.92578 2.207 0.58984 0.58203 1.3828 0.91016 2.2148 0.90625 1.7188-0.003906 3.1094-1.3945 3.1172-3.1133v-4.6562c0-20.004 16-36.012 36.004-36.012s36.012 16.008 36.012 36.012v4.6562c0.003907 0.82812 0.33594 1.6211 0.92188 2.207 0.58984 0.58203 1.3867 0.91016 2.2148 0.90625 1.7188-0.003906 3.1133-1.3945 3.1211-3.1133v-4.6562c0-23.359-18.906-42.262-42.266-42.262z"/>
                </svg> 

            
            </div>


            <div class="user-options">
                    <h3>Bienvenido, <?= $_SESSION['usuario'] ?></h3>

                    <div class="actions">
                    
                        <?php if ($_SESSION['rol'] === 'usuario'): ?>
                            <a class="button primary" href="perfil.php">Mi Perfil</a>
                        <?php endif; ?>


                        <?php if ($_SESSION['rol'] === 'admin'): ?>
                            <a href="./index.php?view=registro_usuario" >Registrar nuevo usuario</a>
                            <a href="./index.php?view=usuarios" >Ver usuarios</a>
                            <a href="./controllers/reportes/reporte_usuarios.php"  target="_blank">Descargar PDF Usuarios</a>
                            <?php endif; ?>

                    </div>


                    <a href="./controllers/logout.php" class="button secondary">Cerrar sesión</a>

            </div>
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
    <script src='./js/interaction.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>
