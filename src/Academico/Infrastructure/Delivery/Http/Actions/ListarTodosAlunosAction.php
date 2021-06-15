<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Infrastructure\Delivery\Http\Actions;

use AgetalkDDD\Academico\Application\ListarTodosAlunos;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\Action;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\ResponseFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ListarTodosAlunosAction implements Action
{
    private ListarTodosAlunos $listarTodosAlunos;
    private ResponseFactory $response;

    public function __construct(ListarTodosAlunos $listarTodosAlunos, ResponseFactory $response)
    {
        $this->listarTodosAlunos = $listarTodosAlunos;
        $this->response = $response;
    }

    public function __invoke(ServerRequestInterface $request, array $args = []): ResponseInterface
    {
        $todosAlunos = $this->listarTodosAlunos->execute();
        return $this->response->ok($todosAlunos);
    }
}
