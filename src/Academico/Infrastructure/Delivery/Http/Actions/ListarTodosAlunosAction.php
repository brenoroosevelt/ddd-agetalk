<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Infrastructure\Delivery\Http\Actions;

use AgetalkDDD\Academico\Application\ListarTodosAlunos;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\Contracts\ActionInterface;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\Contracts\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ListarTodosAlunosAction implements ActionInterface
{
    private ListarTodosAlunos $listarTodosAlunos;
    private ResponseFactoryInterface $response;

    public function __construct(ListarTodosAlunos $listarTodosAlunos, ResponseFactoryInterface $response)
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
