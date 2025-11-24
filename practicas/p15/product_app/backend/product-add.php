<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use TECWEB\MYAPI\Create\Create;

$api = new Create("product_app");
echo $api->add($_POST);
