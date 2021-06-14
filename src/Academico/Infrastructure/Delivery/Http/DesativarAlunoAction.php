<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Infrastructure\Delivery\Http;

use AgetalkDDD\Academico\Application\DesativarAluno;
use AgetalkDDD\Academico\Application\DesativarAlunoCommand;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\Json;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DesativarAlunoAction
{
    private DesativarAluno $desativarAluno;

    public function __construct(DesativarAluno $desativarAluno)
    {
        $this->desativarAluno = $desativarAluno;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface  $response,
        array $args = []
    ): ResponseInterface {
        $command = new DesativarAlunoCommand($args['id']);
        $aluno = $this->desativarAluno->execute($command);
        return (new Json($response))->ok($aluno);
    }
}
