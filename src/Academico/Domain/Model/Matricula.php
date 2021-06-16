<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Domain\Model;

use AgetalkDDD\Shared\Domain\Support\ValueObject;

final class Matricula extends ValueObject
{
    private int $ano;
    private int $numero;

    private function __construct(int $ano, int $numero)
    {
        $this->ano = $ano;
        $this->numero = $numero;
    }

    public static function novaMatricula(MatriculaSequencia $sequencia): self
    {
        $ano = (int) date('Y');
        $numero = $sequencia->proximoNumero($ano);
        return new self($ano, $numero);
    }

    public function ano(): int
    {
        return $this->ano;
    }

    public function numero(): int
    {
        return $this->numero;
    }

    public function format()
    {
        return
            sprintf(
                "%s-%s",
                (string) $this->ano,
                str_pad((string) $this->numero, 6, '0', STR_PAD_LEFT)
            );
    }

    public function __toString(): string
    {
        return $this->format();
    }
}
