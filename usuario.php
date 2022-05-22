<?php

    //Importar conexión 
    require 'includes/app.php';
    $db = conectarDB();

    //Crear email y Password
    $email = 'omis1296@gmail.com';
    $password = 'oanm1296';

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    //Query para crear el usuario
    $query = "INSERT INTO usuarios (email, password) VALUES ('${email}', '${passwordHash}');";

    mysqli_query($db, $query);