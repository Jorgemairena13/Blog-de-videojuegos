<?php require_once 'conexion.php';?>
<?php require_once 'helpers.php';?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog de videojuegos</title>
    <link rel="stylesheet" href="assets/css/style2.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">

</head>
<body>
    
    
    <!-- Cabezera -->
     
    <header id="cabecera">
        <div id="logo">
            <a href="index.php">Blog de videojuegos
        </a>
        </div>
        <!-- Menu -->
         
        <nav id="menu">
            <ul>
                <li>
                    <a href="index.php">Inicio</a>
                </li>
                <li>
                    <?php $categorias = conseguirCategorias($db);
                    if(!empty($categorias)):
                    ?>
                    <?php while($categoria = mysqli_fetch_assoc($categorias)):?>
                <li>
                    <a href="categoria.php?id=<?=$categoria['id']?>"><?=$categoria['nombre'] ?></a>
                </li>
                <?php 
                    endwhile;
                    endif;  
                ?>   
                </li>
                
                <li>
                    <a href="index.php">Sobre mi</a>
                </li>
                <li>
                    <a href="index.php">Conctacto</a>
                </li>
            </ul>
        </nav>
    </header>

    <div id="contenedor">