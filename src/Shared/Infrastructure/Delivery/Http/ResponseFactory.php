<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Infrastructure\Delivery\Http;

use Psr\Http\Message\ResponseInterface;

interface ResponseFactory
{
    const HTTP_STATUS_OK = 200;
    const HTTP_STATUS_CREATED = 201;
    const HTTP_STATUS_BAD_REQUEST = 400;

    public function ok($data = null): ResponseInterface;
    public function error($data = null, int $code = self::HTTP_STATUS_BAD_REQUEST): ResponseInterface;
    public function created($data = null): ResponseInterface;
}
