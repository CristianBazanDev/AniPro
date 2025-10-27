
<div class="register-new-client">
  <a href="./index.php?page=home" >Volver</a>
  <h2>Alta de nuevo cliente</h2>
  <form action="./controllers/procesar_cliente.php" method="POST">
    <input type="text" name="nombre" placeholder="Nombre del cliente" class="form-control mb-2" required>
    <input type="email" name="email" placeholder="Email (opcional)" class="form-control mb-2">
    <button class="button primary">Guardar cliente</button>
  </form>

</div>

