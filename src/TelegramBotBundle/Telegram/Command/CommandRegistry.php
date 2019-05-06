<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle\Telegram\Command;

class CommandRegistry
{
    /**
     * @var CommandInterface[]
     */
    private $commands;

    /**
     * @var CommandInterface
     */
    private $defaultCommand;

    public function __construct()
    {
        $this->commands = [];
    }

    /**
     * @return CommandInterface[]
     */
    public function getAllCommands(): array
    {
        return $this->commands;
    }

    public function getCommand(string $className): CommandInterface
    {
        if (!$this->contains($className)) {
            throw new \LogicException(sprintf('Command "%s" not found', $className));
        }

        return $this->commands[$className];
    }

    public function addCommand(CommandInterface $command): void
    {
        $this->commands[get_class($command)] = $command;
    }

    public function getDefaultCommand(): CommandInterface
    {
        if (!$this->defaultCommand) {
            throw new \LogicException('No default command configured.');
        }

        return $this->defaultCommand;
    }

    public function setDefaultCommand(CommandInterface $command): void
    {
        $this->defaultCommand = $command;
    }

    public function contains(string $className): bool
    {
        return !empty($this->commands[$className]);
    }
}