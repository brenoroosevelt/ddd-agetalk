<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Infrastructure\Persistence;

use AgetalkDDD\Academico\Domain\Model\MatriculaSequencia;
use AgetalkDDD\Shared\Infrastructure\Persistence\FileRepository;
use Exception;

class MatriculaSequenciaEmArquivo extends FileRepository implements MatriculaSequencia
{
    public function proximoNumero(int $ano): int
    {
        try {
            $ultimoNumero = (int) $this->get((string) $ano);
        } catch (Exception $exception) {
            $ultimoNumero = 0;
        }

        $ultimoNumero = $ultimoNumero + 1;
        $this->put((string) $ano, $ultimoNumero);
        return $ultimoNumero;
    }
}
