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
        <h1>Ejercicio 2</h1>
    <?php
    $res = generarSecuencia();
    echo "<table border='1'>";
    foreach ($res['matriz'] as $fila) {
        echo "<tr>";
        foreach ($fila as $val) {
            echo "<td>$val</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    echo "<p>Iteraciones: {$res['iteraciones']}</p>";
    echo "<p>Total números: " . ($res['iteraciones']*3) . "</p>";
    ?>

        <h1>Ejercicio 3</h1>
    <?php
    if (isset($_GET['divisor'])) {
        $d = $_GET['divisor'];
        echo "<p>Con while: " . encontrarMultiploWhile($d) . "</p>";
        echo "<p>Con do-while: " . encontrarMultiploDoWhile($d) . "</p>";
    } else {
        echo "<p>Pasa un divisor en la URL. Ej: ?divisor=13</p>";
    }
    ?>

        <h1>Ejercicio 4</h1>
    <?php
    $arr = arregloAscii();
    echo "<table border='1'>";
    foreach ($arr as $key => $val) {
        echo "<tr><td>$key</td><td>$val</td></tr>";
    }
    echo "</table>";
    ?>



</body>
</html>
