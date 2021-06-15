<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Domain\Model;

use AgetalkDDD\Shared\Domain\Support\AggregateRoot;
use AgetalkDDD\Shared\Domain\Model\Email;
use DateTimeImmutable;
use DomainException;

final class Aluno extends AggregateRoot
{
    private Rga $matricula;
    private Email $email;
    private DateTimeImmutable $dataCadastro;
    private string $nome;
    private bool $ativo;

    public function __construct(AlunoId $id, Rga $matricula, string $nome, Email $email)
    {
        $this->id = $id;
        $this->matricula = $matricula;
        $this->email = $email;
        $this->setNome($nome);
        $this->ativo = true;
        $this->dataCadastro = new DateTimeImmutable();

        $this->raiseEvent(new AlunoRegistrado((string) $id, $nome, (string) $email));
    }

    public function alterarDadosPessoais(string $novoNome, string $novoEmail): void
    {
        if (!$this->ativo) {
            throw new DomainException("Aluno inativo não pode ser alterado.");
        }

        $this->setNome($novoNome);
        $this->email = new Email($novoEmail);
    }

    public function desativar(): void
    {
        $this->ativo = false;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function nome(): string
    {
        return $this->nome;
    }

    public function ativo(): bool
    {
        return $this->ativo;
    }

    public function matricula(): Rga
    {
        return $this->matricula;
    }

    public function dataCadastro(): DateTimeImmutable
    {
        return $this->dataCadastro;
    }

    private function setNome(string $nome)
    {
        if (empty($nome)) {
            throw new DomainException("Nome do aluno não pode ser vazio.");
        }

        $this->nome = $nome;
    }

    public function toDTO(): AlunoDto
    {
        return new AlunoDto(
            $this->identity(),
            $this->nome,
            $this->dataCadastro,
            $this->matricula,
            $this->email,
            $this->ativo
        );
    }
}
