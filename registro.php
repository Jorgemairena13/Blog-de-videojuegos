<?php


if(isset($_POST)){

    // Conexion con la base de datos
    require_once 'assets/includes/conexion.php';
    

    // Recoger valores del formulario usando operador ternario evaluar si esta o no
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db,$_POST['nombre']):false;
    $apellido = isset($_POST['apellidos']) ? mysqli_real_escape_string($db,$_POST['apellidos']):false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db,trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db,$_POST['password']) : false;

    // Array de errores
    $errores = array();

    // Validar datos antes de guradarlos


    // Validar el campo nombre
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match('/[0-9]/',$nombre)){
        $nombre_validate = true;
    }else{
        $nombre_validate = false;
        $errores['nombre'] = 'El nombre no es valido';
    } 
    // Validar el campo apellido
    if(!empty($apellido) && !is_numeric($apellido) && !preg_match('/[0-9]/',$apellido)){
        $apellido_validate = true;
    }else{
        $apellido_validate = false;
        $errores['apellidos'] = 'El apellido no es valido';
    }

    // Validar el email
    if(!empty($email) && filter_var($email,FILTER_VALIDATE_EMAIL)){
        $email_validate = true;
    }else{
        $email_validate = false;
        $errores['email'] = 'El email no es valido';
    }

    if(!empty($password)){
        $password_validate = true;
    }else{
        $password_validate = false;
        $errores['password'] = 'La password no es valida';
    }

    $guardar_usuario = false;
    if(count($errores) == 0){
        // Insertar usuario en la base de datos
        $guardar_usuario = true;

        // Cifrar la constraseña
        $password_segura = password_hash($password,PASSWORD_BCRYPT,['cost' =>4]);

        // Insertar usuario en la tabla de usuarios de la bbdd
        $sql = "INSERT INTO usuarios VALUES(null,'$nombre','$apellido','$email','$password_segura',CURDATE());";
        $guardar = mysqli_query($db,$sql);
        if($guardar){
            $_SESSION['completado'] = "EL registro se a completado con exito";
        }else{
            $_SESSION['errores']['general'] = "Fallo al guardar usuario";
        }


    }else{
        // Redirigir al index
        $_SESSION['errores'] = $errores;
        header('location: index.php');
    }


}

header('location: index.php');
?>