<h1 class="nombre-pagina">Crear cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>

<!-- Mostramos los errores  -->
<?php 
    include_once __DIR__."/../templates/alertas.php";
?>

<form action="/crear-cuenta" class="formulario" method="POST">
    <div class="campo">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" placeholder="Tu nombre" id="nombre" 
                    value="<?php echo $usuario->nombre ?>" required>
    </div>
    
    <div class="campo">
        <label for="apellido">Apellido: </label>
        <input type="text" name="apellido" placeholder="Tu apellido" id="apellido" 
                    value="<?php echo $usuario->apellido ?>" required>
    </div>

    <div class="campo">
        <label for="telefono">Teléfono: </label>
        <input type="tel" name="telefono" placeholder="Tu teléfono" id="telefono" 
                    value="<?php echo $usuario->telefono ?>" >
    </div>
    
    <div class="campo">
            <label for="email">E-mail: </label>
            <input type="email" name="email" placeholder="Tu e-mail" id="email" 
                    value="<?php echo $usuario->email ?>" required>
            
    </div>

    <div class="campo">
            <label for="pass">Password: </label>
            <input type="password" name="password" placeholder="Tu password" id="pass" 
                    value="<?php echo $usuario->password ?>" required>
    </div>

    <input type="submit" value="Crear cuenta" class="boton">
        
</form>
<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Iniciar sesión</a>
    <a href="/olvide">¿Olvidaste tu password?</a>
</div>