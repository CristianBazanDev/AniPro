<div class="shop">
    <div class="filters">
        <h3>Filtros</h3>
        <input type="search" name="busqueda" id="busqueda" placeholder='Ingrese su búsqueda'>

        <div class="filter">
            <h4>Tipo</h4>
            <select name="tipo" id="tipo" class="form-control">
                <option value="">Todos los tipos</option>
                <option value="anime">Anime</option>
                <option value="manga">Manga</option>
                <option value="figura">Figura</option>
                <option value="merchandise">Merchandise</option>
                <option value="accesorio">Accesorio</option>
                <option value="otro">Otro</option>
            </select>
        </div>

        <div class="filter">
            <h4>Vendedor</h4>
            <select name="vendedor" id="vendedor" class="form-control">
                <option value="">Todos los vendedores</option>
            </select>
        </div>

        <button type="button" id="limpiarFiltros" class="button secondary">Limpiar filtros</button>
        
        <?php if ($_SESSION['rol'] === 'seller' || $_SESSION['rol'] === 'admin'): ?>
            <a href="./index.php?view=crear_producto" class="button primary">Crear nuevo producto</a>
        <?php endif; ?>
    </div>

    <div class="products">
        <div class="loading">
            <img src="./public/assets/img/logo/logo.png" alt="">
            <h3>Cargando...</h3>
        </div>
        <div class="products-gallery"></div>
    </div>
</div>

<script src='./js/shop.js'></script>