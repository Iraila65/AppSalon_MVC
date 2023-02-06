<main class="contenedor seccion">
    <h1 class="nombre-pagina">Login</h1>
    <p class="descripcion-pagina">Inicia sesión con tus datos</p>

    <!-- Mostramos los errores  -->
    <?php 
        include_once __DIR__."/../templates/alertas.php";
    ?>

    <form action="/" class="formulario" method="POST">
        <div class="campo">
            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="Tu e-mail" id="email" 
                    value="<?php echo $auth->email ?>" required>
            
        </div>

        <div class="campo">
            <label for="pass">Password</label>
            <input type="password" name="password" placeholder="Tu password" id="pass" 
                    value="<?php echo $auth->password ?>" required>
        </div>

        <input type="submit" value="Iniciar sesión" class="boton">
        
    </form>

    <div class="acciones">
        <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear una</a>
        <a href="/olvide">¿Olvidaste tu password?</a>
    </div>
</main>