<?php
// Conectar a la base de datos
$conn = new mysqli("localhost", "root", "", "refaccionaria", 3307);

// Verifica errores de conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Procesa solo solicitudes POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = htmlspecialchars($_POST['nombre']);
    $descripcion = htmlspecialchars($_POST['descripcion']);
    $precio = filter_var($_POST['precio'], FILTER_VALIDATE_FLOAT);

    if ($nombre && $descripcion && $precio) {
        $stmt = $conn->prepare("INSERT INTO productos (nombrep, descripcionp, preciop) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $nombre, $descripcion, $precio);

        if ($stmt->execute()) {
            echo "Producto agregado correctamente.";
        } else {
            echo "Error al agregar producto: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Datos incompletos o inválidos.";
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>


