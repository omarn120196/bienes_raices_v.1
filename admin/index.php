<?php

    //Incluir funciones
    require '../includes/app.php';
    estaAutenticado();

    use App\Propiedad;

    //Implementar un método para obtener todas las propiedades
    $propiedades = Propiedad::all();

    //Mostrar mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){

            $propiedad = Propiedad::find($id);
            $propiedad->eliminar();         
        }
    }

    //Inlcuir template
    incluirTemplate('header');

?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>

        <?php if(intval($resultado) === 1) : ?>
            <p class="alerta exito">Anuncio Creado Correctamente</p>
        <?php elseif(intval($resultado) === 2) : ?>
            <p class="alerta exito">Anuncio Actualizado Correctamente</p>
        <?php elseif(intval($resultado) === 3) : ?>
            <p class="alerta exito">Anuncio Eliminado Correctamente</p>
        <?php endif; ?>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach($propiedades as $propiedad) :?>

                <tr>
                    <td><?php echo $propiedad->id ?></td>
                    <td><?php echo $propiedad->titulo ?></td>
                    <td><img class="imagen-tabla" src="/imagenes/<?php echo $propiedad->imagen ?>" alt=""></td>
                    <td>$<?php echo $propiedad->precio ?></td>
                    <td>
                        <form action="" method="POST">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        
                        <a href="propiedades/actualizar.php?id=<?php echo $propiedad->id ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

<?php 

    //Cerrar la conexión
    mysqli_close($db);                

    incluirTemplate('footer');
?>