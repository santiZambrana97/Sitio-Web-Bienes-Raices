<?php 

if(!isset($_SESSION)){
    session_start();
}

$autenticado = $_SESSION['login'] ?? false ;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="build/css/app.css">
</head>
<body>

    <!-- HEADER Y NAVEGACIÓN -->
    <header class="header inicio">
        <div class="contenedor contenido-header ">
          <div class="barra">
            <a href="index.php">
                <img src="build/img/logo.svg" alt="Logotipo Bienes Raices">
            </a>

            <div class="mobile-menu">
                <img src="build/img/barras.svg" alt="logo menu responsive">
            </div>

            <div class="derecha">
                <img  class="dark-mode-boton" src="build/img/dark-mode.svg">
                <nav class="navegacion">
                    <a href="nosotros.php">Nosotros</a>
                    <a href="anuncios.php">Anuncios</a>
                    <a href="blog.php">Blog</a>
                    <a href="contacto.php">Contacto</a>
                    <?php if($autenticado): ?>
                        <a href="cerrar-sesion.php">Cerrar Sesión</a>
                    <?php endif; ?>
                </nav>
            </div>      

          </div> <!--Barra de Navegacion-->

          <h1>Venta de Casas y Departamentos de Lujo</h1>
        </div>
    </header>

    <!-- SECCION SOBRE NOSOTROS -->
    <main class="contenedor seccion"> 
        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sapiente esse nesciunt omnis officia enim? 
                    Beatae consequuntur sapiente labore nulla architecto saepe, dolor modi repellat cupiditate deleniti 
                    minima soluta eius maiores?</p>
            </div>

            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono precio">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sapiente esse nesciunt omnis officia enim? 
                    Beatae consequuntur sapiente labore nulla architecto saepe, dolor modi repellat cupiditate deleniti 
                    minima soluta eius maiores?</p>
            </div>

            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono tiempo">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sapiente esse nesciunt omnis officia enim? 
                    Beatae consequuntur sapiente labore nulla architecto saepe, dolor modi repellat cupiditate deleniti 
                    minima soluta eius maiores?</p>
            </div>
        </div>
    </main>

    <!-- CASAS Y DEPARTAMENTOS EN VENTA -->
    <section class="seccion contenedor">
        <h2>Casas y Depas en Venta</h2>

        <?php

        $limite = 3;
        include 'includes/templates/anuncios.php'; 
        
        ?>

        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver Todas</a>
        </div>       
    </section>

    <!-- BANER DE CONTACTO -->
    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad.</p>
        <a href="contacto.php" class="boton-naranja-block">Contactanos</a>
    </section>

    <!-- BLOG -->
    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpg">
                        <img loading="lazy" src="buid/img/blog1.jpg">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span> </p>
                        <p>Consejos para construir una terraza en el techo de tu casa con los 
                            mejores materiales y ahorrando dinero.</p>
                    </a>
                </div>
            </article>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpg">
                        <img loading="lazy" src="buid/img/blog2.jpg">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Construye una alberca en tu hogar</h4>
                        <p class="informacion-meta">Escrito el: <span>12/7/2021</span> por: <span>Santiago</span> </p>
                        <p>Maximiza el espacio en tu hogar con esta guia, aprende a combinar 
                            muebles y colores para darle vida a tu espacio.</p>
                    </a>
                </div>
            </article>

           
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente forma, muy buena atención y la casa que me
                    ofrecieron cumple con todas mis expectativas.
                </blockquote>
                <p>-Santiago Zambrana</p>
            </div>
        </section>

    </div>
    
    <?php 
    require 'includes/funciones.php';
    incluirTemplate('footer')?>

 
</body>
</html>