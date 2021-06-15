<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Infrastructure\Delivery\Http\Contracts;

use Psr\Http\Message\ResponseInterface as PrsResponseInterface;

interface ResponseFactoryInterface
{
    const HTTP_STATUS_OK = 200;
    const HTTP_STATUS_CREATED = 201;
    const HTTP_STATUS_BAD_REQUEST = 400;

    public function ok($data = null): PrsResponseInterface;
    public function error($data = null, int $code = self::HTTP_STATUS_BAD_REQUEST): PrsResponseInterface;
    public function created($data = null): PrsResponseInterface;
}
