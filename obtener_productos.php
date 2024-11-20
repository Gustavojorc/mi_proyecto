<?php
// Conectar a la base de datos
$conn = new mysqli("localhost", "root", "", "refaccionaria", 3307);

// Verifica errores de conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Obtener productos
$sql = "SELECT nombrep, descripcionp, preciop FROM productos";
$result = $conn->query($sql);

// Verificar y mostrar productos
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div style='border: 1px solid #ddd; padding: 10px; margin: 10px;'>";
        echo "<h3>" . htmlspecialchars($row['nombrep']) . "</h3>";
        echo "<p>" . htmlspecialchars($row['descripcionp']) . "</p>";
        echo "<p>Precio: $" . htmlspecialchars($row['preciop']) . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No hay productos disponibles.</p>";
}

$conn->close();
?>

