<?php
use TECWEB\MYAPI\Products;
require_once __DIR__ . "/myapi/Products.php";

$search = $_GET['search'] ?? "";

$prodObj = new Products("marketzone");
$prodObj->singleByName($search);

echo $prodObj->getData();