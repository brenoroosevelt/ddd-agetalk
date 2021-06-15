<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Infrastructure\Delivery\Http;

use HttpException;
use League\Route\Http\Exception\HttpExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

final class ErrorHandler implements ErrorHandlerInterface
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function handle(ServerRequestInterface $request, Throwable $error): ResponseInterface
    {
        $statusCode =
            $error instanceof HttpExceptionInterface ?
                $error->getStatusCode() :
                ResponseFactory::HTTP_STATUS_BAD_REQUEST;

        return $this->responseFactory->error(['message' => $error->getMessage()], $statusCode);
    }
}
