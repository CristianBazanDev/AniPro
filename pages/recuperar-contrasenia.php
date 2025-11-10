<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Recuperar Contraseña</title>
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
        <h2>Recuperar Contraseña</h2>
      </div>

      <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger">Usuario no encontrado</div>
      <?php endif; ?>
      <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">Se ha enviado un enlace de recuperación. Por favor, revisa tu correo electrónico.</div>
      <?php endif; ?>
      <?php if (isset($_GET['token_sent'])): ?>
        <div class="alert alert-info">
          <strong>Enlace de recuperación generado:</strong><br>
          <a href="<?php echo htmlspecialchars($_GET['token_sent']); ?>" target="_blank" style="word-break: break-all;">
            <?php echo htmlspecialchars($_GET['token_sent']); ?>
          </a>
        </div>
      <?php endif; ?>

      <form action="../controllers/solicitar_recuperacion.php" method="POST">
        <div class="mb-3">
          <label for="usuario" class="form-label">Ingresa tu usuario</label>
          <input type="text" name="usuario" id="usuario" placeholder="Usuario" class="form-control mb-2" required>
          <small class="text-muted">Te enviaremos un enlace para restablecer tu contraseña</small>
        </div>
        <button class="button primary">Enviar enlace de recuperación</button>
      </form>
      <hr>
      <div class="text-center">
        <a href="./login.php" class="button secondary">Volver al login</a>
      </div>
    </div>
  </div>
</body>
</html>

