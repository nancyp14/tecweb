<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use TECWEB\MYAPI\Read\Read;

$api = new Read("marketzone");
echo $api->single($_POST['id']);
