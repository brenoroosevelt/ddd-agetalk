<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Domain\Model;

use AgetalkDDD\Shared\Domain\Support\DomainService;
use AgetalkDDD\Shared\Domain\Model\Email;

interface VerificacaoEmailUnico extends DomainService
{
    public function ehUnico(Email $email): bool;
}
