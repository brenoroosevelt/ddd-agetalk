<?php
declare(strict_types=1);

namespace AgetalkDDD\Anemic\Application;

use AgetalkDDD\Academico\Domain\Model\Matricula;
use AgetalkDDD\Anemic\Domain\Model\AnemicAluno;
use AgetalkDDD\Anemic\Domain\Model\AlunoRepository;
use AgetalkDDD\Shared\Domain\Model\Email;
use DateTimeImmutable;
use DomainException;

final class AlunoService
{
    private AlunoRepository $repository;

    public function __construct(AlunoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function alterarDados(string $id, string $nome, string $email): AnemicAluno
    {
        $aluno = $this->repository->byId($id);
        if (!$aluno->ativo()) {
            throw new DomainException("Não pode alterar dados de um aluno inativo.");
        }

        $this->validarNome($nome);

        $aluno->setNome($nome);
        $aluno->setEmail(new Email($email));
        $this->repository->save($aluno);
        return $aluno;
    }

    public function novo(string $nome, string $email): AnemicAluno
    {
        foreach ($this->repository->all() as $aluno) {
            if ($aluno->email()->equal(new Email($email))) {
                throw new DomainException("Este e-mail já está em uso: " . $email);
            }
        }

        $this->validarNome($nome);

        $aluno = new AnemicAluno(
            Matricula::aleatorio(),
            new Email($email),
            new DateTimeImmutable(),
            $nome,
            true
        );

        $this->repository->save($aluno);
        return $aluno;
    }

    public function desativar(string $id): AnemicAluno
    {
        $aluno = $this->repository->byId($id);
        $aluno->setAtivo(false);
        $this->repository->save($aluno);
        return $aluno;
    }

    private function validarNome(string $nome)
    {
        if (empty($nome)) {
            throw new DomainException("Nome do aluno não pode ser vazio.");
        }
    }
}
