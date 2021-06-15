<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Domain\Support;

interface EventListener
{
    public function handle(DomainEvent $event);
}
