<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Infrastructure\Delivery\Http;

use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use League\Route\Router;
use Psr\Http\Message\ServerRequestInterface;

final class Http
{
    private Router $router;
    private EmitterInterface $emitter;
    private ServerRequestInterface $request;

    public function __construct(
        Router $router,
        EmitterInterface $emitter,
        ServerRequestInterface $request
    ) {
        $this->router = $router;
        $this->emitter = $emitter;
        $this->request = $request;
    }

    public function router(): Router
    {
        return $this->router;
    }

    public function dispatch(): void
    {
        $this->emitter->emit(
            $this->router->dispatch($this->request)
        );
    }
}
