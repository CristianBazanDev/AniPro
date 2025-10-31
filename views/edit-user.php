<div class="edit-user">
    <form  method="POST" id="editForm" action="./controllers/editar_usuario.php">
        <input type="hidden" id="id" name="id">
        <input type="text" id="nombre" name="nombre" placeholder="Nombre" class="form-control mb-2" required>
        <input type="email" id="email" name="email" placeholder="Email" class="form-control mb-2" required>
        <input type="text" id="profile_picture" name="profile_picture" placeholder="Foto de perfil" class="form-control mb-2" required>
        <input type="file" />
        
        <button class="button primary">Confirmar</button>
    </form>
</div>

<script>
    async function cargarUsuario() {
        const params = new URLSearchParams(window.location.search); 
        const id = params.get('id'); 
        if (!id) return; 

        try {
            const response = await fetch(`controllers/obtener_usuario.php?id=${id}`);

            const usuario = await response.json(); 

            console.log(usuario)

            document.getElementById('id').value = usuario.id;
            document.getElementById('nombre').value = usuario.nombre; 
            document.getElementById('email').value = usuario.email;
            document.getElementById('profile_picture').value = usuario.profile_picture; 


        } catch (e) {
            console.error("Error al cargar el usuario: ", e);
        }
    }

    cargarUsuario();
</script>