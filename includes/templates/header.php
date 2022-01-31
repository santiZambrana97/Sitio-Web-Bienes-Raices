<?php 

if(!isset($_SESSION)){ //Determina si una variable está definida y no es null
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
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>

    <header class="header">
        <div class="contenedor contenido-header ">
          <div class="barra">
            <a href="index.php">
                <img src="/build/img/logo.svg" alt="Logotipo Bienes Raices">
            </a>

            <div class="mobile-menu">
                <img src="/build/img/barras.svg" alt="logo menu responsive">
            </div>

            <div class="derecha">
                <img  class="dark-mode-boton" src="/build/img/dark-mode.svg">
                <nav class="navegacion">
                    <a href="/nosotros.php">Nosotros</a>
                    <a href="/anuncios.php">Anuncios</a>
                    <a href="/blog.php">Blog</a>
                    <a href="/contacto.php">Contacto</a>
                    <?php if($autenticado): ?>
                        <a href="cerrar-sesion.php">Cerrar Sesión</a>
                    <?php endif; ?>
                </nav>
            </div>    

          </div> <!--Barra de Navegacion-->
        </div>
    </header>