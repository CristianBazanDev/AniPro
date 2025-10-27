<div class="edit-client">
    <form  method="POST" id="editForm" action="./controllers/editar_cliente.php">
        <input type="hidden" id="id" name="id">
        <input type="text" id="nombre" name="nombre" placeholder="Nombre" class="form-control mb-2" required>
        <input type="email" id="email" name="email" placeholder="Email" class="form-control mb-2" required>
        <input type="text" id="profile_picture" name="profile_picture" placeholder="Foto de perfil" class="form-control mb-2" required>
        <input type="file" />
        
        <button class="button primary">Confirmar</button>
    </form>
</div>

<script>
    async function cargarCliente() {
        const params = new URLSearchParams(window.location.search); 
        const id = params.get('id'); 
        if (!id) return; 

        try {
            const response = await fetch(`controllers/obtener_cliente.php?id=${id}`);

            const cliente = await response.json(); 

            console.log(cliente)

            document.getElementById('id').value = cliente.id;
            document.getElementById('nombre').value = cliente.nombre; 
            document.getElementById('email').value = cliente.email;
            document.getElementById('profile_picture').value = cliente.profile_picture; 


        } catch (e) {
            console.error("Error al cargar el cliente: ", e);
        }
    }

    cargarCliente();
</script>