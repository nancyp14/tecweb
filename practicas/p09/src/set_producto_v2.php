<?php
// Recuperar los datos enviados por el formulario
$nombre   = $_POST['nombre'];
$marca    = $_POST['marca'];
$modelo   = $_POST['modelo'];
$precio   = $_POST['precio'];
$detalles = $_POST['detalles'];
$unidades = $_POST['unidades'];
$imagen   = $_POST['imagen'];

// Crear el objeto de conexión
@$link = new mysqli('localhost', 'root', 'roqR.05acm1', 'marketzone');	

// Comprobar la conexión
if ($link->connect_errno) {
    die('Falló la conexión: '.$link->connect_error.'<br/>');
}

// Validación de datos
if (empty($nombre) || empty($marca) || empty($modelo) || empty($precio) || empty($unidades)) {
    die('<h3> Error: Faltan campos obligatorios (nombre, marca, modelo, precio o unidades).</h3>');
}

if (!is_numeric($precio) || !is_numeric($unidades) || $precio <= 0 || $unidades < 0) {
    die('<h3> Error: Los valores de precio y unidades deben ser numéricos y positivos.</h3>');
}

// Verificar si el producto ya existe (mismo nombre, marca y modelo)
$check_sql = "SELECT * FROM productos WHERE nombre = '$nombre' AND marca = '$marca' AND modelo = '$modelo'";
$result = $link->query($check_sql);

if ($result->num_rows > 0) {
    echo 'El producto ya existe (nombre, marca y modelo duplicados).';
} else {
    // Insertar nuevo producto
    $sql = "INSERT INTO productos (id, nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado)
            VALUES (null, '$nombre', '$marca', '$modelo', $precio, '$detalles', $unidades, '$imagen', 0)";
    
    if ($link->query($sql)) {
        echo '✅ Producto insertado con ID: '.$link->insert_id;
    } else {
        echo 'El producto no pudo ser insertado =(';
    }
}

// Cerrar conexión
$link->close();
?>
