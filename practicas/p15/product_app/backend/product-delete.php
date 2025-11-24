<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use TECWEB\MYAPI\Delete\Delete;

$api = new Delete("product_app");
echo $api->delete($_POST['id']);
