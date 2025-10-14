<?php
// Conexión a la base de datos
$link = new mysqli("localhost", "root", "roqR.05acm1", "marketzone");

// Verificar conexión
if ($link->connect_errno) {
    die("Error de conexión: " . $link->connect_error);
}

// Recuperar los datos del formulario
$id       = $_POST['id'];
$nombre   = $_POST['nombre'];
$marca    = $_POST['marca'];
$modelo   = $_POST['modelo'];
$precio   = $_POST['precio'];
$detalles = $_POST['detalles'];
$unidades = $_POST['unidades'];
$imagen   = $_POST['imagen'];

// Validar datos mínimos
if (empty($id) || empty($nombre) || empty($marca) || empty($modelo)) {
    die("<h3>Faltan datos obligatorios.</h3>");
}

// Crear consulta de actualización
$sql = "UPDATE productos 
        SET nombre='$nombre', 
            marca='$marca', 
            modelo='$modelo', 
            precio=$precio, 
            detalles='$detalles', 
            unidades=$unidades, 
            imagen='$imagen'
        WHERE id=$id";

// Ejecutar y mostrar resultado
if ($link->query($sql)) {
    echo "<h3>Producto actualizado correctamente.</h3>";
} else {
    echo "<h3>Error al actualizar el producto: " . $link->error . "</h3>";
}

// agregar hipervínculos solicitados
echo '<p><a href="get_productos_xhtml_v2.php">Ver productos con límite</a></p>';
echo '<p><a href="get_productos_vigentes_v2.php">Ver productos vigentes</a></p>';

// Cerrar conexión
$link->close();
?>
