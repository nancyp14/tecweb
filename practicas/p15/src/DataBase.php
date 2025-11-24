<?php
namespace TECWEB\MYAPI;

abstract class DataBase {
    protected $conexion;

    public function __construct(
        $dbname,
        $host = "localhost",
        $user = "root",
        $password = "roqR.05acm1"
    ) {
        $this->conexion = new \mysqli($host, $user, $password, $dbname);

        if ($this->conexion->connect_error) {
            die("Connection failed: " . $this->conexion->connect_error);
        }

        $this->conexion->set_charset("utf8");
    }
}