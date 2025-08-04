<?php

// Iniciar la sesion y la conexion a la bd
require_once 'assets/includes/conexion.php';



// Recoger los datos del formulario
if(isset($_POST)){

    // Borrar errores antiguos
    if(isset($_SESSION['error_login'])){
        unset($_SESSION['error_login']);
    }
    
    // Recoger datos del formulario
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    // Consulta de email y contraseña para ver si coincide
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $login = mysqli_query($db,$sql);
    if($login && mysqli_num_rows($login)== 1){
        $usuario = mysqli_fetch_assoc($login);
        // Comprobar la contraseña
        $verificar = password_verify($password,$usuario['password']);

        if($verificar){
            $_SESSION['usuario'] = $usuario;
            if(isset($_SESSION['error_login'])){
                unset($_SESSION['error_login']);
                
            }
        }else{
            $_SESSION['error_login'] = "Login incorrecto!!";
        }
     }  
}


// Redirigir al index.php
header('location:index.php');
?>