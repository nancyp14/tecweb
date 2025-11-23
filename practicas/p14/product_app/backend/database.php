<?php
    $conexion = @mysqli_connect(
        'localhost',
        'root',
        'roqR.05acm1',
        'marketzone'
    );

    /**
     * NOTA: si la conexión falló $conexion contendrá false
     **/
    if(!$conexion) {
        die('¡Base de datos NO conextada!');
    }
?>