<?php
include_once __DIR__.'/database.php';

// Arreglo de respuesta
$data = array();

// Verificar si se recibió el parámetro 'id' (puede ser texto o número)
if (isset($_POST['id'])) {
    $id = $conexion->real_escape_string($_POST['id']);

    // Consulta modificada: búsqueda por coincidencias parciales (nombre, marca o detalles)
    $query = "
        SELECT * FROM productos
        WHERE eliminado = 0 AND (
            nombre LIKE '%{$id}%'
            OR marca LIKE '%{$id}%'
            OR detalles LIKE '%{$id}%'
            OR id = '{$id}'
        )
    ";

    if ($result = $conexion->query($query)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $data[] = $row;
        }
        $result->free();
    } else {
        die('Query Error: '.mysqli_error($conexion));
    }

    $conexion->close();
}

// Convertir a JSON y devolverlo
echo json_encode($data, JSON_PRETTY_PRINT);
?>
