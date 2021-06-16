<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Infrastructure\Persistence;

use AgetalkDDD\Academico\Domain\Model\Aluno;
use AgetalkDDD\Academico\Domain\Model\AlunoRepository;
use AgetalkDDD\Academico\Domain\Model\VerificacaoEmailUnico;
use AgetalkDDD\Shared\Domain\Model\Email;
use AgetalkDDD\Shared\Infrastructure\Persistence\FileRepository;

final class AlunoFileRepository extends FileRepository implements AlunoRepository, VerificacaoEmailUnico
{
    public function porId(string $id): Aluno
    {
        return $this->get($id);
    }

    public function salvar(Aluno $aluno): void
    {
        $this->put($aluno->identity()->value(), $aluno);
    }

    public function jaEstaSendoUsado(Email $email): bool
    {
        /** @var Aluno $data */
        foreach ($this->data as $data) {
            if ($data->email()->equal($email)) {
                return true;
            }
        }

        return false;
    }

    public function total(): int
    {
        return count($this->data);
    }

    public function todos(): array
    {
        return array_values($this->data);
    }
}
