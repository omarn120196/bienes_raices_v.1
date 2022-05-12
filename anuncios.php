<?php

    require 'includes/funciones.php';

    incluirTemplate('header');

?>

    <main class="contenedor seccion">
        <h1>Casas y Depas en venta</h1>

        <?php
            $limite = 10;
            include 'includes/templates/anuncios.php';
        ?>
    </main>

<?php 
    incluirTemplate('footer');
?>