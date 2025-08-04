<?php

$servidor = 'localhost';
$usuario = 'root';
$password = 'root';
$basededatos = 'blog_master';

$db = mysqli_connect($servidor,$usuario,$password,$basededatos);

// Verificar la conexión
if (!$db) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

mysqli_set_charset($db, "utf8");

// Iniciar la sesion
if(!isset($_SESSION)){
    session_start();
}


?>