<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Application;

class DesativarAlunoCommand
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}
