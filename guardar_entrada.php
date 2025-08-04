<?php
session_start(); // Asegúrate de que siempre se inicie la sesión
require_once './assets/includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger y sanitizar entradas
    $titulo = trim($_POST['titulo'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $categoria = $_POST['categoria'] ?? '';
    $usuario = $_SESSION['usuario']['id'];

    // Validaciones
    $errores = [];

    if (empty($titulo)) {
        $errores['titulo'] = "El título no es válido";
    }

    if (empty($descripcion)) {
        $errores['descripcion'] = "La descripción no es válida";
    }

    if (!filter_var($categoria, FILTER_VALIDATE_INT)) {
        $errores['categoria'] = "La categoría no es válida";
    }

    if (count($errores) === 0) {
        if (isset($_GET['editar']) && filter_var($_GET['editar'], FILTER_VALIDATE_INT)) {
            // EDITAR entrada
            $entrada_id = (int) $_GET['editar'];
            $stmt = $db->prepare("UPDATE entradas SET titulo = ?, descripcion = ?, categoria_id = ? WHERE id = ? AND usuario_id = ?");
            $stmt->bind_param("ssiii", $titulo, $descripcion, $categoria, $entrada_id, $usuario);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $_SESSION['mensaje'] = "Entrada actualizada correctamente.";
            } else {
                $_SESSION['mensaje'] = "No se actualizó ninguna entrada (¿es tuya?).";
            }

            $stmt->close();
            header("Location: index.php");
            exit;

        } else {
            // CREAR entrada
            $stmt = $db->prepare("INSERT INTO entradas (usuario_id, categoria_id, titulo, descripcion, fecha) VALUES (?, ?, ?, ?, CURDATE())");
            $stmt->bind_param("iiss", $usuario, $categoria, $titulo, $descripcion);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $_SESSION['mensaje'] = "Entrada creada correctamente.";
            } else {
                $_SESSION['mensaje'] = "Error al crear la entrada.";
            }

            $stmt->close();
            header("Location: index.php");
            exit;
        }
    } else {
        // Guardar errores en sesión
        $_SESSION['errores_entrada'] = $errores;

        if (isset($_GET['editar'])) {
            header("Location: editar_entrada.php?id=" . $_GET['editar']);
        } else {
            header("Location: crear_entrada.php");
        }
        exit;
    }
}
?>
