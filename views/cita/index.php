<h1 class="nombre-pagina">Crear nueva cita</h1>
<p class="descripcion-pagina">Elige tus servicios y coloca tus datos</p>

<?php 
    include_once __DIR__."/../templates/barra.php";
?>

<div id="app">
    <div class="tabs">
        <button class="actual" type="button" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Información cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </div>
    <div id="paso-1" class="seccion mostrar">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios a continuación</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>

    <div id="paso-2" class="seccion ocultar">
        <h2>Tus datos y cita</h2>
        <p class="text-center">Coloca tus datos y la fecha de tu cita</p>

        <form action="" class="formulario">
            
            <div class="campo">
                <label for="nombre">Nombre: </label>
                <input type="text" name="nombre" placeholder="Tu nombre" id="nombre" 
                        value="<?php echo $nombre ?>" disabled>
            </div>
    
            <div class="campo">
                <label for="fecha">Fecha: </label>
                <input type="date" name="fecha" id="fecha" 
                min="<?php echo date('Y-m-d', strtotime('+1 day')) ?>"
                required>
            </div>

            <div class="campo">
                <label for="hora">Hora: </label>
                <input type="time" name="hora" id="hora" required>
            </div>

            <input type="hidden" id="id" value="<?php echo $id ?>">

        </form>
    </div>

    <div id="paso-3" class="seccion ocultar contenido-resumen">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que la información sea correcta</p>
    </div>

    <div class="paginacion">
        <button id="anterior" class="boton">&laquo; Anterior</button>
        <button id="siguiente" class="boton">Siguiente &raquo;</button>
    </div>
</div>

<?php
    $script = "
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='build/js/app.js'></script>
    ";
?>
