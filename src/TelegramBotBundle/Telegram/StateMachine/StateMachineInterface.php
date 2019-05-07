<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle\Telegram\StateMachine;

use ConfigOne\TelegramBotBundle\Telegram\Command\CommandInterface;

interface StateMachineInterface
{
    public function can(CommandInterface $command, StateMachineSubjectInterface $subject): bool;
    public function apply(CommandInterface $command, StateMachineSubjectInterface $subject);

    public function getCurrentCommand(StateMachineSubjectInterface $subject): ?CommandInterface;
    public function getCommandByTransition(string $transition): CommandInterface;

    /**
     * @param StateMachineSubjectInterface $subject
     * @return CommandInterface[]
     */
    public function getAvailableCommands(StateMachineSubjectInterface $subject): array;
}