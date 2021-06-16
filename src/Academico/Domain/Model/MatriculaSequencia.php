<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Domain\Model;

interface MatriculaSequencia
{
    public function proximoNumero(int $ano): int;
}
