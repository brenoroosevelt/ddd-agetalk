<?php
declare(strict_types=1);

use AgetalkDDD\Academico\Infrastructure\Delivery\Http\Actions\CadastrarAlunoAction;
use AgetalkDDD\Academico\Infrastructure\Delivery\Http\Actions\DesativarAlunoAction;
use AgetalkDDD\Academico\Infrastructure\Delivery\Http\Actions\ListarTodosAlunosAction;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\Http;
use AgetalkDDD\Academico\Infrastructure\Persistence\PersistenceServiceProvider;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\ErrorHandlerMiddleware;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\HttpServiceProvider;
use Habemus\Container;
use Laminas\Diactoros\ResponseFactory;
use Psr\Http\Message\ServerRequestInterface;

include '../vendor/autoload.php';

// Application
$container = new Container();
$container->addProvider(new PersistenceServiceProvider(), new HttpServiceProvider());
$http = $container->get(Http::class);

// Routes
$http->router()->map('GET', '/alunos', ListarTodosAlunosAction::class);
$http->router()->map('DELETE', '/alunos/{id}', DesativarAlunoAction::class);
$http->router()->map('POST', '/alunos', CadastrarAlunoAction::class);
$http->router()->map('GET', '/', function (ServerRequestInterface $request) {
    $response = (new ResponseFactory())->createResponse();
    $response->getBody()->write(file_get_contents('home.html'));
    return $response;
});

// Error Handler
$http->router()->middleware($container->get(ErrorHandlerMiddleware::class));

// Run!
$http->dispatch();
