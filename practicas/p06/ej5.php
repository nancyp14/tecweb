<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 5</title>
</head>
<body>
    <h1>Ejercicio 5</h1>
    <form method="POST">
        Edad: <input type="number" name="edad" required><br><br>
        Sexo: 
        <select name="sexo" required>
            <option value="femenino">Femenino</option>
            <option value="masculino">Masculino</option>
        </select><br><br>
        <input type="submit" value="Enviar">
    </form>

    <?php
    if ($_POST) {
        $edad = $_POST['edad'];
        $sexo = $_POST['sexo'];

        if ($sexo == "femenino" && $edad >= 18 && $edad <= 35) {
            echo "<p>Bienvenida, usted está en el rango de edad permitido.</p>";
        } else {
            echo "<p>Error: No cumple con las condiciones.</p>";
        }
    }
    ?>
</body>
</html>
