<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Infrastructure\Delivery\Http;

use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use League\Route\Router;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

final class Application
{
    private Router $router;
    private EmitterInterface $emitter;
    private ErrorHandlerInterface $errorHandler;
    private ServerRequestInterface $request;

    public function __construct(
        Router $router,
        EmitterInterface $emitter,
        ErrorHandlerInterface $errorHandler,
        ServerRequestInterface $request
    ) {
        $this->router = $router;
        $this->emitter = $emitter;
        $this->errorHandler = $errorHandler;
        $this->request = $request;
    }

    public function router(): Router
    {
        return $this->router;
    }

    public function run(): void
    {
        try {
            $response = $this->router->dispatch($this->request);
        } catch (Throwable $error) {
            $response = $this->errorHandler->handle($this->request, $error);
        }

        $this->emitter->emit($response);
    }
}
