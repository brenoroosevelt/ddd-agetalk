<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Application;

class CadastrarAlunoCommand
{
    private string $nome;
    private string $email;

    public function __construct(string $nome, string $email)
    {
        $this->nome = $nome;
        $this->email = $email;
    }

    public function nome(): string
    {
        return $this->nome;
    }

    public function email(): string
    {
        return $this->email;
    }
}
