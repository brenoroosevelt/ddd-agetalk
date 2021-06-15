<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Infrastructure\Delivery\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

interface ErrorHandlerInterface
{
    public function handle(ServerRequestInterface $request, Throwable $error): ResponseInterface;
}
