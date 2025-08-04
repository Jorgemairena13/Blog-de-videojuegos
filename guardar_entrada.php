<?php
if(isset($_POST)){
    require_once './assets/includes/conexion.php';
    $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db,$_POST['titulo']) : false;
    $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db,$_POST['descripcion']) : false;
    $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
    $usuario = $_SESSION['usuario']['id'];
    
    // Validacion
    $errores = array();

    if(empty($titulo)){
        $errores['titulo'] = "El titulo no es valido";
    }

    if(empty($descripcion)){
        $errores['descripcion'] = "La descripcion no es valida";
    }

    if(empty($categoria)){
        $errores['categoria'] = "La categoria no es valida";
    }
    
    if(count($errores) == 0){
        if(isset($_GET['editar'])){
            
            $entrada_id = $_GET['editar'];
            $sql = "UPDATE entradas SET titulo='$titulo',descripcion='$descripcion', categoria_id=$categoria ". 
            "WHERE id = $entrada_id AND usuario_id = $usuario";
        }else{
            $sql = "INSERT INTO entradas VALUES (NULL, $usuario , '$categoria', '$titulo','$descripcion',CURDATE());";
        }
        
        $guardar = mysqli_query($db,$sql);
        header("Location: index.php");
        
    }else{
        $_SESSION['errores_entrada'] = $errores;
        if(isset($_GET['editar'])){
            header("Location:editar_entrada.php?id=".$_GET['editar']);
        }
        header("Location: crear_entrada.php");
    }
    

}

?>