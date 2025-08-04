<?php
session_start(); // Asegúrate siempre de tener esto al principio

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conexion con la base de datos
    require_once 'assets/includes/conexion.php';

    // Recoger valores del formulario de actualización
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : false;
    $apellido = isset($_POST['apellidos']) ? trim($_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? trim($_POST['email']) : false;

    // Array de errores
    $errores = array();

    // Validaciones
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match('/[0-9]/', $nombre)) {
        $nombre_validate = true;
    } else {
        $nombre_validate = false;
        $errores['nombre'] = 'El nombre no es valido';
    }

    if (!empty($apellido) && !is_numeric($apellido) && !preg_match('/[0-9]/', $apellido)) {
        $apellido_validate = true;
    } else {
        $apellido_validate = false;
        $errores['apellidos'] = 'El apellido no es valido';
    }

    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_validate = true;
    } else {
        $email_validate = false;
        $errores['email'] = 'El email no es valido';
    }

    $guardar_usuario = false;
    if (count($errores) == 0) {
        $guardar_usuario = true;
        $usuario = $_SESSION['usuario'];

        // Comprobar si el email ya existe para otro usuario
        $stmt_check = $db->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $resultado_check = $stmt_check->get_result();
        $existe_usuario = $resultado_check->fetch_assoc();
        $stmt_check->close();

        if (empty($existe_usuario) || $existe_usuario['id'] == $usuario['id']) {
            // Actualizar usuario en la tabla de usuarios
            $stmt_update = $db->prepare("UPDATE usuarios SET nombre = ?, apellidos = ?, email = ? WHERE id = ?");
            $stmt_update->bind_param("sssi", $nombre, $apellido, $email, $usuario['id']);
            $guardar = $stmt_update->execute();
            $stmt_update->close();

            if ($guardar) {
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellidos'] = $apellido;
                $_SESSION['usuario']['email'] = $email;
                $_SESSION['completado'] = "Tus datos se han actualizado con exito";
            } else {
                $_SESSION['errores']['general'] = "Fallo al actualizar usuario";
            }

        } else {
            $_SESSION['errores']['general'] = "El usuario ya existe";
        }

    } else {
        $_SESSION['errores'] = $errores;
        header('location: index.php');
        exit;
    }
}

header('location: mis_datos.php');
exit;
