<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Infrastructure\Delivery\Http;

use AgetalkDDD\Shared\Infrastructure\Delivery\Http\Contracts\ErrorHandlerInterface;
use AgetalkDDD\Shared\Infrastructure\Delivery\Http\Contracts\ResponseFactoryInterface;
use League\Route\Http\Exception\HttpExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

final class ErrorHandler implements ErrorHandlerInterface
{
    private ResponseFactoryInterface $responseFactory;

    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function handle(ServerRequestInterface $request, Throwable $error): ResponseInterface
    {
        $statusCode =
            $error instanceof HttpExceptionInterface ?
                $error->getStatusCode() :
                ResponseFactoryInterface::HTTP_STATUS_BAD_REQUEST;

        return $this->responseFactory->error(['message' => $error->getMessage()], $statusCode);
    }
}
