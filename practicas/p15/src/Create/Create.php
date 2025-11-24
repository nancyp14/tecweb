<?php
namespace TECWEB\MYAPI\Create;

use TECWEB\MYAPI\DataBase;

class Create extends DataBase {

    public function __construct($db) {
        parent::__construct($db);
    }

    public function add($post) {
        $sql = "INSERT INTO productos(nombre,precio,unidades,modelo,marca,detalles,imagen)
                VALUES (
                    '{$post['nombre']}',
                    '{$post['precio']}',
                    '{$post['unidades']}',
                    '{$post['modelo']}',
                    '{$post['marca']}',
                    '{$post['detalles']}',
                    '{$post['imagen']}'
                )";

        $this->conexion->query($sql);
        return json_encode(["status" => "Producto agregado"], JSON_PRETTY_PRINT);
    }
}