<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Infrastructure\Delivery\Http;

use League\Route\Router;

interface RouterProviderInterface
{
    public function register(Router $router): void;
}