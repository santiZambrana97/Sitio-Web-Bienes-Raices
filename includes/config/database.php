<?php

function conectarDB () : mysqli {
    $db = mysqli_connect('localhost', 'root', 'root', 'bienes_raices' );

    if(!$db){
        echo "Error No Se pudo conectar";
        exit;
    }

    return $db;
}