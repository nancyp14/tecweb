<?php
include_once __DIR__.'/database.php';

$producto = file_get_contents('php://input');
if (empty($producto)) {
    echo 'ERROR: No se recibieron datos';
    exit;
}

$jsonOBJ = json_decode($producto);
if (!$jsonOBJ) {
    echo 'ERROR: JSON inválido';
    exit;
}

// Campos obligatorios
$nombre = $jsonOBJ->nombre ?? '';
$marca = $jsonOBJ->marca ?? '';
$modelo = $jsonOBJ->modelo ?? '';
$precio = floatval($jsonOBJ->precio ?? 0);
$unidades = intval($jsonOBJ->unidades ?? 0);
$detalles = $jsonOBJ->detalles ?? '';
$imagen = $jsonOBJ->imagen ?? 'img/default.png';

if (!$nombre || !$marca || !$modelo || $precio <= 0 || $unidades < 0) {
    echo 'ERROR: Faltan datos obligatorios o son inválidos';
    exit;
}

// Validar duplicado
$stmtCheck = $conexion->prepare("
    SELECT id FROM productos 
    WHERE eliminado = 0 AND ((nombre=? AND marca=?) OR (marca=? AND modelo=?))
");
$stmtCheck->bind_param("ssss", $nombre, $marca, $marca, $modelo);
$stmtCheck->execute();
$stmtCheck->store_result();

if ($stmtCheck->num_rows > 0) {
    echo 'ERROR: Producto duplicado';
    exit;
}

// Insertar producto
$stmtInsert = $conexion->prepare("
    INSERT INTO productos(nombre, precio, unidades, modelo, marca, detalles, imagen, eliminado)
    VALUES (?, ?, ?, ?, ?, ?, ?, 0)
");
$stmtInsert->bind_param("sdissss", $nombre, $precio, $unidades, $modelo, $marca, $detalles, $imagen);

if ($stmtInsert->execute()) {
    echo 'ÉXITO: Producto insertado correctamente';
} else {
    echo 'ERROR: '.$conexion->error;
}

$conexion->close();
?>