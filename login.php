<?php

// Iniciar la sesion y la conexion a la bd
require_once 'assets/includes/conexion.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Borrar errores antiguos
    if (isset($_SESSION['error_login'])) {
        unset($_SESSION['error_login']);
    }

    // Recoger y validar datos del formulario
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_login'] = "Correo electrónico inválido.";
        return;
    }

    // Consulta segura con prepared statements
    $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = ?");
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado && $resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();

            // Verificar contraseña
            if (password_verify($password, $usuario['password'])) {
                $_SESSION['usuario'] = $usuario;
            } else {
                $_SESSION['error_login'] = "Contraseña incorrecta.";
            }
        } else {
            $_SESSION['error_login'] = "El usuario no existe.";
        }

        $stmt->close();
    } else {
        $_SESSION['error_login'] = "Error en el servidor al preparar la consulta.";
    }
}



// Redirigir al index.php
header('location:index.php');
?>