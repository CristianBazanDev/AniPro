<?php 
  if ($_SESSION['rol'] !== 'seller' && $_SESSION['rol'] !== 'admin') {
    header("Location: ./index.php?view=home");
    exit;
  }
?>

<div class="register-new-client">
  <a href="./index.php?view=tienda">Volver a la tienda</a>
  <h2>Crear nuevo producto</h2>
  
  <?php if (isset($_SESSION['error_producto'])): ?>
    <div class="alert alert-danger">
      <?= htmlspecialchars($_SESSION['error_producto']) ?>
      <?php unset($_SESSION['error_producto']); ?>
    </div>
  <?php endif; ?>
  
  <?php if (isset($_SESSION['producto_creado'])): ?>
    <div class="alert alert-success">
      Producto creado exitosamente
      <?php unset($_SESSION['producto_creado']); ?>
    </div>
  <?php endif; ?>
  
  <form action="./controllers/procesar_producto.php" method="POST" id="productoForm" enctype="multipart/form-data">
    <input type="text" name="titulo" placeholder="Título del producto" class="form-control mb-2" required>
    
    <textarea name="descripcion" placeholder="Descripción del producto" class="form-control mb-2" rows="4"></textarea>
    
    <input type="number" name="precio" placeholder="Precio" class="form-control mb-2" step="0.01" min="0" required>
    
    <select name="tipo" class="form-control mb-2" required>
      <option value="">Seleccione un tipo</option>
      <option value="pelicula">Pelicula</option>
      <option value="anime">Anime</option>
      <option value="manga">Manga</option>
      <option value="figura">Figura</option>
      <option value="merchandise">Merchandise</option>
      <option value="accesorio">Accesorio</option>
      <option value="otro">Otro</option>
    </select>
    
    <div class="mb-2">
      <label for="imagen" class="form-label">Imagen del producto</label>
      <input type="file" name="imagen" id="imagen" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp" class="form-control mb-2">
      <small class="text-muted">Formatos permitidos: JPG, PNG, GIF, WEBP (máx. 5MB)</small>
    </div>
    
    <button type='submit' class="button primary">Crear producto</button>
  </form>
</div>

