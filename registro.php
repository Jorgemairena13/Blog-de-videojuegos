<?php
session_start(); // Asegúrate de tener esto al inicio

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'assets/includes/conexion.php';

    // Recoger datos y sanitizar
    $nombre = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellidos'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $errores = [];

    // Validaciones
    if (empty($nombre) || is_numeric($nombre) || preg_match('/\d/', $nombre)) {
        $errores['nombre'] = 'El nombre no es válido';
    }

    if (empty($apellido) || is_numeric($apellido) || preg_match('/\d/', $apellido)) {
        $errores['apellidos'] = 'El apellido no es válido';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = 'El email no es válido';
    }

    if (strlen($password) < 6) {
        $errores['password'] = 'La contraseña debe tener al menos 6 caracteres';
    }

    if (count($errores) === 0) {
        // Verificar si el correo ya existe
        $stmt_check = $db->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $errores['email'] = 'Este correo ya está registrado';
            $_SESSION['errores'] = $errores;
            header('Location: index.php');
            exit;
        }

        $stmt_check->close();

        // Hashear la contraseña
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);

        // Insertar el usuario
        $stmt_insert = $db->prepare("INSERT INTO usuarios (nombre, apellidos, email, password, fecha) VALUES (?, ?, ?, ?, CURDATE())");
        $stmt_insert->bind_param("ssss", $nombre, $apellido, $email, $password_segura);

        if ($stmt_insert->execute()) {
            $_SESSION['completado'] = "El registro se ha completado con éxito";
        } else {
            $_SESSION['errores']['general'] = "Error al guardar el usuario";
        }

        $stmt_insert->close();
    } else {
        $_SESSION['errores'] = $errores;
    }

    header('Location: index.php');
    exit;
}
?>
