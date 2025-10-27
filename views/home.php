<div class="home">
  <div class="actions">
      <h3>Bienvenido, <?= $_SESSION['usuario'] ?></h3>

      <div class="actions">

          <?php if ($_SESSION['rol'] === 'usuario'): ?>
            <a class="button primary" href="perfil.php">Mi Perfil</a>
          <?php endif; ?>


          <?php if ($_SESSION['rol'] === 'admin'): ?>
              <a href="./index.php?view=registro_cliente" class="button primary">Registrar nuevo cliente</a>
              <a href="./index.php?view=clientes" class="button primary">Ver clientes</a>
              <a href="./controllers/reportes/reporte_usuarios.php" class="button primary" target="_blank">Descargar PDF Usuarios</a>
            <?php endif; ?>




          <a href="./controllers/logout.php" class="button secondary">Cerrar sesión</a>
      </div>
  </div>
  <div class="anime-gallery"></div>
</div>

<script>
fetch('controllers/api/jikan.php')
  .then(response => response.json())
  .then(data => {
    console.log('Datos recibidos:', data);

    const container = document.querySelector('.anime-gallery');

    container.innerHTML = '';


    data.data.forEach((anime, index) => {
      const card = document.createElement('div');
      card.classList.add('anime-card');
  
      const img = document.createElement('img');
      img.src = anime.images.jpg.large_image_url;
      img.alt = anime.title;

      const caption = document.createElement('div');

      const h5 = document.createElement('h5');
      h5.textContent = anime.title;

      const p = document.createElement('p');
      p.textContent = anime.synopsis ? anime.synopsis.substring(0, 100) + '...' : '';

      const button = document.createElement('button')
      button.textContent = "Reservar para cliente"

      caption.appendChild(h5);
      caption.appendChild(p);
      caption.appendChild(button)

      card.appendChild(img);
      card.appendChild(caption)


      container.appendChild(card);
    });
  })
  .catch(error => {
    console.error('Error al cargar la API:', error);
  });
</script>

