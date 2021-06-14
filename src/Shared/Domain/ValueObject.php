<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Domain;

abstract class ValueObject
{
    // Comparação por valor
    // https://www.php.net/manual/pt_BR/language.oop5.object-comparison.php
    public function equal(object $v): bool
    {
        return $this == $v;
    }
}
