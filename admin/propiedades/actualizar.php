<?php

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /admin');
    }

    //Importar la Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    //Consulta id
    $consultaId = "SELECT * FROM propiedades WHERE id = ${id};";
    $resultadoID = mysqli_query($db, $consultaId);
    $propiedad = mysqli_fetch_assoc($resultadoID);

    //Consultar para obtener vendedores
    $consulta = "SELECT * FROM vendedores";
    $respuesta = mysqli_query($db, $consulta);

    //Importar funciones
    require '../../includes/funciones.php';

    //Arreglo con mensaje de errores
    $errores = [];

    $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc = $propiedad['wc'];
    $estacionamiento = $propiedad['estacionamiento'];
    $vendedorId = $propiedad['vendedorId'];
    $imagenPropiedad = $propiedad['imagen'];

    //Ejecutar el cpodigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string($db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
        $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
        $creado = date('Y/m/d');

        //Asignar fileshacia una variable
        $imagen = $_FILES['imagen'];

        if(!$titulo){
            $errores[] = 'Debes añadir un título';
        }
        if(!$precio){
            $errores[] = 'Debes añadir un precio';
        }
        if(strlen($descripcion) < 50){
            $errores[] = 'Debes añadir una descripcion y debe contener al menos 50 caracteres';
        }
        if(!$habitaciones){
            $errores[] = 'Debes añadir un numero de habitaciones';
        }
        if(!$wc){
            $errores[] = 'Debes añadir un numero de baños';
        }
        if(!$estacionamiento){
            $errores[] = 'Debes añadir el numero de estacionamientos';
        }
        if(!$vendedorId){
            $errores[] = 'Elige un vendedor';
        }

        // Validar por tamaño (100kb)
        $medida = 1000 * 1000;
        if($imagen['size'] > $medida){
            $errores[] = 'La imágen es muy pesada';
        }

        //Revisar que el arreglo de errores este vacio
        if(empty($errores)){

            //Crear carpeta de imagen
            $carpetaImagenes = '../../imagenes/';

            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            $nombreImagen = '';

            if($imagen['name']){

                //Eliminar la imagen previa
                unlink($carpetaImagenes . $propiedad['imagen']);

                //Generar un nombre unico
                $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

                //Subir imagen
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
            }
            else{
                $nombreImagen = $propiedad['imagen'];
            }

            //Insertar en la BD
            $query = "UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}', imagen = '${nombreImagen}', descripcion = '${descripcion}', habitaciones = ${habitaciones}, wc = ${wc}, estacionamiento = ${estacionamiento}, vendedorId = ${vendedorId} WHERE id = ${id};";

            $resultado = mysqli_query($db, $query);

            if($resultado){
                
                //Redireccionar al usuario
                header('Location: /admin?resultado=2');
            }
        }

        
    }

    incluirTemplate('header');

?>

    <main class="contenedor seccion">
        <h1>Actualizar</h1>

        <?php foreach($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>
        <?php endforeach; ?>    

        <a href="/admin" class="boton boton-verde">Volver</a>

        <form class="formulario" method="POST" enctype="multipart/form-data">

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
            
                <img class="imagen-small" src="/imagenes/<?php echo $imagenPropiedad ?>" alt="">

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

            <select name="vendedor" id="">
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

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">

        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>