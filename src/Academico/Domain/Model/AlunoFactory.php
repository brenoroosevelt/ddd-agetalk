<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Domain\Model;

use AgetalkDDD\Shared\Domain\Model\Email;
use DomainException;

final class AlunoFactory
{
    private VerificacaoEmailUnico $emailUnicoService;

    public function __construct(VerificacaoEmailUnico $emailUnicoService)
    {
        $this->emailUnicoService = $emailUnicoService;
    }

    public function novo(string $nome, string $email): Aluno
    {
        $email = new Email($email);
        if (!$this->emailUnicoService->ehUnico($email)) {
            throw new DomainException("Este e-mail já está sendo usado: $email");
        }

        return new Aluno(AlunoId::new(), RGA::aleatorio(), $nome, $email);
    }
}
