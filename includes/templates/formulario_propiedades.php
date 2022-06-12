<fieldset>
            <legend>Información General</legend>

            <label for="titulo">TITULO</label>
            <input 
                type="text" 
                id="titulo" 
                name="propiedad[titulo]" 
                placeholder="Titulo propiedad" 
                value="<?php echo sanitizar($propiedad->titulo); ?>">

            <label for="precio">PRECIO</label>
            <input 
                type="number" 
                id="precio" 
                name="propiedad[precio]" 
                placeholder="Precio propiedad" 
                value="<?php echo sanitizar($propiedad->precio); ?>">

            <label for="imagen">IMAGEN</label>
            <input 
                type="file" 
                name="propiedad[imagen]" 
                accept="image/jpeg, image/png" 
                id="imagen">

                <?php if($propiedad->imagen) : ?>
                    <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small" alt="">
                <?php endif; ?>

            <label for="descripcion">DESCRIPCION</label>
            <textarea name="propiedad[descripcion]" id="descripcion"><?php echo sanitizar($propiedad->descripcion); ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información de la Propiedad</legend>

            <label for="habitaciones">Habitaciones</label>
            <input 
                type="number" 
                id="habitaciones" 
                name="propiedad[habitaciones]" 
                min="1" 
                max="9" 
                placeholder="Ej. 3" 
                value="<?php echo sanitizar($propiedad->habitaciones); ?>">

            <label for="wc">Baños</label>
            <input 
                type="number" 
                id="wc" 
                min="1" 
                max="9" 
                name="propiedad[wc]" 
                placeholder="Ej. 3" 
                value="<?php echo sanitizar($propiedad->wc); ?>">

            <label for="estacionamiento">Estacionamiento</label>
            <input 
                type="number" 
                id="estacionamiento" 
                min="1" 
                max="9" 
                placeholder="Ej. 3" 
                name="propiedad[estacionamiento]" 
                value="<?php echo sanitizar($propiedad->estacionamiento); ?>">
        </fieldset>

        <fieldset>
            <!--  -->
        </fieldset>