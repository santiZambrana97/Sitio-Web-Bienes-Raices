<?php  
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en Venta frente al bosque</h1>

        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="anuncio">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$3.000.000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img src="build/img/icono_wc.svg" alt="icono wc">
                    <p>3</p>
                </li>
                <li>
                    <img src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p>2</p>
                </li>
                <li>
                    <img src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p>4</p>
                </li>
            </ul>

            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus ipsa incidunt cum sunt illo, facere provident consequatur, 
                officia est at pariatur saepe expedita eius doloribus obcaecati suscipit recusandae necessitatibus aspernatur?
                Beatae libero earum, ut impedit debitis omnis excepturi! Voluptate quod deleniti sint explicabo illum quidem voluptatem nam amet numquam architecto 
                reiciendis hic aspernatur, deserunt, ad, aliquam nobis harum magnam dolorem.
            </p>
        </div>
    </main>

    <?php incluirTemplate('footer'); ?>
        
</body>

</html>

