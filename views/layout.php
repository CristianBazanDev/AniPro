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
        <link rel="stylesheet" href="./css/shop.css">

    <link rel="stylesheet" href="./css/register-client.css">
    <link rel="stylesheet" href="./css/clients.css">

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous"></head>


    <body>  
    <article class="layout">
        <header>
            <a href="./index.php?view=home" style="color: #ffffff !important">
                <!-- <h1><?= $title ?? 'Mi sitio' ?></h1> -->
                    <img class='logo' src="./public/assets/img/logo/logo.png" alt="">
            </a>

            <div class="options">
                <nav>
                    <a href="./index.php?view=home">Inicio</a>
                    <a href="./index.php?view=tienda">Tienda</a>
                    <a href="./index.php?view=contacto">Contacto</a>
                    <a href="./index.php?view=empresa">Nosotros</a>
                </nav>

                |

                <svg class='profile-icon' xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="-5.0 -10.0 110.0 135.0">
                    <path fill='none' d="m49.996 0c-12.969 0-23.527 10.586-23.527 23.555 0 12.965 10.562 23.527 23.527 23.527 12.969 0 23.555-10.562 23.555-23.527 0-12.965-10.586-23.555-23.555-23.555zm0 6.25c9.5898 0 17.305 7.7148 17.305 17.305 0 9.5898-7.7148 17.277-17.305 17.277s-17.297-7.6914-17.297-17.277c0-9.5898 7.707-17.305 17.297-17.305zm0 43.719c-23.359 0-42.262 18.902-42.262 42.262v4.6562c0.003906 0.82812 0.33594 1.6211 0.92578 2.207 0.58984 0.58203 1.3828 0.91016 2.2148 0.90625 1.7188-0.003906 3.1094-1.3945 3.1172-3.1133v-4.6562c0-20.004 16-36.012 36.004-36.012s36.012 16.008 36.012 36.012v4.6562c0.003907 0.82812 0.33594 1.6211 0.92188 2.207 0.58984 0.58203 1.3867 0.91016 2.2148 0.90625 1.7188-0.003906 3.1133-1.3945 3.1211-3.1133v-4.6562c0-23.359-18.906-42.262-42.266-42.262z"/>
                </svg> 

            
            </div>


            <div class="user-options">

                    <div class="titles">
                            <h3>Bienvenido, <?= $_SESSION['usuario'] ?></h3>
                            <a href="./index.php?view=profile">Mi Perfil</a>
                    </div>
                    
                    <div class="actions">
                    
                        <?php if ($_SESSION['rol'] === 'admin'): ?>
                            <div class="section">
                                <h5>Ventas</h5>
                                <a href="./index.php?view=usuarios" >Ver</a>
                                <a href="./controllers/reportes/reporte_usuarios.php?tipo=ventas"  target="_blank">Reporte de ventas</a>
                            </div>
                            
                            <div class="section">
                                <h5>Vendedores</h5>
                                <a href="./index.php?view=registro_usuario" >Registrar nuevo vendedor</a>
                                <a href="./controllers/reportes/reporte_usuarios.php?tipo=vendedores"  target="_blank">Reporte de vendedores</a>
                            </div>

                            <div class="section">
                                <h5>Usuarios</h5>
                                <a href="./index.php?view=usuarios" >Ver usuarios</a>
                                <a href="./controllers/reportes/reporte_usuarios.php?tipo=usuarios"  target="_blank">Reporte de usuarios</a>
                            </div>
                            
                            <div class="section">
                                <h5>Productos</h5>
                                <a href="./index.php?view=tienda" >Ver productos</a>
                                <a href="./index.php?view=crear_producto" >Crear nuevo producto</a>
                            </div>
                            
                            <?php endif; ?>

                        <?php if ($_SESSION['rol'] === 'seller'): ?>
                            <div class="section">
                                <h5>Ventas</h5>
                                <a href="./index.php?view=usuarios" >Ver</a>
                                <a href="./controllers/reportes/reporte_usuarios.php?tipo=ventas"  target="_blank">Reporte de ventas</a>
                            </div>
                            
                            <div class="section">
                                <h5>Productos</h5>
                                <a href="./index.php?view=tienda" >Ver productos</a>
                                <a href="./index.php?view=crear_producto" >Crear nuevo producto</a>
                            </div>
                            
                            
                        <?php endif; ?>

                        <?php if ($_SESSION['rol'] === 'user'): ?>
                            <div class="section">
                                <h5>Favoritos</h5>
                                <a href="./index.php?view=usuarios" >Ver favoritos</a>
                            </div>

                            <div class="section">
                                <h5>Compras</h5>
                                <a href="./index.php?view=usuarios" >Ver compras</a>
                                <a href="./controllers/reportes/reporte_usuarios.php?tipo=compras"  target="_blank">Reporte de compras</a>
                            </div>    
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

    <!-- Modal de Usuario Creado -->
    <?php if (isset($_SESSION['usuario_creado'])): 
        $usuario_creado = $_SESSION['usuario_creado'];
        unset($_SESSION['usuario_creado']); // Limpiar la sesión después de guardar en variable
    ?>
    <div class="modal fade" id="usuarioCreadoModal" tabindex="-1" aria-labelledby="usuarioCreadoModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="usuarioCreadoModalLabel">
                        ✓ Usuario registrado exitosamente
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p class="mb-1"><strong>Usuario:</strong> <?= htmlspecialchars($usuario_creado['usuario']) ?></p>
                        <?php if (!empty($usuario_creado['email'])): ?>
                            <p class="mb-1"><strong>Email:</strong> <?= htmlspecialchars($usuario_creado['email']) ?></p>
                        <?php endif; ?>
                        <p class="mb-3"><strong>Rol:</strong> <?= htmlspecialchars($usuario_creado['rol']) ?></p>
                    </div>
                    
                    <div class="alert alert-warning" role="alert">
                        <h6 class="alert-heading"><strong>⚠️ CONTRASEÑA TEMPORAL</strong></h6>
                        <hr>
                        <p class="mb-2">
                            <code id="passwordText" style="font-size: 18px; font-weight: bold; color: #d32f2f; background: #fff; padding: 5px 10px; border-radius: 4px;">
                                <?= htmlspecialchars($usuario_creado['password']) ?>
                            </code>
                        </p>
                        <small class="text-muted">Comunica esta contraseña al usuario. Se recomienda que la cambie en su primer inicio de sesión.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="copiarContrasena()">Copiar contraseña</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalElement = document.getElementById('usuarioCreadoModal');
            if (modalElement) {
                const modal = new bootstrap.Modal(modalElement);
                modal.show();
            }
        });

        function copiarContrasena() {
            const passwordText = document.getElementById('passwordText');
            const contrasena = passwordText ? passwordText.textContent.trim() : '';
            
            if (contrasena) {
                navigator.clipboard.writeText(contrasena).then(function() {
                    alert('Contraseña copiada al portapapeles');
                }, function() {
                    // Fallback para navegadores que no soportan clipboard API
                    const textArea = document.createElement('textarea');
                    textArea.value = contrasena;
                    document.body.appendChild(textArea);
                    textArea.select();
                    document.execCommand('copy');
                    document.body.removeChild(textArea);
                    alert('Contraseña copiada al portapapeles');
                });
            }
        }
    </script>
    <?php endif; ?>

    <script src='./js/interaction.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>
