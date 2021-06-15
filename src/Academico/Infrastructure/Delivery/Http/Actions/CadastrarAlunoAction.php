<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Infrastructure\Delivery\Http\Actions;

use AgetalkDDD\Academico\Application\CadastrarAluno;
use AgetalkDDD\Academico\Application\CadastrarAlunoCommand;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\Contracts\ActionInterface;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\Contracts\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CadastrarAlunoAction implements ActionInterface
{
    private CadastrarAluno $cadastrarAlunoService;
    private ResponseFactoryInterface $response;

    public function __construct(CadastrarAluno $cadastrarAlunoService, ResponseFactoryInterface $response)
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
