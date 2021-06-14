<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Application;

use AgetalkDDD\Academico\Domain\Model\Aluno;
use AgetalkDDD\Academico\Domain\Model\AlunoDTO;
use AgetalkDDD\Academico\Domain\Model\AlunoRepository;

final class ListarTodosAlunos
{
    private AlunoRepository $repository;

    public function __construct(AlunoRepository $alunoRepository)
    {
        $this->repository = $alunoRepository;
    }

    /**
     * @return AlunoDTO[]
     */
    public function execute(): array
    {
        return array_map(
            function (Aluno $aluno) {
                return $aluno->toDTO();
            },
            $this->repository->all()
        );
    }
}
