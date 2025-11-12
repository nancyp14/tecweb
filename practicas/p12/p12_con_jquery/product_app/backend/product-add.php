<?php
include_once __DIR__.'/database.php';

// Configurar encabezado JSON limpio
header('Content-Type: application/json; charset=utf-8');

$data = [
    'status'  => 'error',
    'message' => 'No se recibieron datos válidos.'
];

// Validar que haya un nombre
if (isset($_POST['nombre']) && trim($_POST['nombre']) !== '') {

    // Convertir $_POST a objeto JSON
    $jsonOBJ = json_decode(json_encode($_POST));

    // Validaciones básicas
    if (!isset($jsonOBJ->precio) || $jsonOBJ->precio <= 0) {
        echo json_encode([
            'status' => 'error',
            'message' => 'El precio debe ser mayor que 0.'
        ]);
        exit;
    }

    if (!isset($jsonOBJ->unidades) || $jsonOBJ->unidades < 1) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Debe haber al menos una unidad.'
        ]);
        exit;
    }

    // Verificar existencia del producto
    $conexion->set_charset("utf8");
    $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
    $result = $conexion->query($sql);

    if ($result && $result->num_rows > 0) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Ya existe un producto con ese nombre.'
        ]);
        $result->free();
        $conexion->close();
        exit;
    }

    // Intentar insertar producto
    $sql = "INSERT INTO productos 
        (id, nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado)
        VALUES (
            null,
            '{$jsonOBJ->nombre}',
            '{$jsonOBJ->marca}',
            '{$jsonOBJ->modelo}',
            {$jsonOBJ->precio},
            '{$jsonOBJ->detalles}',
            {$jsonOBJ->unidades},
            '{$jsonOBJ->imagen}',
            0
        )";

    if ($conexion->query($sql)) {
        $data['status'] = "success";
        $data['message'] = "Producto agregado correctamente.";
    } else {
        $data['message'] = "Error al insertar: " . $conexion->error;
    }

    if ($result) $result->free();
    $conexion->close();
}

// Salida final JSON limpia
echo json_encode($data, JSON_PRETTY_PRINT);
