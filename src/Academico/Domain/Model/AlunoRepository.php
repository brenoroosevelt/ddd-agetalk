<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Domain\Model;

interface AlunoRepository
{
    /**
     * @return Aluno[]
     */
    public function all(): array;
    public function byId(string $id): Aluno;
    public function save(Aluno $aluno): void;
    public function count(): int;
}
