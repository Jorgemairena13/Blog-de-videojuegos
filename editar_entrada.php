<?php require_once './assets/includes/redireccion.php'?>
<!-- Incluir cabezera -->
<?php require_once 'assets/includes/cabezera.php';?>

<!-- Sidebar -->
<?php require_once 'assets/includes/lateral.php';?>

<!-- Conseguir la categoria por get -->
<!-- <?php
    $entrada_actual = conseguirEntrada($db,$_GET['id']);
    // Redirifimos al index en caso de que no exista
    if(!isset($entrada_actual['id'])){
        header("Location:index.php");
    }
        
?> -->

<!-- Contenido central -->
    <div id="principal">
        <h1>Editar entradas</h1>
        <p>Aquí puedes editar el contenido de tu entrada. Revisa bien toda la información antes de actualizar.</p>
        <br>
        <form action="guardar_entrada.php?editar=<?=$entrada_actual['id']?>" method="post">

        <Label for="titulo">Titulo</Label>
        <input type="text" name="titulo" value="<?=$entrada_actual['titulo']?>">
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'],'titulo'): ''?>

        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion"><?=$entrada_actual['descripcion']?></textarea>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'],'descripcion'): ''?>

        <label for="categoria">Categorias</label>
        <select name="categoria">
            <?php $categorias = conseguirCategorias($db);
                if(!empty($categorias)):
                while($categoria =mysqli_fetch_assoc($categorias)): 
            ?>
                <option value="<?=$categoria['id']?>" <?= ($categoria['id'] == $entrada_actual['categoria_id']) ? 'selected="selected"' : '' ?>>
                    <?=$categoria['nombre']?>
                </option>

            <?php
                endwhile;
            endif;    
            ?>

        </select>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'],'categoria'): ''?>

        <input type="submit" value="Actualizar">
        </form>
        <?php borrarErrores();?>
    </div> <!-- Div final -->


    <!-- Pie de pagina -->
    <?php require_once 'assets/includes/pie.php';?>