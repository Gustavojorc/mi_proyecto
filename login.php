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

        // Verifica si hay resultados
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($idusuario, $hash_contraseña, $rol);
            $stmt->fetch();

            // Verificar contraseña
            if (password_verify($contraseña, $hash_contraseña)) {
                // Inicia sesión
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
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "Usuario no encontrado.";
        }
        $stmt->close();
    } else {
        echo "Error en la consulta. Intente más tarde.";
    }
}

// Cerrar la conexión
$conn->close();
?>