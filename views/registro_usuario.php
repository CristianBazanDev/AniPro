<?php 
  $rol = isset($_GET['rol']) ? intval($_GET['rol']) : 3;
  
  $titulos = [
    1 => 'Registrar administrador',
    2 => 'Registrar usuario',
    3 => 'Registrar vendedor'
  ];

  $titulo = isset($titulos[$rol]) ? $titulos[$rol] : 'Registrar usuario';
?>


<div class="register-new-client">
  <a href="./index.php?page=home" >Volver</a>
  <h2><?php echo $titulo; ?></h2>
  <form action="./controllers/procesar_usuario.php" method="POST" id="registroForm" enctype="multipart/form-data">
    <input type="text" name="usuario" placeholder="Nombre del usuario" class="form-control mb-2" required>
    <input type="email" name="email" placeholder="Email (opcional)" class="form-control mb-2">
    
    <div class="mb-2">
      <label for="profile_picture" class="form-label">Foto de perfil (opcional)</label>
      <input type="file" name="profile_picture" id="profile_picture" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp" class="form-control mb-2">
      <small class="text-muted">Formatos permitidos: JPG, PNG, GIF, WEBP (máx. 5MB)</small>
    </div>
    
    <div class="mb-2">
      <label style="display: flex; align-items: center; gap: 8px; margin-bottom: 5px;">
        <input type="checkbox" id="generarPassword" onchange="togglePasswordField()">
        <span>Generar contraseña automáticamente</span>
      </label>
    </div>
    
    <input type="password" name="password" id="passwordField" placeholder="Contraseña" class="form-control mb-2" required>

    <input type="hidden" name="rol" value="<?php echo $rol; ?>">
    <button type='submit' class="button primary">Guardar usuario</button>
  </form>

  <script>
    function togglePasswordField() {
      const checkbox = document.getElementById('generarPassword');
      const passwordField = document.getElementById('passwordField');
      
      if (checkbox.checked) {
        passwordField.disabled = true;
        passwordField.placeholder = 'Se generará automáticamente';
        passwordField.value = '';
      } else {
        passwordField.disabled = false;
        passwordField.placeholder = 'Contraseña';
      }
    }

    document.getElementById('registroForm').addEventListener('submit', function(e) {
      const checkbox = document.getElementById('generarPassword');
      const passwordField = document.getElementById('passwordField');
      
      if (checkbox.checked) {
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%&*';
        let password = '';
        for (let i = 0; i < 12; i++) {
          password += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        passwordField.value = password;
        passwordField.disabled = false;
      }
    });
  </script>

</div>

