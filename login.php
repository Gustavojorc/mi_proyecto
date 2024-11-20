<?php
session_start();

// Configuración de la base de datos
$host = "localhost";
$user = "root";
$password = "";
$dbname = "refaccionaria";
$port = 3307;

// Conectar a la base de datos
$conn = new mysqli($host, $user, $password, $dbname, $port);

// Verifica errores de conexión
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos.");
}

// Procesa la solicitud de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitización básica de entrada
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
    $contraseña = $_POST['contraseña'];

    // Validación básica
    if (empty($correo) || empty($contraseña)) {
        echo "Por favor, complete todos los campos.";
        exit();
    }

    // Preparar y ejecutar consulta
    $stmt = $conn->prepare("SELECT idusuario, contraseña, rol FROM usuarios WHERE correo = ?");
    if ($stmt) {
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($idusuario, $hash_contraseña, $rol);
        $stmt->fetch();

        // Verificar contraseña y sesión
        if ($stmt->num_rows > 0 && password_verify($contraseña, $hash_contraseña)) {
            $_SESSION['idusuario'] = $idusuario;
            $_SESSION['rol'] = $rol;
            $_SESSION['correo'] = $correo;

            // Redirigir según rol
            if ($rol === 'admin') {
                header("Location: agregar_producto.php");
            } else {
                header("Location: ver_productos.php");
            }
            exit();
        } else {
            // Mensaje genérico
            echo "Credenciales inválidas.";
        }
        $stmt->close();
    } else {
        echo "Error en la consulta. Intente más tarde.";
    }
}

echo password_hash('admin123', PASSWORD_BCRYPT);


// Cerrar la conexión
$conn->close();
?>
