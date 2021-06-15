<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Domain\Model;

use AgetalkDDD\Shared\Domain\Support\DomainEvent;
use DateTimeImmutable;

final class AlunoRegistrado implements DomainEvent
{
    private string $id;
    private string $nome;
    private string $email;
    private DateTimeImmutable $data;

    public function __construct(string $id, string $nome, string $email)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->data = new DateTimeImmutable();
    }

    public function id(): string
    {
        return $this->id;
    }

    public function nome(): string
    {
        return $this->nome;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function data(): DateTimeImmutable
    {
        return $this->data;
    }
}
