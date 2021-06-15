<?php
declare(strict_types=1);

use AgetalkDDD\Academico\Infrastructure\Delivery\Http\Routes\ApiRouterProvider;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\Application;
use AgetalkDDD\Academico\Infrastructure\Persistence\PersistenceServiceProvider;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\ErrorHandlerMiddleware;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\HttpServiceProvider;
use Habemus\Container;
use Laminas\Diactoros\ResponseFactory;
use Psr\Http\Message\ServerRequestInterface;

include '../vendor/autoload.php';

$container = new Container();
$container->addProvider(new PersistenceServiceProvider(), new HttpServiceProvider());

$app = new Application($container);
$app->routerProvider(new ApiRouterProvider());
$app->middleware(ErrorHandlerMiddleware::class);

$app->route()->get('/', function (ServerRequestInterface $request) {
    $response = (new ResponseFactory())->createResponse();
    $response->getBody()->write(file_get_contents('home.html'));
    return $response;
});

$app->run();
