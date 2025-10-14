<?php
// Conexión a la base de datos
$link = new mysqli("localhost", "root", "roqR.05acm1", "marketzone");

// Verificar conexión
if ($link->connect_errno) {
    die("Error de conexión: " . $link->connect_error);
}

// Obtener ID desde GET
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Si hay un ID válido, buscar el producto
if ($id > 0) {
    $sql = "SELECT * FROM productos WHERE id = $id";
    $result = $link->query($sql);

    if ($result->num_rows == 1) {
        $producto = $result->fetch_assoc();
    } else {
        die("<h3>Producto no encontrado.</h3>");
    }
} else {
    die("<h3>No se especificó un producto.</h3>");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Producto</title>
</head>
<body>
  <h2>Editar Producto</h2>

  <form action="update_producto.php" method="post">
    <input type="hidden" name="id" value="<?= $producto['id'] ?>">

    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required><br><br>

    <label>Marca:</label>
    <input type="text" name="marca" value="<?= htmlspecialchars($producto['marca']) ?>" required><br><br>

    <label>Modelo:</label>
    <input type="text" name="modelo" value="<?= htmlspecialchars($producto['modelo']) ?>" required><br><br>

    <label>Precio:</label>
    <input type="number" step="0.01" name="precio" value="<?= $producto['precio'] ?>" required><br><br>

    <label>Unidades:</label>
    <input type="number" name="unidades" value="<?= $producto['unidades'] ?>" required><br><br>

    <label>Detalles:</label><br>
    <textarea name="detalles" rows="4" cols="40"><?= htmlspecialchars($producto['detalles']) ?></textarea><br><br>

    <label>Imagen (URL o ruta relativa):</label>
    <input type="text" name="imagen" value="<?= htmlspecialchars($producto['imagen']) ?>"><br><br>

    <input type="submit" value="Actualizar Producto">
  </form>
</body>
</html>

<?php
$link->close();
?>