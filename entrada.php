<?php require_once 'assets/includes/helpers.php';?>
<?php require_once 'assets/includes/conexion.php';?>

<!-- Conseguir la categoria por get -->
<?php
    $entrada_actual = conseguirEntrada($db,$_GET['id']);
    // Redirifimos al index en caso de que no exista
    if(!isset($entrada_actual['id'])){
        header("Location:index.php");
    }
        
?>

<!-- Cabezera -->
<?php require_once 'assets/includes/cabezera.php';?>
<!-- Sidebar -->
<?php require_once 'assets/includes/lateral.php';?>

<!-- Contenido central -->
    <div id="principal">
    
    
    <h1><?=htmlspecialchars($entrada_actual['titulo'])?></h1>
    <a href="categoria.php?id=<?=$entrada_actual['categoria_id']?>">
        <h2><?=htmlspecialchars(string: $entrada_actual['categoria'])?></h2>
    </a>
    
    <h4><?=htmlspecialchars(string: $entrada_actual['fecha'])?> | <?=$entrada_actual['usuario']?></h4>

    <p><?=htmlspecialchars(string: $entrada_actual['descripcion'])?></p>
    <br>
    <?php if(isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $entrada_actual['usuario_id']): ?>
        <!-- Botones -->
        <a href="editar_entrada.php?id=<?=$entrada_actual['id']?>" class="boton usuario">Editar entrada</a>
        <a href="borrar_entrada.php?id=<?=$entrada_actual['id']?>" class="boton usuario">Borrar entrada</a>
    <?php endif;?>    
        
    </div>
    </div> <!-- Div final -->



    

<!-- Pie de pagina -->
    <?php require_once 'assets/includes/pie.php';?>
