<?php
declare(strict_types=1);

namespace AgetalkDDD\Academico\Infrastructure\Persistence;

use AgetalkDDD\Academico\Domain\Model\AlunoRepository;
use AgetalkDDD\Academico\Domain\Model\VerificacaoEmailUnico;
use Habemus\Container;
use Habemus\ServiceProvider\ServiceProvider;

final class PersistenceServiceProvider implements ServiceProvider
{
    public function register(Container $container): void
    {
        $repository = new AlunoFileRepository(STORAGE_PATH . "alunos.db");

        // AlunoRepository
        $container->add(
            AlunoRepository::class,
            $repository
        );

        // VerificacaoEmailUnico
        $container->add(
            VerificacaoEmailUnico::class,
            $repository
        );
    }
}
