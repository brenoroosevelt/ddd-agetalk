<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Domain\Model;

use AgetalkDDD\Shared\Domain\Model\Email;
use DateTimeImmutable;
use JsonSerializable;

final class AlunoDTO implements JsonSerializable
{
    private AlunoId $id;
    private string $nome;
    private DateTimeImmutable $dataCadastro;
    private RGA $matricula;
    private Email $email;
    private bool $ativo;

    public function __construct(
        AlunoId $id,
        string $nome,
        DateTimeImmutable $dataCadastro,
        RGA $matricula,
        Email $email,
        bool $ativo
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->dataCadastro = $dataCadastro;
        $this->matricula = $matricula;
        $this->email = $email;
        $this->ativo = $ativo;
    }

    public function id(): AlunoId
    {
        return $this->id;
    }

    public function nome(): string
    {
        return $this->nome;
    }

    public function dataCadastro(): DateTimeImmutable
    {
        return $this->dataCadastro;
    }

    public function matricula(): RGA
    {
        return $this->matricula;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function ativo(): bool
    {
        return $this->ativo;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => (string) $this->id,
            'nome' => $this->nome,
            'email' => (string) $this->email,
            'ativo' => $this->ativo,
            'matricula' => (string) $this->matricula,
            'dataCadastro' => $this->dataCadastro->format(DATE_ISO8601),
        ];
    }
}
