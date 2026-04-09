<?php
namespace App\Shared\Application\Bus\Query;

final class QueryBus {
    /** @var array<string, QueryHandlerInterface> */
    private array $handlers = [];

    public function register(string $queryClass, QueryHandlerInterface $handler): void {
        $this->handlers[$queryClass] = $handler;
    }

    public function ask(QueryInterface $query): mixed {
        $class = $query::class;

        if (!isset($this->handlers[$class])) {
            throw new \LogicException("No handler registered for query: {$class}");
        }

        return ($this->handlers[$class])($query);
    }
}
