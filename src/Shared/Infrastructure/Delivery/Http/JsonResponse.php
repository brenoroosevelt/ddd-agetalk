<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Infrastructure\Delivery\Http;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

final class JsonResponse
{
    const HTTP_STATUS_OK = 200;
    const HTTP_STATUS_ERROR = 400;

    private ResponseFactoryInterface $responseFactory;

    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function ok($data = null): ResponseInterface
    {
        return $this->newJson(self::HTTP_STATUS_OK, $data);
    }

    public function error($data = null): ResponseInterface
    {
        return $this->newJson(self::HTTP_STATUS_ERROR, $data);
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
