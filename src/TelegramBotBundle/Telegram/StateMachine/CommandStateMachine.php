<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle\Telegram\StateMachine;

use ConfigOne\TelegramBotBundle\Telegram\Command\CommandInterface;
use ConfigOne\TelegramBotBundle\Telegram\Command\CommandRegistry;
use Symfony\Component\Workflow\Registry;

class CommandStateMachine implements StateMachineInterface
{
    /**
     * @var StateMachineConfiguration
     */
    private $configuration;

    /**
     * @var Registry
     */
    private $registry;

    /**
     * @var CommandRegistry
     */
    private $commandRegistry;

    public function __construct(StateMachineConfiguration $configuration,
                                Registry $registry,
                                CommandRegistry $commandRegistry)
    {
        $this->configuration = $configuration;
        $this->commandRegistry = $commandRegistry;
        $this->registry = $registry;
    }

    public function can(CommandInterface $command, StateMachineSubjectInterface $subject): bool
    {
        $workflow = $this->registry->get($subject);

        $transitionName = $this->configuration->getTransitionName($command);
        return $workflow->can($subject, $transitionName);
    }

    public function apply(CommandInterface $command, StateMachineSubjectInterface $subject)
    {
        $workflow = $this->registry->get($subject);

        $transitionName = $this->configuration->getTransitionName($command);
        return $workflow->apply($subject, $transitionName);
    }

    public function getCurrentCommand(StateMachineSubjectInterface $subject): ?CommandInterface
    {
        $currentState = $subject->getCurrentStateName();
        return $this->commandRegistry->getCommand($this->configuration->findCommand($currentState));
    }

    public function getCommandByTransition(string $transition): CommandInterface
    {
        return $this->commandRegistry->getCommand($this->configuration->findCommand($transition));
    }

    public function getAvailableCommands(): array
    {
        return [];
    }

}