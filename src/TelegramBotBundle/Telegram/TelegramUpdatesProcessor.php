<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle\Telegram;

use ConfigOne\TelegramBotBundle\Resolver\ChatUserResolver;
use ConfigOne\TelegramBotBundle\Telegram\Command\CommandInterface;
use ConfigOne\TelegramBotBundle\Telegram\Command\CommandRegistry;
use ConfigOne\TelegramBotBundle\Telegram\StateMachine\StateMachineInterface;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Update;

class TelegramUpdatesProcessor
{
    /**
     * @var CommandRegistry
     */
    private $commandRegistry;

    /**
     * @var BotApi
     */
    private $botApi;

    /**
     * @var StateMachineInterface
     */
    private $stateMachine;

    /**
     * @var ChatUserResolver
     */
    private $userResolver;

    public function __construct(BotApi $botApi,
                                CommandRegistry $commandRegistry,
                                StateMachineInterface $stateMachine,
                                ChatUserResolver $userResolver)
    {
        $this->botApi = $botApi;
        $this->commandRegistry = $commandRegistry;
        $this->stateMachine = $stateMachine;
        $this->userResolver = $userResolver;
    }

    public function processUpdate(Update $update)
    {
        $chatId = $this->getChatId($update);
        $currentUser = $this->userResolver->resolve($chatId);
        $availableCommands = $this->stateMachine->getAvailableCommands($currentUser);

        $currentCommand = $this->stateMachine->getCurrentCommand($currentUser);

        foreach ($availableCommands as $command) if ($command->supports($update)) {

            $this->stateMachine->apply($command, $currentUser);
            $nextCommand = $command->execute($this->botApi, $update, $availableCommands);

            $this->handleCommandChain($nextCommand, $update, $currentUser, $availableCommands);
            return;
        }

        // No command matched the user input.
        // Chances are we're in the middle of a conversation
        // and it's some kind of data so we let the last executed command handle it.
        $nextCommand = $currentCommand->execute($this->botApi, $update, $availableCommands);

        $this->handleCommandChain($nextCommand, $update, $currentUser, $availableCommands);
    }

    private function handleCommandChain($command, Update $update, $currentUser, array $availableCommands)
    {
        // If there is a next command defined then we're going through the chain
        while ($command instanceof CommandInterface && $this->stateMachine->can($command, $currentUser)) {
            $this->stateMachine->apply($command, $currentUser);
            $command = $command->execute($this->botApi, $update, $availableCommands);
        }
    }

    private function getChatId(Update $update)
    {
        return $update->getMessage()->getChat()->getId();
    }

}