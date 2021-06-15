<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Infrastructure\Delivery\Http;

use Habemus\Container;
use Habemus\ServiceProvider\ServiceProvider;
use Laminas\Diactoros\ResponseFactory as LaminasResponseFactory;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\Router;
use League\Route\Strategy\ApplicationStrategy;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;

final class HttpServiceProvider implements ServiceProvider
{
    public function register(Container $container): void
    {
        $container->add(ResponseFactory::class, JsonResponseFactory::class);
        $container->add(ResponseFactoryInterface::class, LaminasResponseFactory::class);
        $container->add(EmitterInterface::class, new SapiEmitter());
        $container->add(
            ServerRequestInterface::class,
            ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES)
        );
        $container->add(
            Router::class,
            (new Router())->setStrategy((new ApplicationStrategy())->setContainer($container))
        );
    }
}
