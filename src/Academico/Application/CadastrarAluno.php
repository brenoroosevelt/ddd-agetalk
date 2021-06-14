<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Application;

use AgetalkDDD\Academico\Domain\Model\AlunoDTO;
use AgetalkDDD\Academico\Domain\Model\AlunoFactory;
use AgetalkDDD\Academico\Domain\Model\AlunoRepository;

final class CadastrarAluno
{
    private AlunoFactory $factory;
    private AlunoRepository $repository;

    public function __construct(AlunoFactory $alunoFactory, AlunoRepository $alunoRepository)
    {
        $this->factory = $alunoFactory;
        $this->repository = $alunoRepository;
    }

    public function execute(CadastrarAlunoCommand $command): AlunoDTO
    {
        $aluno = $this->factory->novo($command->nome(), $command->email());
        $this->repository->save($aluno);
        return $aluno->toDTO();
    }
}
