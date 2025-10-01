<?php
$autos = [
    "HAK7859" => [
        "Auto" => ["marca"=>"HONDA","modelo"=>2020,"tipo"=>"camioneta"],
        "Propietario" => ["nombre"=>"Ana Perez","ciudad"=>"Puebla","direccion"=>"Calle 1"]
    ],
    "TB597S2" => [
        "Auto" => ["marca"=>"MAZDA","modelo"=>2019,"tipo"=>"sedan"],
        "Propietario" => ["nombre"=>"Luis Gomez","ciudad"=>"CDMX","direccion"=>"Calle 2"]
    ],
    "PYTMF0K" => [
        "Auto" => ["marca"=>"TOYOTA","modelo"=>2018,"tipo"=>"hachback"],
        "Propietario" => ["nombre"=>"Maria Lopez","ciudad"=>"Monterrey","direccion"=>"Calle 3"]
    ],
    "JHDLEI9" => [
        "Auto" => ["marca"=>"FORD","modelo"=>2021,"tipo"=>"sedan"],
        "Propietario" => ["nombre"=>"Carlos Ruiz","ciudad"=>"Guadalajara","direccion"=>"Calle 4"]
    ],
    "AXYMSL5" => [
        "Auto" => ["marca"=>"NISSAN","modelo"=>2017,"tipo"=>"camioneta"],
        "Propietario" => ["nombre"=>"Sofia Hernandez","ciudad"=>"Merida","direccion"=>"Calle 5"]
    ],
    "DFHJ3SY" => [
        "Auto" => ["marca"=>"CHEVROLET","modelo"=>2016,"tipo"=>"sedan"],
        "Propietario" => ["nombre"=>"Jorge Martinez","ciudad"=>"Puebla","direccion"=>"Calle 6"]
    ],
    "LMTPO03" => [
        "Auto" => ["marca"=>"KIA","modelo"=>2022,"tipo"=>"hachback"],
        "Propietario" => ["nombre"=>"Laura Jimenez","ciudad"=>"CDMX","direccion"=>"Calle 7"]
    ],
    "QQYSR2F" => [
        "Auto" => ["marca"=>"BMW","modelo"=>2015,"tipo"=>"sedan"],
        "Propietario" => ["nombre"=>"Pedro Alvarez","ciudad"=>"Toluca","direccion"=>"Calle 8"]
    ],
    "MPTLHV5" => [
        "Auto" => ["marca"=>"AUDI","modelo"=>2020,"tipo"=>"camioneta"],
        "Propietario" => ["nombre"=>"Andrea Torres","ciudad"=>"Queretaro","direccion"=>"Calle 9"]
    ],
    "HTORWL0" => [
        "Auto" => ["marca"=>"TESLA","modelo"=>2021,"tipo"=>"sedan"],
        "Propietario" => ["nombre"=>"Miguel Castro","ciudad"=>"CDMX","direccion"=>"Calle 10"]
    ],
    "REHOO1O" => [
        "Auto" => ["marca"=>"VOLKSWAGEN","modelo"=>2019,"tipo"=>"hachback"],
        "Propietario" => ["nombre"=>"Daniela Romero","ciudad"=>"Monterrey","direccion"=>"Calle 11"]
    ],
    "MXPUUE9" => [
        "Auto" => ["marca"=>"MERCEDES","modelo"=>2018,"tipo"=>"sedan"],
        "Propietario" => ["nombre"=>"Ricardo Ortega","ciudad"=>"Puebla","direccion"=>"Calle 12"]
    ],
    "RU7EKPL" => [
        "Auto" => ["marca"=>"HYUNDAI","modelo"=>2020,"tipo"=>"camioneta"],
        "Propietario" => ["nombre"=>"Fernanda Chavez","ciudad"=>"CDMX","direccion"=>"Calle 13"]
    ],
    "LSI8BRP" => [
        "Auto" => ["marca"=>"PEUGEOT","modelo"=>2017,"tipo"=>"sedan"],
        "Propietario" => ["nombre"=>"Oscar Morales","ciudad"=>"Guadalajara","direccion"=>"Calle 14"]
    ],
    "ZOPTH6G" => [
        "Auto" => ["marca"=>"FIAT","modelo"=>2016,"tipo"=>"hachback"],
        "Propietario" => ["nombre"=>"Paola Sanchez","ciudad"=>"Cancun","direccion"=>"Calle 15"]
    ],
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 6</title>
</head>
<body>
    <h1>Ejercicio 6</h1>
    <form method="POST">
        <label>Matrícula: </label>
        <input type="text" name="matricula">
        <input type="submit" name="buscar" value="Buscar">
        <input type="submit" name="todos" value="Mostrar todos">
    </form>
    <pre>
    <?php
    if (isset($_POST['buscar']) && !empty($_POST['matricula'])) {
        $mat = $_POST['matricula'];
        if (isset($autos[$mat])) {
            print_r($autos[$mat]);
        } else {
            echo "No encontrado.";
        }
    } elseif (isset($_POST['todos'])) {
        print_r($autos);
    }
    ?>
    </pre>
</body>
</html>
