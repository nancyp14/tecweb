<?php
include("src/funciones.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Práctica 6</title>
</head>
<body>
    <h1>Ejercicio 1</h1>
    <?php
    if (isset($_GET['numero'])) {
        $n = $_GET['numero'];
        if (esMultiplo57($n)) {
            echo "<p>$n es múltiplo de 5 y 7</p>";
        } else {
            echo "<p>$n NO es múltiplo de 5 y 7</p>";
        }
    } else {
        echo "<p>Pasa un número en la URL. Ej: ?numero=35</p>";
    }
    ?>
</body>
</html>
