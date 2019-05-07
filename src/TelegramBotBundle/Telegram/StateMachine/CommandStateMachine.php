<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle\Telegram\StateMachine;

use ConfigOne\TelegramBotBundle\Telegram\Command\CommandInterface;
use ConfigOne\TelegramBotBundle\Telegram\Command\CommandRegistry;
use Symfony\Component\Workflow\Registry;
use Symfony\Component\Workflow\Transition;

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
        $currentCommand = $this->commandRegistry->getCommand($this->configuration->findCommand($currentState));

        return $currentCommand ?? $this->commandRegistry->getDefaultCommand();
    }

    public function getCommandByTransition(string $transition): CommandInterface
    {
        return $this->commandRegistry->getCommand($this->configuration->findCommand($transition));
    }

    public function getAvailableCommands(StateMachineSubjectInterface $subject): array
    {
        $workflow = $this->registry->get($subject);
        $enabledTransitions = $workflow->getEnabledTransitions($subject);
        $availableCommands = [];

        /**
         * @var Transition $transition
         */
        foreach ($enabledTransitions as $transition) {
            $availableCommands[] = $this->getCommandByTransition($transition->getName());
        }

        return $availableCommands;
    }

}