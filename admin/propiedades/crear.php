<?php

    //Importar funciones
    require '../../includes/app.php';

    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;

    estaAutenticado();

    $db = conectarDB();

    //Consultar para obtener vendedores
    $consulta = "SELECT * FROM vendedores";
    $respuesta = mysqli_query($db, $consulta);

    //Arreglo con mensaje de errores
    $errores = Propiedad::getErrores();

    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedorId = '';

    //Ejecutar el cpodigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $propiedad = new Propiedad($_POST);

        //Generar un nombre unico
        $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

        if($_FILES['imagen']['tmp_name']){
            //Realizar un resize a la imagen
            $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
            $propiedad->setImagen($nombreImagen);
        }

        // Validar
        $errores = $propiedad->validar();
         
        //Revisar que el arreglo de errores este vacio
        if(empty($errores)){

            //Crear carpeta de imagen
            if(!is_dir(CARPETA_IMAGENES)){
                mkdir( CARPETA_IMAGENES);
            }
            
            //Guarda la imagen en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);
            
            // Guardar en la base de datos
            $resultado = $propiedad->guardar();

            if($resultado){
                
                //Redireccionar al usuario
                header('Location: /admin?resultado=1');
            }
        }

        
    }

    incluirTemplate('header');

?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <?php foreach($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>
        <?php endforeach; ?>    

        <a href="/admin" class="boton boton-verde">Volver</a>

        <form action="/admin/propiedades/crear.php" class="formulario" method="POST" enctype="multipart/form-data">

        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">TITULO</label>
            <input 
                type="text" 
                id="titulo" 
                name="titulo" 
                placeholder="Titulo propiedad" 
                value="<?php echo $titulo; ?>">

            <label for="precio">PRECIO</label>
            <input 
                type="number" 
                id="precio" 
                name="precio" 
                placeholder="Precio propiedad" 
                value="<?php echo $precio; ?>">

            <label for="imagen">IMAGEN</label>
            <input 
                type="file" 
                name="imagen" 
                accept="image/jpeg, image/png" 
                id="imagen">

            <label for="descripcion">DESCRIPCION</label>
            <textarea name="descripcion" id="descripcion"><?php echo $descripcion; ?></textarea>
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
                value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños</label>
            <input 
                type="number" 
                id="wc" 
                min="1" 
                max="9" 
                name="wc" 
                placeholder="Ej. 3" 
                value="<?php echo $wc; ?>">

            <label for="estacionamiento">Estacionamiento</label>
            <input 
                type="number" 
                id="estacionamiento" 
                min="1" 
                max="9" 
                placeholder="Ej. 3" 
                name="estacionamiento" 
                value="<?php echo $estacionamiento; ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedorId" id="">
                <option value="">--Seleccione--</option>
                <?php while($vendedor = mysqli_fetch_assoc($respuesta)) : ?>
                    <option 
                        <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> 
                        value="<?php echo $vendedor['id']; ?>">
                            <?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">

        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>