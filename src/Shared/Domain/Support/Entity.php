<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Domain\Support;

abstract class Entity
{
    protected Identity $id;

    public function identity(): Identity
    {
        return $this->id;
    }

    // Comparação por identidade
    public function equal(Entity $v): bool
    {
        return get_class($v) === get_class($this) && $v->identity()->equal($this->identity());
    }
}
