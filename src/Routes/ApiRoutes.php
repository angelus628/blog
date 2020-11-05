<?php

declare(strict_types=1);


namespace Platform\Routes;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Laminas\Diactoros\ResponseFactory;
use League\Container\Container;
use League\Container\ReflectionContainer;
use League\Route\RouteGroup;
use League\Route\Router;
use League\Route\Strategy\JsonStrategy;

/**
 * Class ApiRoutes
 * @package Platform\Routes
 */
class ApiRoutes
{
    public static function loadRoutes(): Router
    {
        $modelPath = [
            DOCUMENT_ROOT . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Models',
        ];

        $connection = [
            'driver' => $_ENV['DB_DRIVER'],
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD'],
            'dbname' => $_ENV['DB_NAME'],
            'host' => $_ENV['DB_HOST']
        ];

        $router = new Router();
        $container = new Container();
        $container->delegate(new ReflectionContainer())
            ->add(EntityManager::class, function() use ($connection, $modelPath): EntityManager {
            $setup = Setup::createAnnotationMetadataConfiguration($modelPath, true, null, null, false);
            return EntityManager::create($connection, $setup);
        }, true);

        $responseFactory = new ResponseFactory();
        $jsonStrategy = new JsonStrategy($responseFactory);
        $jsonStrategy->setContainer($container);

        $router->group('/api', function(RouteGroup $route){
            $route->put('/author/{id:number}/update', 'Platform\Controllers\API\AuthorController::update');
            $route->get('/author/{id:number}', 'Platform\Controllers\API\AuthorController::author');
            $route->get('/authors', 'Platform\Controllers\API\AuthorController::authors');
            $route->post('/author/new', 'Platform\Controllers\API\AuthorController::new');

            $route->get('/articles', 'Platform\Controllers\API\ArticleController::articles');
            $route->post('/article/new', 'Platform\Controllers\API\ArticleController::new');
            $route->get('/article/{id:number}', 'Platform\Controllers\API\ArticleController::article');
        })->setStrategy($jsonStrategy);

        return $router;
    }
}