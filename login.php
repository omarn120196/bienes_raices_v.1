<?php

    require 'includes/config/database.php';
    $db = conectarDB();

    $errores = [];

    //Autenticar el usuario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$email){
            $errores[] = ' El email es obligatorio o no es valido';
        }
        if(!$password){
            $errores[] = 'El password es obligatorio';
        }

        if(empty($errores)){
            
            //Revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '${email}';";
            $resultado = mysqli_query($db, $query);

            if($resultado->num_rows){
                //Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);

                //True o False si es correcto el password
                $auth = password_verify($password, $usuario['password']);

                if($auth){
                    //EL usuario ha sido autenticado
                    session_start();

                    //Llenar el arreglo de la sesion
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true; 

                    header('Location: /admin');
                }
                else{
                    $errores[] = 'El password es incorrecto';
                }
            }
            else{
                $errores[] = 'El usuario no existe';
            }
        }
    }

    require 'includes/funciones.php';
    incluirTemplate('header');

?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar sesión</h1>

        <?php foreach($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>    

        <form action="" class="formulario" method="POST">
            <fieldset>
                <legend>
                    Email y Password
                </legend>


                <label for="email">E-mail</label>
                <input id="email" name="email" type="email" placeholder="Tu Email" required>

                <label for="password">Password</label>
                <input id="password" name="password" type="password" placeholder="Tu Password" required>
            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>