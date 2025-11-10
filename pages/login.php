<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="../css/login.css">
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/components.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="login-page">
    <div class="login">
      <div class="title">
        <img class='character' src="../public/assets/img/kero.webp" alt="">
        <h2>Iniciar sesión</h2>
      </div>

        <?php if (isset($_GET['error'])): ?>
          <div class="alert alert-danger">
            <?php 
            if ($_GET['error'] == 'token_invalido') {
              echo 'El enlace de recuperación ha expirado o es inválido';
            } else {
              echo 'Usuario o contraseña incorrectos';
            }
            ?>
          </div>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
          <div class="alert alert-success">Usuario registrado con éxito</div>
        <?php endif; ?>
        <form action="../controllers/login.php" method="POST">
          <input type="text" name="usuario" placeholder="Usuario" class="form-control mb-2" required>
          <input type="password" name="password" placeholder="Contraseña" class="form-control mb-2" required>
          <button class="button primary">Ingresar</button>
        </form>
        <div class="text-center mt-2 mb-3">
          <a href="./recuperar-contrasenia.php" style="text-decoration: none; color: #666; font-size: 0.9rem;">¿Olvidaste tu contraseña?</a>
        </div>
        <hr>
       
        <a href="./registrar_cliente.php" class="button secondary">Registrarme</a>

    </div>

  
</body>
</html>
