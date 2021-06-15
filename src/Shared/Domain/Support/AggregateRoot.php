<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Domain\Support;

use AgetalkDDD\Shared\Application\EventManager;

abstract class AggregateRoot extends Entity
{
    protected function raiseEvent(DomainEvent $event): void
    {
        EventManager::instance()->dispatch($event);
    }
}
