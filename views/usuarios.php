<div class="clients">
    <h1>Usuarios</h1>

    <div class="clients-container">
        
    </div>
</div>

<script>

async function cargarUsuarios() {
    try {
        const response = await fetch('./controllers/obtener_usuarios.php'); 
        const data = await response.json(); 
        console.log(data)
        return data
    } catch (e) {
        console.error("Error: ", e);
        return []; 
    }
}

(
    async() => {
        const usuarios = await cargarUsuarios(); 
        console.log(usuarios)

        usuarios.forEach((usuario) => {
            renderizarUsuario(usuario);
        })
    }
)();

function renderizarUsuario(usuario) {
    console.log(usuario)
    const container = document.querySelector(".clients-container")

    const profileCard = document.createElement('div');
    profileCard.classList.add('profile-card');
  

    const img = document.createElement('img');
    img.src = usuario.profile_picture ? usuario.profile_picture : './public/assets/img/profile_pictures/pp.webp'; 
    img.alt = usuario.usuario || usuario.nombre || 'Usuario'

    const actions = document.createElement('div')
    actions.classList.add('actions')

    const title = document.createElement('h3'); 
    title.textContent = usuario.usuario; 

    const buttonsContainer = document.createElement('div')
    buttonsContainer.classList.add('buttons-container')

    const editButton = document.createElement('a')
    editButton.href = `./index.php?view=edit-user&id=${usuario.id}`
    editButton.textContent = "Editar"
    editButton.classList.add('btn', 'primary')

    const deleteButton = document.createElement('a')
    deleteButton.textContent = "Eliminar"
    deleteButton.classList.add('btn', 'secondary')

    buttonsContainer.appendChild(editButton)
    buttonsContainer.appendChild(deleteButton)

    actions.appendChild(title)
    actions.appendChild(buttonsContainer)

    profileCard.appendChild(img)
    profileCard.appendChild(actions)


    container.appendChild(profileCard)

}
</script>