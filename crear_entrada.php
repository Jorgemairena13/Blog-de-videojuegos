<?php require_once './assets/includes/redireccion.php'?>
<!-- Incluir cabezera -->
<?php require_once 'assets/includes/cabezera.php';?>

<!-- Sidebar -->
<?php require_once 'assets/includes/lateral.php';?>

<!-- Contenido central -->
    <div id="principal">
        <h1>Crear entradas</h1>
        <p>Añade nuevas entradas al blog para que los usuarios puedan leerlas y disfrutar de nuestro contenido.</p>
        <br>
        <form action="guardar_entrada.php" method="post">

        <Label for="titulo">Titulo</Label>
        <input type="text" name="titulo">
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'],'titulo'): ''?>

        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion"></textarea>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'],'descripcion'): ''?>

        <label for="categoria">Categorias</label>
        <select name="categoria">
            <?php $categorias = conseguirCategorias($db);
                if(!empty($categorias)):
                while($categoria =mysqli_fetch_assoc($categorias)): 
            ?>
                <option value="<?=$categoria['id']?>">
                    <?=$categoria['nombre']?>
                </option>
            <?php
                endwhile;
            endif;    
            ?>

        </select>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'],'categoria'): ''?>

        <input type="submit" value="Guardar">
        </form>
        <?php borrarErrores();?>
    </div> <!-- Div final -->


    <!-- Pie de pagina -->
    <?php require_once 'assets/includes/pie.php';?>