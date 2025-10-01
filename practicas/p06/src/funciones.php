<?php
// Ejercicio 1: múltiplo de 5 y 7
function esMultiplo57($num) {
    return ($num % 5 == 0 && $num % 7 == 0);
}

// Ejercicio 2: generar números hasta impar-par-impar
function generarSecuencia() {
    $matriz = [];
    $iteraciones = 0;
    do {
        $fila = [rand(1,999), rand(1,999), rand(1,999)];
        $matriz[] = $fila;
        $iteraciones++;
    } while (!($fila[0] % 2 != 0 && $fila[1] % 2 == 0 && $fila[2] % 2 != 0));
    return ["matriz"=>$matriz,"iteraciones"=>$iteraciones];
}

// Ejercicio 3: encontrar múltiplo de un número dado
function encontrarMultiploWhile($n) {
    while (true) {
        $num = rand(1,1000);
        if ($num % $n == 0) return $num;
    }
}

function encontrarMultiploDoWhile($n) {
    do {
        $num = rand(1,1000);
    } while ($num % $n != 0);
    return $num;
}

?>
