<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Infrastructure\Delivery\Http;

use AgetalkDDD\Shared\Infrastructure\Delivery\Http\Contracts\ResponseFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface as PsrResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

final class JsonResponse implements ResponseFactoryInterface
{
    private PsrResponseFactoryInterface $responseFactory;

    public function __construct(PsrResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function ok($data = null): ResponseInterface
    {
        return $this->newJson(self::HTTP_STATUS_OK, $data);
    }

    public function error($data = null, int $code = self::HTTP_STATUS_BAD_REQUEST): ResponseInterface
    {
        return $this->newJson($code, $data);
    }

    public function created($data = null): ResponseInterface
    {
        return $this->newJson(self::HTTP_STATUS_CREATED, $data);
    }

    private function newJson(int $status, $data = null): ResponseInterface
    {
        $response = $this->responseFactory->createResponse();
        if ($data !== null) {
            $response->getBody()->write(json_encode($data));
        }

        return $response->withStatus($status)->withHeader('Content-type', 'application/json');
    }
}
