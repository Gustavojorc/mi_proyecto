<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gustavo Jordin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <img src="images/logo_duran.png" alt="Duran Logo">
        <h1>Refaccionaria Duran</h1>
        <nav class="btn-container">
            <a href="login.html" class="btn btn-login">Iniciar Sesión</a>
            <a href="registro.html" class="btn btn-register">Registrarse</a>
        </nav>
    </header>

    <div class="contenedor-pestanas">
        <button class="boton-pestana" onclick="abrirPestaña('inicio')">Inicio</button>
        <button class="cta-button" onclick="abrirPestaña('productos')">Explorar Productos</button>
    </div>

    <div id="productos" class="contenido-pestaña">
        <h2>Nuestros Productos</h2>
        <div id="productos-lista">
            <!-- Los productos se cargarán aquí -->
        </div>
    </div>

    <div id="inicio" class="contenido-pestaña activo">
        <h1>Bienvenido a la refaccionaria Duran</h1>
        <p>Somos tu solución confiable en refacciones para vehículos diésel. Explora nuestra amplia gama de productos de alta calidad.</p>
    </div>

    <div id="acerca" class="contenido-pestaña acerca">
        <h2>Acerca de Refaccionaria Durán</h2>
        <p>Bienvenido a <strong>Refaccionaria Durán</strong>, un negocio con años de experiencia atendiendo las necesidades de vehículos de carga pesada y diésel en Campeche. Nos especializamos en ofrecer refacciones de calidad para volquetes, tráileres y camionetas, garantizando que nuestros clientes encuentren exactamente lo que necesitan para mantener sus vehículos en las mejores condiciones.</p>
        
        <div class="section-content">
            <h3 class="section-title">Nuestra Misión</h3>

            <p>Facilitar el acceso a refacciones confiables y de calidad, apoyando tanto a empresas como a particulares en la optimización de sus operaciones de transporte y logística.</p>
        </div>
        
        <div class="section-content">
            <h3 class="section-title">Nuestra Visión</h3>
            <p>Convertirnos en un referente en la región para la venta de refacciones en línea, ofreciendo una plataforma innovadora y fácil de usar para nuestros clientes.</p>
        </div>
        
        <div class="section-content">
            <h3 class="section-title">¿Por qué Elegirnos?</h3>
            <ul>
                <li><strong>Expertos en Refacciones de Carga Pesada</strong>: Conocemos las necesidades del sector y trabajamos con marcas confiables para garantizar la satisfacción de nuestros clientes.</li>
                <li><strong>Compromiso con la Calidad</strong>: Nos aseguramos de que cada producto cumpla con los más altos estándares de rendimiento.</li>
                <li><strong>Presencia Local y Digital</strong>: Desde nuestras instalaciones en Campeche hasta nuestra nueva plataforma en línea, estamos aquí para servirte donde y cuando lo necesites.</li>
            </ul>
        </div>
    </div>

    <div class="info-adicional">
        <div id="contacto">
            <h2>Contáctanos</h2>
            <p>¿Tienes dudas o necesitas una cotización? Escríbenos a <a href="mailto:contacto@refaccionariaduran.com">contacto@refaccionariaduran.com</a> o llama al (999) 123-4567.</p>
        </div>
    </div>
    <script src="script.js"></script>

    <!-- Esta sección sólo se muestra si el usuario es administrador -->
    <?php
    if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') {
        echo '
        <div id="agregar-producto" class="contenido-pestaña">
            <h2>Agregar Producto</h2>
            <form id="form-producto" action="agregar_producto.php" method="post">
                <label for="nombre">Nombre del producto:</label>
                <input type="text" id="nombre" name="nombre" required>
            
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required></textarea>
            
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" step="0.01" required>
            
                <button type="submit" class="btn btn-register">Guardar Producto</button>
            </form>
        </div>
        ';   
    }
    ?>

