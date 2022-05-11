<?php 

function conectarDB() : mysqli{
    $db = mysqli_connect('localhost', 'root', 'oanm1296', 'bienes_raices');

    if(!$db){
        echo "No se pudo conectar";
        exit;
    }

    return $db;
}