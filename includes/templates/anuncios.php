<?php 

//Importar la conexion
require __DIR__ . '/../config/database.php';
$db = conectarDB();

//Consultar la bd
$query ="SELECT * FROM propiedades LIMIT ${limite}";

//obtener resultado
$resultado = mysqli_query($db, $query);


?>

<div class="contenedor-anuncios">
    <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
        <div class="anuncio">
                
                <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="anuncio">
  

                <div class="contenido-anuncio">
                    <h3><?php echo $propiedad['titulo']; ?></h3>
                    <p><?php echo $propiedad['descripcion']; ?></p>
                    <p class="precio"><?php echo $propiedad['precio']; ?></p>

                    <ul class="iconos-caracteristicas">
                        <li>
                            <img src="build/img/icono_wc.svg" alt="icono wc">
                            <p><?php echo $propiedad['wc']; ?></p>
                        </li>
                        <li>
                            <img src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                            <p><?php echo $propiedad['cocheras']; ?></p>
                        </li>
                        <li>
                            <img src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                            <p><?php echo $propiedad['habitaciones']; ?></p>
                        </li>
                    </ul>

                    <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class=" boton-naranja-block">
                        Ver Propiedad
                    </a>
                </div>
        </div> <!--Anuncio-->
    <?php endwhile ?>
</div> <!--Contenedor Anuncios--> 

<?php 
    //Cerrar la conexion
    mysqli_close($db);
?>