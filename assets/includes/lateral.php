<?php require_once 'helpers.php';?>

<aside id="sidebar">

    <div id="buscador" class="bloque">
        <form action="buscar.php" method="POST">
            <label for="busqueda">Buscar:</label>
            <input type="text" name="busqueda" id="busqueda" placeholder="Escribe tu búsqueda..." required>
            <input type="submit" value="Buscar">
        </form>
    </div>
    <?php if(isset($_SESSION['usuario'])): ?>
            <div id="usuario-logeado" class="bloque">
                <h3 class="nombre-usuario"> Bienvenido , <?=$_SESSION['usuario']['nombre'].' '. $_SESSION['usuario']['apellidos'];  ?></h3>
                <!-- Botones -->
                 <a href="crear_entrada.php" class="boton usuario">Crear entradas</a>
                 <a href="crear_categoria.php" class="boton usuario">Crear categoria</a>
                 <a href="mis_datos.php" class="boton usuario">Mis datos</a>
                 <a href="cerrar_sesion.php" class="boton usuario">Cerrar sesion</a>
            </div>
    <?php else: ?>
            <!-- Solo mostrar login y registro si NO está logueado -->
            <div id="login" class="bloque">
                <h3>Identificate</h3>

                <?php if(isset($_SESSION['error_login'])): ?>
                    <div class="alerta alerta-error">
                        <h3><?=$_SESSION['error_login'];?></h3>
                    </div>  
                <?php endif;?>

                <form action="login.php" method="POST">
                    <label for="email">Email</label>
                    <input type="email" name="email" >

                    <label for="password">Contraseña</label>
                    <input type="password" name="password" >

                    <input type="submit" value="Entrar">
                </form>
            </div>

            <div id="register" class="bloque">
                <h3>Registrate</h3>
                <!-- Mostrar errores -->
                <?php if(isset($_SESSION['completado'])) : ?>
                    <div class="alerta alerta-exito">
                        <?= $_SESSION['completado'];?>
                    </div>
                <?php elseif(isset($_SESSION['errores']['general'])):?>
                    <div class="alerta alerta-error">
                        <?=$_SESSION['errores']['general'];?>
                    </div>
                <?php endif;?>
                
                <form action="registro.php" method="POST">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="">
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'nombre'): ''; ?>

                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" id="">
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'apellidos'): ''; ?>

                    <label for="email">Email</label>
                    <input type="email" name="email" id="">
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'email'): ''; ?>

                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="">
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'password'): ''; ?>

                    <input type="submit" value="Registrar" name="submit">
                </form>
                <?php borrarErrores();?>
            </div>
    <?php endif;?>

</aside>