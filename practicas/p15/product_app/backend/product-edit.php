<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use TECWEB\MYAPI\Update\Update;

$api = new Update("product_app");
echo $api->edit($_POST);
