<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle\Telegram\StateMachine;

class StateMachineConfiguration
{
    const STATE_KEY = 'state';
    const TRANSITION_KEY = 'transition';
    const COMMAND_KEY = 'command';

    private $statesConfig = [];
    private $workflowName;

    public function getWorkflowName(): string
    {
        return $this->workflowName;
    }

    public function getStateName($command): ?string
    {
        return $this->find($this->getClass($command), self::STATE_KEY);
    }

    public function getTransitionName($command): ?string
    {
        return $this->find($this->getClass($command), self::TRANSITION_KEY);
    }

    public function findCommand($transitionOrState): ?string
    {
        if (!is_string($transitionOrState)) {
            return null;
        }

        return $this->find($transitionOrState, self::COMMAND_KEY);
    }

    public function loadConfig(array $config): void
    {
        if (!empty($this->statesConfig)) {
            return;
        }

        $this->workflowName = $config['workflow'];
        $this->statesConfig = $config['states'];
    }

    private function getClass($command): string
    {
        if (\is_string($command)) {
            return $command;
        }

        return get_class($command);
    }

    private function find(string $needle, string $key): ?string
    {
        /*
         * ['stateName' => ['command' => 'Some/Command/Class', 'transition' => 'transitionName']];
         */
        foreach ($this->statesConfig as $state => $data) if (in_array($needle, $data)) {

            //add state name to a temp array to simplify search logic
            $data[self::STATE_KEY] = $state;

            return $data[$key];
        }

        return null;
    }
}