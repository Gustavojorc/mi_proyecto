<?php
// Conectar a la base de datos
$conn = new mysqli("localhost", "root", "", "refaccionaria", 3307);

// Verifica errores de conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Procesa la solicitud de registro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = htmlspecialchars($_POST['nombre']);
    $correo = htmlspecialchars($_POST['correo']);
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT);
    $rol = 'usuario'; // Asigna el rol 'usuario' por defecto

    // Inserta el nuevo usuario en la base de datos
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, contraseña, rol) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $correo, $contraseña, $rol);

    if ($stmt->execute()) {
        echo "Registro exitoso. Puedes <a href='login.php'>iniciar sesión</a> ahora.";
    } else {
        echo "Error en el registro: " . $stmt->error;
    }

    $stmt->close();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

