<?php

    //Importar funciones

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

    require '../../includes/app.php';

    estaAutenticado();

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /admin');
    }

    //Consulta id
    $propiedad = Propiedad::find($id);

    //Consultar para obtener vendedores
    $consulta = "SELECT * FROM vendedores";
    $respuesta = mysqli_query($db, $consulta);

    //Arreglo con mensaje de errores
    $errores = Propiedad::getErrores();


    //Ejecutar el cpodigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //Asignar los atributos 
        $args = $_POST['propiedad'];
        
        $propiedad->sincronizar($args);

        $errores = $propiedad->validar(); 

        //Generar un nombre unico
        $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';
        
        if($_FILES['propiedad']['tmp_name']['imagen']){
            //Realizar un resize a la imagen
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
            $propiedad->setImagen($nombreImagen);
        }

        //Revisar que el arreglo de errores este vacio
        if(empty($errores)){
            //Almacenar imagen
            $image->save(CARPETA_IMAGENES . $nombreImagen);

            $propiedad->guardar();
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
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>
            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">

        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>