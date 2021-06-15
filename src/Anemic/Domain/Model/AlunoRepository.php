<?php
declare(strict_types=1);

namespace AgetalkDDD\Anemic\Domain\Model;

interface AlunoRepository
{
    /** @return AnemicAluno[] */
    public function all(): array;
    public function byId(string $id): AnemicAluno;
    public function save(AnemicAluno $aluno): void;
}
