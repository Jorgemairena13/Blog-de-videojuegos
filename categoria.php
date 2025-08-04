<?php require_once 'assets/includes/helpers.php';?>
<?php require_once 'assets/includes/conexion.php';?>

<!-- Conseguir la categoria por get -->
<?php
    $categoria_actual = conseguirCategoria($db,$_GET['id']);
    // Redirifimos al index en caso de que no exista
    if(!isset($categoria_actual['id'])){
        header("Location:index.php");
    }
        
?>

<!-- Cabezera -->
<?php require_once 'assets/includes/cabezera.php';?>
<!-- Sidebar -->
<?php require_once 'assets/includes/lateral.php';?>

<!-- Contenido central -->
    <div id="principal">
    
    
    <h1>Entradas de <?=htmlspecialchars($categoria_actual['nombre'])?></h1>
    <?php
        $entradas =  conseguirEntradas($db,null, (int)$_GET['id']);
        if(!empty($entradas) && mysqli_num_rows($entradas) >= 1):
            while($entrada = mysqli_fetch_assoc($entradas)): ?>
                <article id="entrada">
                <a href="entrada.php?id=<?=$entrada['id']?>">
            <h2><?=htmlspecialchars($entrada['titulo']);?></h2>
            <span class="fecha"><?=htmlspecialchars($entrada['categoria'] . ' | ' . $entrada['fecha'])?></span>
            <p>
                <?=htmlspecialchars(substr($entrada['descripcion'],0,200)).'...'; ?>
            </p>
        </a>
    </article>
    <?php
    endwhile;
    else: 
    ?>
    <div class="alerta">No hay entradas en esta categoria</div>
    <?php
    endif;
    ?>
    
    
    <div id="ver-todas">
    <a href="entradas.php">Ver todas las entradas</a>
    </div>
    </div> <!-- Div final -->



    

<!-- Pie de pagina -->
<?php require_once 'assets/includes/pie.php';?>
