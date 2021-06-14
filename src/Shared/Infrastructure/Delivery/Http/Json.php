<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Infrastructure\Delivery\Http;

use Psr\Http\Message\ResponseInterface;

final class Json
{
    const HTTP_OK = 200;
    const HTTP_ERROR = 400;

    private ResponseInterface $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function ok($data = null): ResponseInterface
    {
        return $this->withJson(self::HTTP_OK, $data);
    }

    public function error($data = null): ResponseInterface
    {
        return $this->withJson(self::HTTP_ERROR, $data);
    }

    private function withJson(int $status, $data = null): ResponseInterface
    {
        if (!empty($data)) {
            $this->response->getBody()->write(json_encode($data));
        }

        return $this->response->withStatus($status)->withHeader('Content-type', 'application/json');
    }
}
