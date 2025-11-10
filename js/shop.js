const container = document.querySelector('.products-gallery');
const loading = document.querySelector('.shop .loading');
const busquedaInput = document.getElementById('busqueda');
const tipoSelect = document.getElementById('tipo');
const vendedorSelect = document.getElementById('vendedor');
const limpiarFiltrosBtn = document.getElementById('limpiarFiltros');

let productos = [];
let vendedores = [];

// Cargar vendedores
async function cargarVendedores() {
    try {
        const response = await fetch('./controllers/obtener_vendedores.php');
        const data = await response.json();
        vendedores = data;
        
        vendedorSelect.innerHTML = '<option value="">Todos los vendedores</option>';
        data.forEach(vendedor => {
            const option = document.createElement('option');
            option.value = vendedor.id;
            option.textContent = vendedor.usuario;
            vendedorSelect.appendChild(option);
        });
    } catch (error) {
        console.error('Error al cargar vendedores:', error);
    }
}

// Cargar productos
async function cargarProductos() {
    try {
        const busqueda = busquedaInput.value.trim();
        const tipo = tipoSelect.value;
        const vendedor = vendedorSelect.value;

        let url = './controllers/obtener_productos.php?';
        const params = [];
        
        if (busqueda) params.push(`busqueda=${encodeURIComponent(busqueda)}`);
        if (tipo) params.push(`tipo=${encodeURIComponent(tipo)}`);
        if (vendedor) params.push(`vendedor=${encodeURIComponent(vendedor)}`);
        
        url += params.join('&');

        const response = await fetch(url);
        const data = await response.json();
        productos = data;
        
        renderizarProductos();
    } catch (error) {
        console.error('Error al cargar productos:', error);
        container.innerHTML = '<p>Error al cargar los productos</p>';
    } finally {
        if (loading) {
            loading.remove();
        }
    }
}

// Renderizar productos
function renderizarProductos() {
    if (!container) return;
    
    container.innerHTML = '';
    
    if (productos.length === 0) {
        container.innerHTML = '<p class="no-products">No se encontraron productos</p>';
        return;
    }
    
    productos.forEach((producto) => {
        renderCard(producto);
    });
    
    // Agregar eventos a las tarjetas
    const buttonView = document.querySelectorAll('.anime-card div .more');
    const textContainer = document.querySelectorAll('.anime-card .caption');
    const paragraph = document.querySelectorAll('.anime-card div p');
    
    buttonView.forEach((button, index) => {
        button.addEventListener('mouseenter', () => {
            textContainer[index].classList.add('active');
            paragraph[index].classList.add('active');
        });
        
        button.addEventListener('mouseleave', () => {
            textContainer[index].classList.remove('active');
            paragraph[index].classList.remove('active');
        });
    });
}

// Renderizar una tarjeta de producto
function renderCard(producto) {
    const card = document.createElement('div');
    card.classList.add('anime-card');
    
    const img = document.createElement('img');
    img.src = producto.imagen_url || './public/assets/img/logo/logo.png';
    img.alt = producto.titulo;
    img.onerror = function() {
        this.src = './public/assets/img/logo/logo.png';
    };
    
    const svgWrapper = document.createElement('div');
    svgWrapper.classList.add('heart-icon');
    svgWrapper.innerHTML = `
        <svg className='favorite-icon' xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" version="1.1" x="0px" y="0px" viewBox="0 0 100 125">
            <g transform="translate(0,-952.36218)">
            <path style="text-indent:0;text-transform:none;direction:ltr;block-progression:tb;baseline-shift:baseline;color:#000000;enable-background:accumulate;" d="m 31.748076,967.397 c -5.3435,0 -10.6868,2.09293 -14.718701,6.3125 -8.0640002,8.43897 -8.0536002,21.96169 0,30.4063 l 30.781201,32.2812 a 3.0003,3.0003 0 0 0 4.3438,0 c 10.2681,-10.7459 20.5442,-21.504 30.8125,-32.25 8.0638,-8.43911 8.0638,-21.96714 0,-30.40625 -8.0639,-8.43908 -21.3736,-8.43926 -29.4375,0 l -3.5313,3.65625 -3.5312,-3.6875 c -4.032,-4.21955 -9.3753,-6.3125 -14.7188,-6.3125 z m 0,5.875 c 3.7301,0 7.4855,1.53708 10.4063,4.59375 l 5.6875,5.96874 a 3.0003,3.0003 0 0 0 4.3437,0 l 5.6563,-5.93749 c 5.8415,-6.11346 14.9397,-6.11332 20.7812,0 5.8415,6.11329 5.8415,16.01169 0,22.125 -9.5402,9.9842 -19.0848,19.9534 -28.625,29.9375 l -28.625,-29.96871 c -5.838401,-6.1219 -5.841501,-16.0119 0,-22.12504 2.9207,-3.05665 6.6449,-4.59375 10.375,-4.59375 z" fill="#000000" fill-opacity="1" stroke="none" marker="none" visibility="visible" display="inline" overflow="visible"/></g>
        </svg>
    `;
    
    const caption = document.createElement('div');
    caption.classList.add('caption');
    
    const h5 = document.createElement('h5');
    h5.textContent = producto.titulo;
    
    const precio = document.createElement('p');
    precio.textContent = `$${parseFloat(producto.precio).toFixed(2)}`;
    precio.style.fontWeight = 'bold';
    precio.style.color = 'var(--accent)';
    
    const p = document.createElement('p');
    p.textContent = producto.descripcion ? producto.descripcion.substring(0, 100) + '...' : '';
    
    const vendedor = document.createElement('small');
    vendedor.textContent = `Vendedor: ${producto.nombre_vendedor}`;
    vendedor.style.display = 'block';
    vendedor.style.marginTop = '0.5rem';
    vendedor.style.opacity = '0.8';
    
    const info = document.createElement('h5');
    info.classList.add('more');
    info.textContent = "Ver más";
    
    const button = document.createElement('button');
    button.classList.add('buy');
    button.textContent = "Alquilar";
    
    caption.appendChild(h5);
    caption.appendChild(precio);
    caption.appendChild(p);
    caption.appendChild(vendedor);
    caption.appendChild(info);
    caption.appendChild(button);
    
    card.appendChild(svgWrapper);
    card.appendChild(img);
    card.appendChild(caption);
    
    container.appendChild(card);
}

// Event listeners
if (busquedaInput) {
    let timeout;
    busquedaInput.addEventListener('input', () => {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            cargarProductos();
        }, 500);
    });
}

if (tipoSelect) {
    tipoSelect.addEventListener('change', cargarProductos);
}

if (vendedorSelect) {
    vendedorSelect.addEventListener('change', cargarProductos);
}

if (limpiarFiltrosBtn) {
    limpiarFiltrosBtn.addEventListener('click', () => {
        busquedaInput.value = '';
        tipoSelect.value = '';
        vendedorSelect.value = '';
        cargarProductos();
    });
}

// Inicializar
document.addEventListener('DOMContentLoaded', () => {
    cargarVendedores();
    cargarProductos();
});

