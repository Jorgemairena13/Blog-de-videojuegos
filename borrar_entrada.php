<?php
require_once('assets/includes/conexion.php');
if(!isset($_SESSION['usuario'])){
    session_start();
}


if(isset($_SESSION['usuario']) && $_GET['id']){
    $entrada_id = $_GET['id'];
    $usuario_id = $_SESSION['usuario']['id'];
    $sql = "DELETE FROM entradas WHERE usuario_id = $usuario_id AND id = $entrada_id ";

    $resultado = mysqli_query($db,$sql);
    
}

header('location:index.php');