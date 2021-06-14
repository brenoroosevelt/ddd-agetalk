<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Infrastructure\Delivery\Http;

use AgetalkDDD\Academico\Application\ListarTodosAlunos;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\Json;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ListarTodosAlunosAction
{
    private ListarTodosAlunos $listarTodosAlunos;

    public function __construct(ListarTodosAlunos $listarTodosAlunos)
    {
        $this->listarTodosAlunos = $listarTodosAlunos;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface  $response,
        array $args = []
    ): ResponseInterface {
        $todosAlunos = $this->listarTodosAlunos->execute();
        return (new Json($response))->ok($todosAlunos);
    }
}
