<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Infrastructure\Delivery\Http;

use AgetalkDDD\Shared\Infrastructure\Delivery\Http\Contracts\ErrorRenderInterface;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\Contracts\ResponseFactoryInterface;
use Habemus\Container;
use Habemus\ServiceProvider\ServiceProvider;
use Laminas\Diactoros\ResponseFactory as LaminasResponseFactory;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\Router;
use League\Route\Strategy\ApplicationStrategy;
use Psr\Http\Message\ResponseFactoryInterface as PsrResponseFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;

final class HttpServiceProvider implements ServiceProvider
{
    public function register(Container $container): void
    {
        // ResponseFactoryInterface
        $container->add(
            ResponseFactoryInterface::class,
            JsonResponse::class
        );

        // PSR ResponseFactoryInterface
        $container->add(
            PsrResponseFactoryInterface::class,
            LaminasResponseFactory::class
        );

        // Emmiter
        $container->add(
            EmitterInterface::class,
            new SapiEmitter()
        );

        // ServerRequest
        $container->add(
            ServerRequestInterface::class,
            ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES)
        );

        // Router
        $container->add(
            Router::class,
            (new Router())->setStrategy((new ApplicationStrategy())->setContainer($container))
        );

        // Error Handler
        $container->add(
            ErrorRenderInterface::class,
            ErrorRender::class
        );
    }
}
