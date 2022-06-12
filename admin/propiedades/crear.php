<?php

    //Importar funciones
    require '../../includes/app.php';

    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;

    estaAutenticado();

    $db = conectarDB();

    $propiedad = new Propiedad;

    //Consultar para obtener vendedores
    $consulta = "SELECT * FROM vendedores";
    $respuesta = mysqli_query($db, $consulta);

    //Arreglo con mensaje de errores
    $errores = Propiedad::getErrores();

    //Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $propiedad = new Propiedad($_POST['propiedad']);

        //Generar un nombre unico
        $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

        if($_FILES['propiedad']['tmp_name']['imagen']){
            //Realizar un resize a la imagen
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
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
            $propiedad->guardar();
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

            <?php include '../../includes/templates/formulario_propiedades.php'; ?>
            <input type="submit" value="Crear Propiedad" class="boton boton-verde">

        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>