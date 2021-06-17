<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Domain\Model;

use AgetalkDDD\Shared\Domain\Support\ValueObject;
use DomainException;

final class Email extends ValueObject
{
    private string $email;

    public function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new DomainException("E-mail inválido: $email");
        }

        $this->email = trim($email);
    }

    public function dominio(): string
    {
        return explode('@', $this->email)[1];
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
