<?php
namespace TECWEB\MYAPI\Update;

use TECWEB\MYAPI\DataBase;

class Update extends DataBase {

    public function __construct($db) {
        parent::__construct($db);
    }

    public function edit($post) {
        $sql = "UPDATE productos SET
                nombre='{$post['nombre']}',
                precio='{$post['precio']}',
                unidades='{$post['unidades']}',
                modelo='{$post['modelo']}',
                marca='{$post['marca']}',
                detalles='{$post['detalles']}',
                imagen='{$post['imagen']}'
                WHERE id={$post['id']}";

        $this->conexion->query($sql);
        return json_encode(["status" => "Producto actualizado"], JSON_PRETTY_PRINT);
    }
}