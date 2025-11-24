<?php
namespace TECWEB\MYAPI\Delete;

use TECWEB\MYAPI\DataBase;

class Delete extends DataBase {

    public function __construct($db) {
        parent::__construct($db);
    }

    public function delete($id) {
        $sql = "UPDATE productos SET eliminado = 1 WHERE id = $id";
        $this->conexion->query($sql);

        return json_encode(["status" => "Producto eliminado"], JSON_PRETTY_PRINT);
    }
}