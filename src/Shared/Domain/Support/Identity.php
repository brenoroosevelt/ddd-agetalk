<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Domain\Support;

use DomainException;
use Ramsey\Uuid\Uuid;

class Identity extends ValueObject
{
    protected string $value;

    final public function __construct(string $value)
    {
        if (!Uuid::isValid($value)) {
            throw new DomainException("Invalid UUID");
        }

        $this->value = $value;
    }

    public static function new()
    {
        return new static(Uuid::uuid4()->toString());
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
