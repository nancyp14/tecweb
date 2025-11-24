<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use TECWEB\MYAPI\Delete\Delete;

$api = new Delete("marketzone");
echo $api->delete($_POST['id']);
