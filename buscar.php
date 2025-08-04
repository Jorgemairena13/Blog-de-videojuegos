<!-- Validar la búsqueda -->
<?php
    // Verificar que se haya enviado una búsqueda
    if (!isset($_POST['busqueda']) || empty(trim($_POST['busqueda']))) {
        header("Location: index.php");
        exit(); // ¡MUY IMPORTANTE! Detener la ejecución
    }
    
    // Limpiar la búsqueda
    $busqueda = trim($_POST['busqueda']);
?>

<!-- Cabecera -->
<?php require_once 'assets/includes/cabezera.php'; ?>
<!-- Sidebar -->
<?php require_once 'assets/includes/lateral.php'; ?>

<!-- Contenido central -->
<div id="principal">
    <h1>Búsqueda de: "<?= htmlspecialchars($busqueda) ?>"</h1>

    <?php
        $entradas = conseguirEntradas($db, null, null, $busqueda);
        if (!empty($entradas) && mysqli_num_rows($entradas) >= 1):
            while ($entrada = mysqli_fetch_assoc($entradas)): ?>
                <article class="entrada">
                    <a href="entrada.php?id=<?= $entrada['id'] ?>">
                        <h2><?= htmlspecialchars($entrada['titulo']) ?></h2>
                        <span class="fecha"><?= htmlspecialchars($entrada['categoria']) . ' | ' . $entrada['fecha'] ?></span>
                        <p>
                            <?= htmlspecialchars(substr($entrada['descripcion'], 0, 200)) . '...' ?>
                        </p>
                    </a>
                </article>
            <?php endwhile;
        else: ?>
            <div class="alerta">No se encontraron entradas para "<?= htmlspecialchars($busqueda) ?>"</div>
        <?php endif; ?>
    
    <div id="ver-todas">
        <a href="entradas.php">Ver todas las entradas</a>
    </div>
</div> <!-- Div final -->

<!-- Pie de página -->
<?php require_once 'assets/includes/pie.php'; ?>



    

<!-- Pie de pagina -->
    <?php require_once 'assets/includes/pie.php';?>