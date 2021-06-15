<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Infrastructure\Delivery\Http;

use Psr\Http\Message\ResponseInterface;

interface ResponseFactory
{
    public function ok($data = null): ResponseInterface;
    public function error($data = null): ResponseInterface;
    public function created($data = null): ResponseInterface;
}
