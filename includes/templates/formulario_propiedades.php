<fieldset>
            <legend>Información General</legend>

            <label for="titulo">TITULO</label>
            <input 
                type="text" 
                id="titulo" 
                name="titulo" 
                placeholder="Titulo propiedad" 
                value="<?php echo sanitizar($propiedad->titulo); ?>">

            <label for="precio">PRECIO</label>
            <input 
                type="number" 
                id="precio" 
                name="precio" 
                placeholder="Precio propiedad" 
                value="<?php echo sanitizar($propiedad->precio); ?>">

            <label for="imagen">IMAGEN</label>
            <input 
                type="file" 
                name="imagen" 
                accept="image/jpeg, image/png" 
                id="imagen">

            <label for="descripcion">DESCRIPCION</label>
            <textarea name="descripcion" id="descripcion"><?php echo sanitizar($propiedad->descripcion); ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información de la Propiedad</legend>

            <label for="habitaciones">Habitaciones</label>
            <input 
                type="number" 
                id="habitaciones" 
                name="habitaciones" 
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
                name="wc" 
                placeholder="Ej. 3" 
                value="<?php echo sanitizar($propiedad->wc); ?>">

            <label for="estacionamiento">Estacionamiento</label>
            <input 
                type="number" 
                id="estacionamiento" 
                min="1" 
                max="9" 
                placeholder="Ej. 3" 
                name="estacionamiento" 
                value="<?php echo sanitizar($propiedad->estacionamiento); ?>">
        </fieldset>

        <fieldset>
            <!--  -->
        </fieldset>