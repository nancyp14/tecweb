<?php
use TECWEB\MYAPI\Products;
require_once __DIR__ . "/myapi/Products.php";

$id = $_POST['id'] ?? 0;

$prodObj = new Products("marketzone");
$prodObj->single($id);

echo $prodObj->getData();