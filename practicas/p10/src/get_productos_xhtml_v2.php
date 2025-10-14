<?php
header("Content-Type: application/xhtml+xml; charset=UTF-8");

// Conexión a la base de datos
$host = "localhost";
$user = "root";   // cambia si tu usuario no es root
$pass = "roqR.05acm1";       // pon aquí tu contraseña de MySQL
$db   = "marketzone";

$link = new mysqli($host, $user, $pass, $db);
if ($link->connect_errno) {
    die("Fallo la conexión: " . $link->connect_error);
}

$tope = isset($_GET['tope']) ? intval($_GET['tope']) : 0;
$sql = "SELECT * FROM productos WHERE unidades <= $tope";
$result = $link->query($sql);

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<!DOCTYPE html 
    PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <title>Productos con límite</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
</head>
<body>
    <h3>PRODUCTO</h3>

    <?php if ($result && $result->num_rows > 0): ?>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Precio</th>
                    <th>Unidades</th>
                    <th>Detalles</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['nombre'] ?></td>
                    <td><?= $row['marca'] ?></td>
                    <td><?= $row['modelo'] ?></td>
                    <td><?= $row['precio'] ?></td>
                    <td><?= $row['unidades'] ?></td>
                    <td><?= $row['detalles'] ?></td>
                    <td><img src="<?= $row['imagen'] ?>" alt="<?= $row['nombre'] ?>" width="80"/></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay productos con ese límite de unidades.</p>
    <?php endif; ?>

</body>
</html>
<?php
$link->close();
?>
