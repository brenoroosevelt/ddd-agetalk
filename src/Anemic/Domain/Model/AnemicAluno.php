<?php
declare(strict_types=1);

namespace AgetalkDDD\Anemic\Domain\Model;

use AgetalkDDD\Academico\Domain\Model\Matricula;
use AgetalkDDD\Shared\Domain\Model\Email;
use DateTimeImmutable;

class AnemicAluno
{
    private Matricula $matricula;
    private Email $email;
    private DateTimeImmutable $dtCadastro;
    private string $nome;
    private bool $ativo;

    public function __construct(Matricula $rga, Email $email, DateTimeImmutable $dtCadastro, string $nome, bool $ativo)
    {
        $this->matricula = $rga;
        $this->email = $email;
        $this->dtCadastro = $dtCadastro;
        $this->nome = $nome;
        $this->ativo = $ativo;
    }

    public function matricula(): Matricula
    {
        return $this->matricula;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function dataCadastro(): DateTimeImmutable
    {
        return $this->dtCadastro;
    }

    public function nome(): string
    {
        return $this->nome;
    }

    public function ativo(): bool
    {
        return $this->ativo;
    }

    public function setMatricula(Matricula $matricula): void
    {
        $this->matricula = $matricula;
    }

    public function setEmail(Email $email): void
    {
        $this->email = $email;
    }

    public function setDataCadastro(DateTimeImmutable $dtCadastro): void
    {
        $this->dtCadastro = $dtCadastro;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function setAtivo(bool $ativo): void
    {
        $this->ativo = $ativo;
    }
}
