<?php
declare(strict_types=1);

namespace AgetalkDDD\Shared\Infrastructure\Persistence;

abstract class FileRepository
{
    protected array $data = [];
    protected string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
        $this->load();
    }

    protected function put(string $id, $data)
    {
        $this->data[$id] = $data;
        $this->store();
    }

    protected function get(string $id)
    {
        if (!array_key_exists($id, $this->data)) {
            throw new \DomainException(
                sprintf("[%s] Not found. (id: %s)", get_class($this), $id)
            );
        }

        return $this->data[$id];
    }

    private function load()
    {
        if (file_exists($this->path)) {
            $this->data = unserialize(file_get_contents($this->path));
        }
    }

    private function store()
    {
        file_put_contents($this->path, serialize($this->data));
    }
}
