<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'clases/vendor/autoload.php';
require_once 'clases/usuarioApi.php';
require_once 'clases/bicicletaApi.php';
require_once 'clases/verificadora.php';
require_once 'clases/operacionesApi.php';
require_once 'clases/archivos.php';
$app = new \Slim\App;

$app->get('/', function (Request $request, Response $response) {
    return $response->withRedirect("./index.html");

});


$app->group('/usuarios', function () {
    $this->post('/verificar',\usuarioApi::class . ":verificar");
    
})->add(\verificadora::class . ":datosUsuario");
$app->group('/bicicletas', function (){
    $this->post('/nueva', \bicicletaApi::class . ":nuevaBicicleta");
    $this->get('/traer', \bicicletaApi::class . ":listadoBicicletas");
    $this->get('/traer/{filtro}/{valor}', \bicicletaApi::class . ":listadoBicicletas");
    $this->delete('/borrar', \bicicletaApi::class . ":borrarBicicleta");
    
})->add(\verificadora::class . ":datosBicicletas");

$app->group('/operaciones', function(){
    $this->post('/alta', \operacionesApi::class . ":CargarUno");
    $this->map(['PUT', 'POST'],'/modificar[/{id}/{nombre}/{fecha}/{precio}]',\operacionesApi::class . ":ModificarUno");
})->add(\archivos::class . ":subirArchivo")->add(\verificadora::class . ":datosAlta");
$app->run();