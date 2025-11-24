<?php
namespace TECWEB\MYAPI\Read;

use TECWEB\MYAPI\DataBase;

class Read extends DataBase {

    public function __construct($db) {
        parent::__construct($db);
    }

    public function list() {
        $sql = "SELECT * FROM productos WHERE eliminado = 0 ORDER BY id";
        $result = $this->conexion->query($sql);

        $data = [];
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return json_encode($data, JSON_PRETTY_PRINT);
    }

    public function search($text) {
        $sql = "SELECT * FROM productos WHERE nombre LIKE '%$text%'";
        $result = $this->conexion->query($sql);

        $data = [];
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return json_encode($data, JSON_PRETTY_PRINT);
    }

    public function single($id) {
        $sql = "SELECT * FROM productos WHERE id = $id";
        $result = $this->conexion->query($sql);

        return json_encode($result->fetch_assoc(), JSON_PRETTY_PRINT);
    }
}