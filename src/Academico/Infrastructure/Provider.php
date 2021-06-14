<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Infrastructure;

use AgetalkDDD\Academico\Domain\Model\AlunoRepository;
use AgetalkDDD\Academico\Domain\Model\VerificacaoEmailUnico;
use AgetalkDDD\Academico\Infrastructure\Persistence\FileAlunoRepository;
use Habemus\Container;
use Habemus\ServiceProvider\ServiceProvider;

class Provider implements ServiceProvider
{
    public function register(Container $container): void
    {
        $container->add(AlunoRepository::class, FileAlunoRepository::class);
        $container->add(VerificacaoEmailUnico::class, FileAlunoRepository::class);
    }
}
