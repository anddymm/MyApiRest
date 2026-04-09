<?php
namespace App\Shared\Application\Bus\Command;

final class CommandBus {
    /** @var array<string, CommandHandlerInterface> */
    private array $handlers = [];

    public function register(string $commandClass, CommandHandlerInterface $handler): void {
        $this->handlers[$commandClass] = $handler;
    }

    public function dispatch(CommandInterface $command): void {
        $class = $command::class;

        if (!isset($this->handlers[$class])) {
            throw new \LogicException("No handler registered for command: {$class}");
        }

        ($this->handlers[$class])($command);
    }
}
