<?php
declare(strict_types=1);

use AgetalkDDD\Academico\Infrastructure\Delivery\Http\Actions\CadastrarAlunoAction;
use AgetalkDDD\Academico\Infrastructure\Delivery\Http\Actions\DesativarAlunoAction;
use AgetalkDDD\Academico\Infrastructure\Delivery\Http\Actions\ListarTodosAlunosAction;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\Application;
use AgetalkDDD\Academico\Infrastructure\Persistence\PersistenceServiceProvider;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\HttpServiceProvider;
use Habemus\Container;
use Laminas\Diactoros\ResponseFactory;
use Psr\Http\Message\ServerRequestInterface;

include '../vendor/autoload.php';

// Constants
if (!defined('STORAGE_PATH')) {
    define('STORAGE_PATH', __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "storage" . DIRECTORY_SEPARATOR);
}

// Application
$container = new Container();
$container->addProvider(new PersistenceServiceProvider(), new HttpServiceProvider());
$app = $container->get(Application::class);

// Routes
$app->router()->map('GET', '/alunos', ListarTodosAlunosAction::class);
$app->router()->map('DELETE', '/alunos/{id}', DesativarAlunoAction::class);
$app->router()->map('POST', '/alunos', CadastrarAlunoAction::class);
$app->router()->map('GET', '/', function (ServerRequestInterface $request) {
    $response = (new ResponseFactory())->createResponse();
    $response->getBody()->write(file_get_contents('home.html'));
    return $response;
});

// Run!
$app->run();
