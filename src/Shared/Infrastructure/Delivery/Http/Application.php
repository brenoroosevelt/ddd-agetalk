<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Infrastructure\Delivery\Http;

use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\Router;
use League\Route\Strategy\ApplicationStrategy;
use Psr\Container\ContainerInterface;

final class Application
{
    private Router $router;
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $strategy = new ApplicationStrategy();
        $this->router = new Router();
        $strategy->setContainer($container);
        $this->router->setStrategy($strategy);
    }

    public function route(): Router
    {
        return $this->router;
    }

    public function routerProvider(RouterProviderInterface $routerProvider)
    {
        $routerProvider->register($this->router);
    }

    public function middleware(string $fqcnMiddleware)
    {
        $this->router->middleware($this->container->get($fqcnMiddleware));
    }

    public function run(): void
    {
        $request = ServerRequestFactory::fromGlobals(
            $_SERVER,
            $_GET,
            $_POST,
            $_COOKIE,
            $_FILES
        );

        $response = $this->router->dispatch($request);
        (new SapiEmitter())->emit($response);
    }
}
