<?php
    include_once __DIR__.'/database.php';
    $data = array();
    
    if (isset($_POST['id'])) {
        $id = $conexion->real_escape_string($_POST['id']);
        // Nueva consulta con coincidencias parciales
        $query = "
        SELECT * FROM productos
        WHERE eliminado = 0 AND (
            nombre LIKE '%{$id}%'
            OR marca LIKE '%{$id}%'
            OR detalles LIKE '%{$id}%'
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

    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>