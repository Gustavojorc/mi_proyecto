console.log("script.js cargado correctamente");

function abrirPestaña(pestañaId) {
    var contenido = document.getElementsByClassName("contenido-pestaña");

    for (var i = 0; i < contenido.length; i++) {
        contenido[i].style.display = "none";
        contenido[i].classList.remove("activo");
    }

    var tabSeleccionada = document.getElementById(pestañaId);
    tabSeleccionada.style.display = "block";
    tabSeleccionada.classList.add("activo");

    if (pestañaId === 'productos') {
        mostrarProductos();
    }
}

function mostrarProductos() {
    console.log("Función mostrarProductos() llamada");
    fetch('obtener_productos.php')
        .then(response => response.text())
        .then(data => {
            console.log("Datos recibidos de obtener_productos.php:", data);
            document.getElementById('productos-lista').innerHTML = data;
        })
        .catch(error => console.error('Error al cargar productos:', error));
}



async function agregarProducto(event) {
    event.preventDefault();
    
    const nombre = document.getElementById('nombre').value;
    const descripcion = document.getElementById('descripcion').value;
    const precio = document.getElementById('precio').value;

    try {
        const response = await fetch('agregar_producto.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ nombre, descripcion, precio }),
        });

        if (!response.ok) throw new Error('Error en la solicitud');
        
        const data = await response.json();
        alert(data.message || "Producto agregado exitosamente");
    } catch (error) {
        alert('Error al agregar producto: ' + error.message);
    }
}



