<?php
header("Content-Type: application/xhtml+xml; charset=UTF-8");

$host = "localhost";
$user = "root";
$pass = "roqR.05acm1";
$db   = "marketzone";

$link = new mysqli($host, $user, $pass, $db);
if ($link->connect_errno) {
    die("Fallo la conexión: " . $link->connect_error);
}

// Solo productos NO eliminados
$sql = "SELECT * FROM productos WHERE eliminado = 0";
$result = $link->query($sql);

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<!DOCTYPE html 
    PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <title>Productos vigentes</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
    <h3>Productos vigentes (no eliminados)</h3>

    <?php if ($result && $result->num_rows > 0): ?>
        <table border="1" cellpadding="5">
            <thead>
                <tr>
                    <th>ID</th>
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
                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                    <td><?= htmlspecialchars($row['marca']) ?></td>
                    <td><?= htmlspecialchars($row['modelo']) ?></td>
                    <td><?= $row['precio'] ?></td>
                    <td><?= $row['unidades'] ?></td>
                    <td><?= htmlspecialchars($row['detalles']) ?></td>
                    <td><img src="<?= htmlspecialchars($row['imagen']) ?>" width="80" alt="imagen" /></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay productos vigentes.</p>
    <?php endif; ?>
</body>
</html>
<?php
$link->close();
?>