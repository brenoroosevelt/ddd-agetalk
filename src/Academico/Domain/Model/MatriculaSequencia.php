<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Domain\Model;

use AgetalkDDD\Shared\Domain\Support\DomainService;

interface MatriculaSequencia extends DomainService
{
    public function proximoNumero(int $ano): int;
}
