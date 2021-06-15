<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Infrastructure\Delivery\Http\Actions;

use AgetalkDDD\Academico\Application\DesativarAluno;
use AgetalkDDD\Academico\Application\DesativarAlunoCommand;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\ActionInterface;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DesativarAlunoAction implements ActionInterface
{
    private DesativarAluno $desativarAluno;
    private JsonResponse $response;

    public function __construct(DesativarAluno $desativarAluno, JsonResponse $response)
    {
        $this->desativarAluno = $desativarAluno;
        $this->response = $response;
    }

    public function __invoke(ServerRequestInterface $request, array $args = []): ResponseInterface
    {
        $command = new DesativarAlunoCommand($args['id']);
        $aluno = $this->desativarAluno->execute($command);
        return $this->response->ok($aluno);
    }
}
