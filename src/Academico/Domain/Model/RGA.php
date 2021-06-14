<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Domain\Model;

final class RGA
{
    private string $matricula;

    public function __construct(string $matricula)
    {
        $this->matricula = $matricula;
    }

    public static function aleatorio()
    {
        return new self(md5(uniqid()));
    }

    public function format()
    {
        return 'RGA#' . $this->matricula;
    }

    public function __toString(): string
    {
        return $this->format();
    }
}