<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Infrastructure\Delivery\Http\Actions;

use AgetalkDDD\Academico\Application\CadastrarAluno;
use AgetalkDDD\Academico\Application\CadastrarAlunoCommand;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\ActionInterface;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CadastrarAlunoAction implements ActionInterface
{
    private CadastrarAluno $cadastrarAlunoService;
    private JsonResponse $response;

    public function __construct(CadastrarAluno $cadastrarAlunoService, JsonResponse $response)
    {
        $this->cadastrarAlunoService = $cadastrarAlunoService;
        $this->response = $response;
    }

    public function __invoke(ServerRequestInterface $request, array $args = []): ResponseInterface
    {
        $body = json_decode($request->getBody()->getContents(), true);
        $command = new CadastrarAlunoCommand(
            $body['nome'] ?? "",
            $body['email'] ?? ""
        );

        $aluno = $this->cadastrarAlunoService->execute($command);
        return $this->response->ok($aluno);
    }
}
