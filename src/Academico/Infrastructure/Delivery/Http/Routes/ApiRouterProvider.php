<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Infrastructure\Delivery\Http\Routes;

use AgetalkDDD\Academico\Infrastructure\Delivery\Http\Actions\CadastrarAlunoAction;
use AgetalkDDD\Academico\Infrastructure\Delivery\Http\Actions\DesativarAlunoAction;
use AgetalkDDD\Academico\Infrastructure\Delivery\Http\Actions\ListarTodosAlunosAction;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\RouterProviderInterface;
use League\Route\Router;

final class ApiRouterProvider implements RouterProviderInterface
{
    public function register(Router $router): void
    {
        $router->map('GET', '/alunos', ListarTodosAlunosAction::class);
        $router->map('DELETE', '/alunos/{id}', DesativarAlunoAction::class);
        $router->map('POST', '/alunos', CadastrarAlunoAction::class);
    }
}
