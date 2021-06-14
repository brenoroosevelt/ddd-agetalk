<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Domain;

interface EventListener
{
    public function handle(DomainEvent $event);
}
