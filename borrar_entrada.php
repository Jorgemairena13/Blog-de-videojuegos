<?php
session_start(); 

require_once('assets/includes/conexion.php');

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}

// Validar que se ha pasado un ID por GET
if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $entrada_id = (int) $_GET['id'];
    $usuario_id = $_SESSION['usuario']['id'];

    // Consulta preparada para eliminar la entrada
    $stmt = $db->prepare("DELETE FROM entradas WHERE id = ? AND usuario_id = ?");
    $stmt->bind_param("ii", $entrada_id, $usuario_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['mensaje'] = "Entrada eliminada correctamente.";
    } else {
        $_SESSION['mensaje'] = "No se pudo eliminar la entrada. Puede que no exista o no sea tuya.";
    }

    $stmt->close();
} else {
    $_SESSION['mensaje'] = "ID inválido.";
}

header('Location: index.php');
exit;
