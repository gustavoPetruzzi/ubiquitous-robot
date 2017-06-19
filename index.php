<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'clases/vendor/autoload.php';
require_once 'clases/usuarioApi.php';
require_once 'clases/bicicletaApi.php';
$app = new \Slim\App;

$app->get('/', function (Request $request, Response $response) {
    return $response->withRedirect("./index.html");

});


$app->group('/usuarios', function () {
    $this->post('/verificar',\usuarioApi::class . ":verificarUsuario");
    
});
$app->group('/bicicletas', function (){
    $this->post('/nueva', \bicicletaApi::class . ":nuevaBicicleta");
	$this->get('/traer', \bicicletaApi::class . ":listadoBicicletas");
	$this->get('/traer/{id}', \bicicletaApi::class . ":traerBicicleta");
	$this->get('/filtrado/{filtro}/{valor}', \bicicletaApi::class . ":listadoBicicletas");
	$this->delete('/borrar', \bicicletaApi::class . ":borrar");
});
$app->run();
