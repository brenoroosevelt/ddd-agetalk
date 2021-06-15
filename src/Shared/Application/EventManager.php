<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Application;

use AgetalkDDD\Shared\Domain\Support\DomainEvent;

final class EventManager
{
    private static ?self $instance = null;

    public function dispatch(DomainEvent $event): void
    {
        // dispatch event
    }

    public static function instance(): self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
    }
}
