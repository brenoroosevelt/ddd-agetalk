<?php
declare(strict_types=1);

use AgetalkDDD\Academico\Infrastructure\Delivery\Http\CadastrarAlunoAction;
use AgetalkDDD\Academico\Infrastructure\Delivery\Http\DesativarAlunoAction;
use AgetalkDDD\Academico\Infrastructure\Delivery\Http\ListarTodosAlunosAction;
use AgetalkDDD\Academico\Infrastructure\Provider;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\Json;
use Habemus\Container;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\ResponseFactory;

include "../vendor/autoload.php";

// Container
$container = new Container();
$container->addProvider(new Provider());

// Slim App
$slim  = AppFactory::createFromContainer($container);
$slim->addRoutingMiddleware();

// Routes
$slim->get('/', function (ServerRequestInterface $request, ResponseInterface $response) {
    $response->getBody()->write(file_get_contents('home.html'));
    return $response;
});

$slim->get('/alunos', ListarTodosAlunosAction::class);
$slim->delete('/alunos/{id}', DesativarAlunoAction::class);
$slim->post('/alunos', CadastrarAlunoAction::class);

// Error handler
$errorMiddleware = $slim->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler(
    function (
        ServerRequestInterface $request,
        Throwable $exception,
        bool $displayErrorDetails,
        bool $logErrors,
        bool $logErrorDetails
    ) {
        $response = (new ResponseFactory())->createResponse();
        return (new Json($response))->error(['message' => $exception->getMessage()]);
    }
);

// Run!
$slim->run();
