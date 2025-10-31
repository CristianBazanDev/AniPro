<div class="home">
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
      button.textContent = "Ver más"

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

