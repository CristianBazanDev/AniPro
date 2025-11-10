<div class="edit-user">
    <form method="POST" id="editForm" action="./controllers/editar_cliente.php" enctype="multipart/form-data">
        <input type="hidden" id="id" name="id">
        <input type="text" id="usuario" name="usuario" placeholder="Usuario" class="form-control mb-2" required>
        <input type="email" id="email" name="email" placeholder="Email" class="form-control mb-2" required>
        
        <div class="mb-2">
            <label for="profile_picture_file" class="form-label">Foto de perfil</label>
            <input type="file" name="profile_picture_file" id="profile_picture_file" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp" class="form-control mb-2">
            <small class="text-muted">Formatos permitidos: JPG, PNG, GIF, WEBP (máx. 5MB). Dejar vacío para mantener la actual.</small>
            <div id="current-image-preview" class="mt-2" style="display: none;">
                <small class="text-muted">Imagen actual:</small><br>
                <img id="current-image" src="" alt="Imagen actual" style="max-width: 150px; max-height: 150px; border-radius: 8px; margin-top: 5px;">
            </div>
        </div>
        
        <input type="hidden" id="profile_picture" name="profile_picture">
        
        <button type="submit" class="button primary">Confirmar</button>
    </form>
</div>

<script>
    async function cargarUsuario() {
        const params = new URLSearchParams(window.location.search); 
        const id = params.get('id'); 
        if (!id) return; 

        try {
            const response = await fetch(`./controllers/obtener_usuario.php?id=${id}`);

            const usuario = await response.json(); 

            console.log(usuario)

            document.getElementById('id').value = usuario.id;
            document.getElementById('usuario').value = usuario.usuario; 
            document.getElementById('email').value = usuario.email;
            
            if (usuario.profile_picture) {
                document.getElementById('profile_picture').value = usuario.profile_picture;
                const currentImage = document.getElementById('current-image');
                currentImage.src = usuario.profile_picture;
                document.getElementById('current-image-preview').style.display = 'block';
            } else {
                const defaultImage = './public/assets/img/profile_pictures/pp.webp';
                document.getElementById('profile_picture').value = defaultImage;
                const currentImage = document.getElementById('current-image');
                currentImage.src = defaultImage;
                document.getElementById('current-image-preview').style.display = 'block';
            }
            
            document.getElementById('profile_picture_file').addEventListener('change', function(e) {
                const file = e.target.files[0];
                console.log(file)
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const currentImage = document.getElementById('current-image');
                        currentImage.src = e.target.result;
                        document.getElementById('current-image-preview').style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            }); 


        } catch (e) {
            console.error("Error al cargar el usuario: ", e);
        }
    }

    cargarUsuario();
</script>