<?php session_start(); 
require '../controllers/db.php';

$token = $_GET['token'] ?? '';

if (empty($token)) {
    header("Location: ./login.php?error=token_invalido");
    exit;
}

$sql = "SELECT id, usuario FROM usuarios WHERE reset_token = ? AND reset_token_expira > NOW()";
$command = $conn->prepare($sql);
$command->bind_param("s", $token);
$command->execute();
$result = $command->get_result();

if ($result->num_rows == 0) {
    header("Location: ./login.php?error=token_invalido");
    exit;
}

$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Restablecer Contraseña</title>
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
        <h2>Restablecer Contraseña</h2>
      </div>

      <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger">Las contraseñas no coinciden</div>
      <?php endif; ?>
      <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">Contraseña restablecida exitosamente. <a href="./login.php">Inicia sesión</a></div>
      <?php endif; ?>

      <form action="../controllers/procesar_reset_password.php" method="POST">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
        <div class="mb-3">
          <label for="password" class="form-label">Nueva Contraseña</label>
          <input type="password" name="password" id="password" placeholder="Nueva contraseña" class="form-control mb-2" required minlength="6">
        </div>
        <div class="mb-3">
          <label for="password_confirm" class="form-label">Confirmar Contraseña</label>
          <input type="password" name="password_confirm" id="password_confirm" placeholder="Confirmar contraseña" class="form-control mb-2" required minlength="6">
        </div>
        <button class="button primary">Restablecer Contraseña</button>
      </form>
      <hr>
      <div class="text-center">
        <a href="./login.php" class="button secondary">Volver al login</a>
      </div>
    </div>
  </div>
</body>
</html>

