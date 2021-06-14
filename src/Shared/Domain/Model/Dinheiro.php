<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Domain\Model;

use AgetalkDDD\Shared\Domain\ValueObject;

final class Dinheiro extends ValueObject
{
    private float $valor;

    public function __construct(float $valor)
    {
        $this->valor = $valor;
    }

    public function valor(): float
    {
        return $this->valor;
    }

    public function format(): string
    {
        return number_format($this->valor, 2, ',', '.');
    }

    public function __toString(): string
    {
        return $this->format();
    }
}
