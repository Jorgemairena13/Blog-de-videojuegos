<!-- Redirrecion por si no esta logeado -->
<?php require_once './assets/includes/redireccion.php'?>

<!-- Incluir cabezera -->
<?php require_once 'assets/includes/cabezera.php';?>

<!-- Sidebar -->
<?php require_once 'assets/includes/lateral.php';?>

<!-- Caja principal -->
<div id="principal">
    
    <h1>Mis datos</h1>
    <?php if(isset($_SESSION['completado'])) : ?>
                    <div id="alerta alerta-exito">
                        <?= $_SESSION['completado'];?>
                    </div>
                    
                <?php elseif(isset($_SESSION['errores']['general'])):?>
                    <div class="alerta alerta-error">
                        <?=htmlspecialchars($_SESSION['errores']['general']);?>
                    </div>
                <?php endif;?>
                
                <form action="actualizar_usuario.php" method="POST">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" value="<?= $_SESSION['usuario']['nombre']?>" >
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'nombre'): ''; ?>

                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" value="<?= $_SESSION['usuario']['apellidos']?>" >
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'apellidos'): ''; ?>

                    <label for="email">Email</label>
                    <input type="email" name="email" value="<?= $_SESSION['usuario']['email']?>" >
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'email'): ''; ?>
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'password'): ''; ?>

                    <input type="submit" value="Actualizar" name="submit">
                </form>
                <?php borrarErrores();?>
            
</div>  <!--Fin del div principal  -->


<!-- Pie de pagina -->
<?php require_once 'assets/includes/pie.php';?>