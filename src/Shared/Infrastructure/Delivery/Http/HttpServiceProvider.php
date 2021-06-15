<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Infrastructure\Delivery\Http;

use Habemus\Container;
use Habemus\ServiceProvider\ServiceProvider;
use Laminas\Diactoros\ResponseFactory as LaminasResponseFactory;
use Psr\Http\Message\ResponseFactoryInterface;

final class HttpServiceProvider implements ServiceProvider
{
    public function register(Container $container): void
    {
        $container->add(ResponseFactory::class, JsonResponseFactory::class);
        $container->add(ResponseFactoryInterface::class, LaminasResponseFactory::class);
    }
}
