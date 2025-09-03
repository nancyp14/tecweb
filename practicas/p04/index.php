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


</body>
</html>
