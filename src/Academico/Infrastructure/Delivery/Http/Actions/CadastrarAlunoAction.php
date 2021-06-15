<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Infrastructure\Delivery\Http\Actions;

use AgetalkDDD\Academico\Application\CadastrarAluno;
use AgetalkDDD\Academico\Application\CadastrarAlunoCommand;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\Action;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\ResponseFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CadastrarAlunoAction implements Action
{
    private CadastrarAluno $cadastrarAlunoService;
    private ResponseFactory $response;

    public function __construct(CadastrarAluno $cadastrarAlunoService, ResponseFactory $response)
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
        return $this->response->created($aluno);
    }
}
