<?php /* p04/index.php */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Práctica 4 — Manejo de variables en PHP</title>
  <style>
    body { font-family: Arial, sans-serif; line-height:1.5; max-width: 900px; margin: 20px auto; padding: 0 16px; }
    header { border-bottom: 1px solid #ccc; margin-bottom: 20px; padding-bottom: 10px; }
    h1 { margin: 0; font-size: 22px; }
    h2 { margin-top: 30px; border-left: 4px solid #444; padding-left: 8px; }
    .card { background: #f9f9f9; border: 1px solid #ddd; border-radius: 6px; padding: 12px; margin: 12px 0; }
    pre { background: #222; color: #eee; padding: 10px; border-radius: 6px; overflow-x: auto; }
    code { background: #eee; padding: 2px 4px; border-radius: 4px; }
    .hint { color: #666; font-size: 13px; }
  </style>
</head>
<body>
<header>
  <h1>Práctica 4 — Manejo de variables en PHP</h1>
  <div class="hint">Ruta: <code><?php echo $_SERVER['REQUEST_URI'] ?? ''; ?></code></div>
</header>

<!-- Aquí vamos a ir pegando cada ejercicio en orden -->

<h2>Ejercicio 1 — Variables válidas e inválidas</h2>
<div class="card">
  <?php
  // Variables a analizar:
  // $_myvar → válida (inicia con underscore, correcto).
  // $_7var → válida (underscore inicial, luego número permitido).
  // myvar → inválida (le falta el $).
  // $myvar → válida.
  // $var7 → válida.
  // $_element1 → válida.
  // $house*5 → inválida (no se permite * en el nombre).

  $validas = ['$_myvar','$_7var','$myvar','$var7','$_element1'];
  $invalidas = ['myvar','$house*5'];

  echo "Variables válidas: " . implode(', ', $validas) . "<br />";
  echo "Variables inválidas: " . implode(', ', $invalidas);
  ?>
</div>

<h2>Ejercicio 2 — Referencias &amp; contenido</h2>
<div class="card">
  <?php
  $a = "ManejadorSQL";
  $b = 'MySQL';
  $c = &$a;

  echo "<strong>Bloque 1</strong><br />";
  echo "a = $a<br />b = $b<br />c = $c<br />";
  echo "<hr />";

  $a = "PHP server";
  $b = &$a;

  echo "<strong>Bloque 2</strong><br />";
  echo "a = $a<br />b = $b<br />c = $c<br />";

  echo "<hr />";
  echo "<div class='hint'>Al usar <code>&amp;</code>, varias variables apuntan al mismo valor en memoria.<br />"
     . "Por eso, cuando cambiamos <code>\$a</code>, también cambian <code>\$b</code> y <code>\$c</code>.</div>";

  // Limpiamos variables para evitar conflictos después
  unset($a, $b, $c);
  ?>
</div>

<h2>Ejercicio 3 — Evolución de tipos/valores</h2>
<div class="card">
  <?php
  echo "<pre>";
  $a = "PHP5";
  var_dump($a);

  $z[] = &$a;          // $z[0] referencia a $a
  var_dump($z);

  $b = "5a version de PHP";
  var_dump($b);

  $c = $b * 10;        // PHP intenta convertir "5a..." en número (5)
  var_dump($c);

  $a .= $b;            // concatena: "PHP5" . "5a version de PHP"
  var_dump($a);

  $b *= $c;            // convierte a número y multiplica
  var_dump($b);

  $z[0] = "MySQL";     // cambia también $a porque $z[0] referencia a $a
  var_dump($z);
  var_dump($a);
  echo "</pre>";
  ?>
  <div class="hint">Nota: <code>$z[0]</code> es referencia a <code>$a</code>.  
  Al cambiar <code>$z[0] = "MySQL"</code>, también cambia <code>$a</code>.</div>
</div>


</body>
</html>
