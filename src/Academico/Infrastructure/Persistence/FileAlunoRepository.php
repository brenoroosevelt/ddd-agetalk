<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Infrastructure\Persistence;

use AgetalkDDD\Academico\Domain\Model\Aluno;
use AgetalkDDD\Academico\Domain\Model\AlunoRepository;
use AgetalkDDD\Academico\Domain\Model\VerificacaoEmailUnico;
use AgetalkDDD\Shared\Domain\Model\Email;
use AgetalkDDD\Shared\Infrastructure\Persistence\FileRepository;

class FileAlunoRepository extends FileRepository implements AlunoRepository, VerificacaoEmailUnico
{
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../../../storage/alunos.db");
    }

    public function byId(string $id): Aluno
    {
        return $this->get($id);
    }

    public function save(Aluno $aluno): void
    {
        $this->put($aluno->identity()->value(), $aluno);
    }

    public function ehUnico(Email $email): bool
    {
        /**
 * @var Aluno $data
*/
        foreach ($this->data as $data) {
            if ($data->email()->equal($email)) {
                return false;
            }
        }

        return true;
    }

    public function count(): int
    {
        return count($this->data);
    }

    public function all(): array
    {
        return array_values($this->data);
    }
}