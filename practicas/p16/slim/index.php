<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require 'vendor/autoload.php';

$app = AppFactory::create();

/* IMPORTANTE */
$app->setBasePath("/tecweb/practicas/p16/slim");

/* --- MÉTODO GET / --- */
$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hola mundo Slim v4");
    return $response;
});

/* --- MÉTODO GET /hola/{nombre} --- */
$app->get('/hola/{nombre}', function (Request $request, Response $response, $args) {
    $nombre = $args['nombre'];
    $response->getBody()->write("Hola " . $nombre);
    return $response;
});

/* --- MÉTODO POST /pruebapost --- */
$app->post('/pruebapost', function (Request $request, Response $response, $args) {
    $reqPost = $request->getParsedBody();
    
    $val1 = $reqPost['valor1'] ?? '';
    $val2 = $reqPost['valor2'] ?? '';

    $response->getBody()->write("Valores: $val1 $val2");
    return $response;
});

/* --- MÉTODO GET /testjson --- */
$app->get('/testjson', function (Request $request, Response $response, $args) {

    $datos = [
        "nombre" => "Nancy",
        "edad" => 20,
        "materia" => "Tecnologias Web"
    ];

    $json = json_encode($datos);
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
