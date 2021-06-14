<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Infrastructure\Delivery\Http;

use AgetalkDDD\Academico\Application\CadastrarAluno;
use AgetalkDDD\Academico\Application\CadastrarAlunoCommand;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\Json;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CadastrarAlunoAction
{
    private CadastrarAluno $cadastrarAlunoService;

    public function __construct(CadastrarAluno $cadastrarAlunoService)
    {
        $this->cadastrarAlunoService = $cadastrarAlunoService;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface  $response,
        array $args = []
    ): ResponseInterface {
        $body = json_decode($request->getBody()->getContents(), true);
        $command = new CadastrarAlunoCommand(
            $body['nome'] ?? "",
            $body['email'] ?? ""
        );

        $aluno = $this->cadastrarAlunoService->execute($command);
        return (new Json($response))->ok($aluno);
    }
}
