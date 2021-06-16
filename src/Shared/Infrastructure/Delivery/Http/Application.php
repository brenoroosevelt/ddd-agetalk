<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Infrastructure\Delivery\Http;

use AgetalkDDD\Shared\Infrastructure\Delivery\Http\Contracts\ErrorRenderInterface;
use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use League\Route\Router;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

final class Application
{
    private Router $router;
    private EmitterInterface $emitter;
    private ErrorRenderInterface $errorRender;
    private ServerRequestInterface $request;

    public function __construct(
        Router $router,
        EmitterInterface $emitter,
        ErrorRenderInterface $errorRender,
        ServerRequestInterface $request
    ) {
        $this->router = $router;
        $this->emitter = $emitter;
        $this->errorRender = $errorRender;
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
            $response = $this->errorRender->render($this->request, $error);
        }

        $this->emitter->emit($response);
    }
}
