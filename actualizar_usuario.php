<?php


if(isset($_POST)){

    // Conexion con la base de datos
    require_once 'assets/includes/conexion.php';
    

    // Recoger valores del formulario de actualizacion
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db,$_POST['nombre']):false;
    $apellido = isset($_POST['apellidos']) ? mysqli_real_escape_string($db,$_POST['apellidos']):false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db,trim($_POST['email'])) : false;

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

    $guardar_usuario = false;
    if(count($errores) == 0){
        // Insertar usuario en la base de datos
        $guardar_usuario = true;
        $usuario = $_SESSION['usuario'];

        // Comprobar si el email ya existe
        $sql = "SELECT email FROM usuarios WHERE email = '$email';";
        $existe_email = mysqli_query($db,$sql);
        $existe_usuario = mysqli_fetch_assoc($existe_email);
        if($existe_usuario['id'] == $usuario['id'] || empty($existe_usuario) ){
            // Actualizar usuario en la tabla de usuarios de la bbdd
            $usuario = $_SESSION['usuario'];
            $sql = "UPDATE usuarios SET ". 
            "nombre = '$nombre', " .
            "apellidos = '$apellido', " . 
            "email = '$email'" . 
            "WHERE id = " . $usuario['id'] . ";" ;


            $guardar = mysqli_query($db,$sql);

            if($guardar){
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellidos'] = $apellido;
                $_SESSION['usuario']['email'] = $email;
                $_SESSION['completado'] = "Tus datos se han actualizado con exito";
            }else{
                $_SESSION['errores']['general'] = "Fallo al actualizar usuario";
        }

        }else{
             $_SESSION['errores']['general'] = "El usuario ya existe";
        }

        


    }else{
        // Redirigir al index
        $_SESSION['errores'] = $errores;
        header('location: index.php');
    }


}

header('location: mis_datos.php');
?>