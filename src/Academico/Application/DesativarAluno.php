<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Application;

use AgetalkDDD\Academico\Domain\Model\AlunoDTO;
use AgetalkDDD\Academico\Domain\Model\AlunoRepository;
use AgetalkDDD\Shared\Application\ApplicationService;

final class DesativarAluno implements ApplicationService
{
    private AlunoRepository $repository;

    public function __construct(AlunoRepository $alunoRepository)
    {
        $this->repository = $alunoRepository;
    }

    public function execute(DesativarAlunoCommand $command): AlunoDTO
    {
        $aluno = $this->repository->byId($command->id());
        $aluno->desativar();
        $this->repository->save($aluno);
        return $aluno->toDTO();
    }
}
