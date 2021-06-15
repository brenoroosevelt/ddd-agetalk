<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Infrastructure\Delivery\Http;

use Habemus\Container;
use Habemus\ServiceProvider\ServiceProvider;
use Laminas\Diactoros\ResponseFactory;
use Psr\Http\Message\ResponseFactoryInterface;

final class HttpServiceProvider implements ServiceProvider
{
    public function register(Container $container): void
    {
        $container->add(ResponseFactoryInterface::class, ResponseFactory::class);
    }
}
