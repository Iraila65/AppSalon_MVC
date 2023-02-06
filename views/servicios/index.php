<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administración de Servicios</p>
<?php 
    include_once __DIR__."/../templates/barra.php";
?>

<div id="servicios-admin">
    <ul class="servicios">
        <?php         
            foreach($servicios as $servicio) {
        ?>          
            <div class="servicios-admin">
                <li>
                    <p>ID: <span><?php echo $servicio->id ?></span></p>
                    <p>Servicio: <span><?php echo $servicio->nombre ?></span></p>
                    <p>Precio: <span><?php echo $servicio->precio ?></span></p>                
                </li>
                <div class="acciones">
                    <a class="boton-actualizar" href="/servicios/actualizar?id=<?php echo $servicio->id ?>" >Actualizar</a>
                    <form action="/servicios/eliminar" method="POST">
                        <input type="hidden" name="id" value="<?php echo $servicio->id ?>">
                        <input type="submit" class="boton-eliminar" value="Eliminar">
                    </form>
                </div>
            </div>        
        <?php                
            } // Fin del foreach
        ?>

    </ul> 
</div>
