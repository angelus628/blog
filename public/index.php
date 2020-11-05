<?php declare(strict_types=1);

define('DOCUMENT_ROOT', __DIR__ . DIRECTORY_SEPARATOR . '..');

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Platform\Routes\ApiRoutes;
use Symfony\Component\Dotenv\Dotenv;

session_start();

$dotenv = new Dotenv();
$dotenv->load(DOCUMENT_ROOT . '/.env');

$request = ServerRequestFactory::fromGlobals();
$router = ApiRoutes::loadRoutes();
$response = $router->dispatch($request);
(new SapiEmitter())->emit($response);