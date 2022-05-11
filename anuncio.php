<?php

    require 'includes/funciones.php';

    incluirTemplate('header');

?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en venta frente al bosque</h1>

        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpeg">

            <img loading="lazy" src="build/img/destacada.jpg" alt="Imagen de la propiedad">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$3,000,000</p>
            
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="Icono wc">
                    <p>3</p>
                </li>

                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono estacionamiento">
                    <p>3</p>
                </li>

                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono dormitorio">
                    <p>4</p>
                </li>
            </ul>

            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam ea error iure consequuntur quos vel, facere doloribus vero odio natus ullam iusto rem porro laborum! Obcaecati nisi dolorum earum. Sint quis, voluptate itaque ea voluptatem magni eum ipsum asperiores quas vitae. Nisi expedita, voluptas enim voluptatum, beatae officia pariatur in mollitia aliquid quibusdam itaque repellendus commodi accusantium vitae porro, sapiente libero ipsum voluptates eius dolor veritatis! Consectetur dolorum vero provident commodi obcaecati, dolore quas debitis maiores unde pariatur eos quaerat, nisi error voluptatem eius distinctio similique consequuntur itaque id. Officiis nam blanditiis repudiandae adipisci beatae, natus suscipit modi qui quo!
            </p>

            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. In asperiores sunt nam, animi dolores nihil! Aperiam impedit, amet unde tempora nisi debitis. Cum quae dolor officia, excepturi incidunt laborum at ut ullam rem culpa harum natus veritatis adipisci quibusdam, aperiam magnam voluptatibus. Quos unde cupiditate sint dolores ipsa consequatur iusto.</p>
        </div>
    </main>

<?php 
    incluirTemplate('footer');
?>