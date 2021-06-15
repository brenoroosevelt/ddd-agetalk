<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Infrastructure\Delivery\Http\Actions;

use AgetalkDDD\Academico\Application\DesativarAluno;
use AgetalkDDD\Academico\Application\DesativarAlunoCommand;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\Action;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\ResponseFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DesativarAlunoAction implements Action
{
    private DesativarAluno $desativarAluno;
    private ResponseFactory $response;

    public function __construct(DesativarAluno $desativarAluno, ResponseFactory $response)
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
