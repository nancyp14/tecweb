<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use TECWEB\MYAPI\Update\Update;

$api = new Update("marketzone");
echo $api->edit($_POST);
