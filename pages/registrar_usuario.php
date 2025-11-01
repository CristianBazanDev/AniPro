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
  <div class="login">
    <div class="title">
      <img class='character' src="../public/assets/img/sakura.png" alt="">
      <h2>Alta de nuevo usuario</h2>

    </div>
  <form action="../controllers/procesar_registro.php" method="POST">
    <input type="text" name="usuario" placeholder="Usuario" class="form-control mb-2" required>
    <input type="password" name="password" placeholder="Contraseña" class="form-control mb-2" required>
    <button class="button primary">Registrar</button>
  </form>
  </div>
 
</body>
</html>
