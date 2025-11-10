<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Usuario</title>
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
        <h2>Registrar nuevo usuario</h2>
      </div>

      <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger">
          Error al registrar el usuario. Por favor, intenta nuevamente.
        </div>
      <?php endif; ?>

      <form action="../controllers/procesar_registro.php" method="POST">
        <input type="hidden" name="rol" value="2">
        <input type="text" name="usuario" placeholder="Usuario" class="form-control mb-2" required>
        <input type="password" name="password" placeholder="Contraseña" class="form-control mb-2" required>
        <button class="button primary">Registrar</button>
      </form>
      
      <div class="text-center mt-3">
        <a href="./login.php" style="text-decoration: none; color: #666; font-size: 0.9rem;">¿Ya tienes cuenta? Inicia sesión</a>
      </div>
    </div>
  </div>
</body>
</html>

