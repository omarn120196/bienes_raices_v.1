<?php

    require 'includes/funciones.php';

    incluirTemplate('header');

?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Nuestro Blog</h1>

        <article class="entrada-blog">
            <figure class="imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog1.jpg" alt="Entrada Blog">
                </picture>
            </figure>

            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Terraza en el texto de tu casa</h4>
                    <p>Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>

                    <p>
                        Consejos para construit una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero
                    </p>
                </a>
            </div>
        </article>

        <article class="entrada-blog">
            <figure class="imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog1.jpg" alt="Entrada Blog">
                </picture>
            </figure>

            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Guía para la decoración de tu hogar</h4>
                    <p>Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>

                    <p>
                        Maximisa el espacio de tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio.
                    </p>
                </a>
            </div>
        </article>

        <article class="entrada-blog">
            <figure class="imagen">
                <picture>
                    <source srcset="build/img/blog3.webp" type="image/webp">
                    <source srcset="build/img/blog3.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog3.jpg" alt="Entrada Blog">
                </picture>
            </figure>

            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Terraza en el texto de tu casa</h4>
                    <p>Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>

                    <p>
                        Consejos para construit una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero
                    </p>
                </a>
            </div>
        </article>

        <article class="entrada-blog">
            <figure class="imagen">
                <picture>
                    <source srcset="build/img/blog4.webp" type="image/webp">
                    <source srcset="build/img/blog4.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog4.jpg" alt="Entrada Blog">
                </picture>
            </figure>

            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Guía para la decoración de tu hogar</h4>
                    <p>Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>

                    <p>
                        Maximisa el espacio de tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio.
                    </p>
                </a>
            </div>
        </article>
    </main>

<?php 
    incluirTemplate('footer');
?>