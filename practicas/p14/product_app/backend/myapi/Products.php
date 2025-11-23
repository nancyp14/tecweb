<?php
namespace TECWEB\MYAPI;

require_once __DIR__ . "/DataBase.php";

class Products extends DataBase {

    private $response;

    public function __construct($dbname, $host="localhost", $user="root", $password="roqR.05acm1") {
        parent::__construct($dbname, $host, $user, $password);
        $this->response = [];
    }

    // LISTAR
    public function list() {
        $sql = "SELECT * FROM productos WHERE eliminado = 0 ORDER BY id";
        $result = $this->conexion->query($sql);

        $this->response = [];
        while($row = $result->fetch_assoc()) {
            $this->response[] = $row;
        }
    }

    // BUSCAR POR NOMBRE
    public function singleByName($name) {
        $sql = "SELECT * FROM productos WHERE nombre LIKE '%$name%'";
        $result = $this->conexion->query($sql);

        $this->response = [];
        while($row = $result->fetch_assoc()) {
            $this->response[] = $row;
        }
    }

    // BUSCAR POR ID
    public function single($id) {
        $sql = "SELECT * FROM productos WHERE id = $id";
        $result = $this->conexion->query($sql);

        $this->response = $result->fetch_assoc();
    }

    // AGREGAR
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
        $this->response = ["status" => "Producto agregado"];
    }

    // EDITAR
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
        $this->response = ["status" => "Producto actualizado"];
    }

    // ELIMINAR
    public function delete($id) {
        $sql = "UPDATE productos SET eliminado = 1 WHERE id = $id";
        $this->conexion->query($sql);
        $this->response = ["status" => "Producto eliminado"];
    }

    // DEVOLVER JSON
    public function getData() {
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }
}
