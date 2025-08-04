<?php require_once './assets/includes/redireccion.php'?>
<!-- Incluir cabezera -->
<?php require_once 'assets/includes/cabezera.php';?>

<!-- Sidebar -->
<?php require_once 'assets/includes/lateral.php';?>

<!-- Contenido central -->
    <div id="principal">
        <h1>Crear categorias</h1>
        <p>Añade nuevas categorias al blog para que los usuarios puedan crear las entradas.</p>
        <br>
        <form action="guardar_categoria.php" method="post">
        <Label for="nombre">Nombre de la categoria</Label>
        <input type="text" name="nombre" >
        <input type="submit" value="Guardar">
        </form>
    </div> <!-- Div final -->


    <!-- Pie de pagina -->
    <?php require_once 'assets/includes/pie.php';?>
    
    