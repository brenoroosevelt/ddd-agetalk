<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Domain\Model;

use AgetalkDDD\Shared\Domain\AggregateRoot;
use AgetalkDDD\Shared\Domain\Model\Email;
use DateTimeImmutable;
use DomainException;

final class Aluno extends AggregateRoot
{
    private RGA $matricula;
    private Email $email;
    private DateTimeImmutable $dataCadastro;
    private string $nome;
    private bool $ativo;

    public function __construct(AlunoId $id, RGA $matricula, string $nome, Email $email)
    {
        if (empty($nome)) {
            throw new DomainException("Nome do aluno não pode ser vazio.");
        }

        $this->id = $id;
        $this->matricula = $matricula;
        $this->email = $email;
        $this->nome = $nome;
        $this->ativo = true;
        $this->dataCadastro = new DateTimeImmutable();

        $this->raiseEvent(new AlunoRegistrado((string) $id, $nome, (string) $email));
    }

    public function alterarDadosPessoais(string $novoNome, string $novoEmail): void
    {
        if (!$this->ativo) {
            throw new DomainException("Aluno inativo não pode ser alterado.");
        }

        $this->nome = $novoNome;
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

    public function matricula(): RGA
    {
        return $this->matricula;
    }

    public function dataCadastro(): DateTimeImmutable
    {
        return $this->dataCadastro;
    }

    public function toDTO(): AlunoDTO
    {
        return new AlunoDTO(
            $this->identity(),
            $this->nome,
            $this->dataCadastro,
            $this->matricula,
            $this->email,
            $this->ativo
        );
    }
}
