<?php

    require 'includes/app.php';

    incluirTemplate('header');

?>

    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>

        <div class="contenido-nosotros">
            <figure class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre nosotros">
                </picture>
            </figure>

            <div class="texto-nosotros">
                <blockquote>
                    25 años de experiencia
                </blockquote>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam omnis accusantium, vero unde porro minus eaque maiores cumque quae, quo, totam necessitatibus vel blanditiis ratione. Necessitatibus possimus, eveniet, dolore minus similique facilis fugiat et dolorum provident dolorem assumenda, harum tenetur vero error dolores eaque vitae facere. Est provident dolore nemo tenetur optio consectetur illum dolor, magni temporibus? Quisquam modi tempora, sint ipsam quas incidunt, quod facere voluptatem dolor quasi fugiat dolorem ipsum aspernatur. Sapiente rerum quae fugit, quaerat unde veniam?
                </p>

                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti in voluptatem laboriosam iste! Deleniti ratione beatae illo ab? Repudiandae, nostrum. Cumque quaerat, sequi voluptates reiciendis repudiandae in officia ex accusantium sed, ratione nam quos placeat!
                </p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Más sobre nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut delectus illum suscipit unde voluptatem quae laboriosam ex iure atque assumenda!</p>
            </div>

            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut delectus illum suscipit unde voluptatem quae laboriosam ex iure atque assumenda!</p>
            </div>

            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut delectus illum suscipit unde voluptatem quae laboriosam ex iure atque assumenda!</p>
            </div>
        </div>
    </section>

<?php 
    incluirTemplate('footer');
?>