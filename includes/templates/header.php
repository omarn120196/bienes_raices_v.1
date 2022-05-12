<?php 

    if(!isset($_SESSION)){
        session_start();
    }

    $auth = $_SESSION['login'] ?? false;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : '' ?>">
        <div class="contenedor contenido-header">
            <nav class="barra">
                <a href="/index.php">
                    <img src="/build/img/logo.svg" alt="Logotipo de bienes raices">
                </a>

                <figure class="movil-menu">
                    <img src="/build/img/barras.svg" alt="Menú">
                </figure>

                <div class="derecha">
                    <img src="/build/img/dark-mode.svg" alt="Dark-Mode" class="dark-mode-boton">
                    
                    <div class="navegacion">
                        <a href="/nosotros.php">Nosotros</a>
                        <a href="/anuncios.php">Anuncios</a>
                        <a href="/blog.php">Blog</a>
                        <a href="/contacto.php">Contacto</a>
                        <?php if($auth) : ?>
                            <a href="/cerrarsesion.php">Cerrar Sesión</a>
                        <?php else : ?>
                            <a href="/login.php">Iniciar Sesión</a>
                        <?php endif; ?>
                    </div>    
                </div>
            </nav>

            <?php 
                if($inicio){
                    echo "<h1>Ventas de Casa y Departamentos Exclusivos de Lujo</h1>";
                }
            ?>

        </div>
    </header>