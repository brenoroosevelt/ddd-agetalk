<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Application;

use AgetalkDDD\Academico\Domain\Model\AlunoDto;
use AgetalkDDD\Academico\Domain\Model\AlunoFactory;
use AgetalkDDD\Academico\Domain\Model\AlunoRepository;
use AgetalkDDD\Shared\Application\ApplicationService;

final class CadastrarAluno implements ApplicationService
{
    private AlunoFactory $factory;
    private AlunoRepository $repository;

    public function __construct(AlunoFactory $alunoFactory, AlunoRepository $alunoRepository)
    {
        $this->factory = $alunoFactory;
        $this->repository = $alunoRepository;
    }

    public function execute(CadastrarAlunoCommand $command): AlunoDto
    {
        $aluno = $this->factory->novo($command->nome(), $command->email());
        $this->repository->save($aluno);
        return $aluno->toDTO();
    }
}
