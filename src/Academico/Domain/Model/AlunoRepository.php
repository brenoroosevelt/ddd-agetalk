<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Domain\Model;

interface AlunoRepository
{
    /** @return Aluno[] */
    public function todos(): array;
    public function porId(string $id): Aluno;
    public function salvar(Aluno $aluno): void;
    public function total(): int;
}
