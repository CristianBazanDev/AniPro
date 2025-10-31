
<div class="register-new-client">
  <a href="./index.php?page=home" >Volver</a>
  <h2>Alta de nuevo usuario</h2>
  <form action="./controllers/procesar_usuario.php" method="POST">
    <input type="text" name="nombre" placeholder="Nombre del usuario" class="form-control mb-2" required>
    <input type="email" name="email" placeholder="Email (opcional)" class="form-control mb-2">
    <button class="button primary">Guardar usuario</button>
  </form>

</div>

