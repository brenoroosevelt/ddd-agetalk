<?php
declare(strict_types=1);

namespace AgetalkDDD\Test\Stubs;

class MatriculaSequencia implements \AgetalkDDD\Academico\Domain\Model\MatriculaSequencia
{
    private array $sequencias;

    public function proximoNumero(int $ano): int
    {
        $sequencia = $this->sequencias[$ano] ?? 0;
        $this->sequencias[$ano] = ++$sequencia;
        return $this->sequencias[$ano];
    }
}
