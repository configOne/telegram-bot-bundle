<?php

declare(strict_types=1);

namespace ConfigOne\TradeAlertBot\Telegram\Command;

use ConfigOne\TelegramBotBundle\Telegram\Command\AbstractCommand;
use ConfigOne\TelegramBotBundle\Telegram\Command\CommandListTrait;
use ConfigOne\TelegramBotBundle\Telegram\Command\CommandRegistry;
use ConfigOne\TelegramBotBundle\Telegram\Command\PublicCommandInterface;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Update;

class HelpCommand extends AbstractCommand implements PublicCommandInterface
{
    use CommandListTrait;

    /**
     * @var CommandRegistry
     */
    private $commandRegistry;

    /**
     * @var string
     */
    private $description;

    /**
     * @var array
     */
    private $aliases;

    public function __construct(CommandRegistry $commandRegistry, $description = 'Help', $aliases = [])
    {
        $this->commandRegistry = $commandRegistry;
        $this->description = $description;
        $this->aliases = $aliases;
    }

    public function execute(BotApi $api, Update $update, array $availableCommands)
    {
        $api->sendMessage($update->getMessage()->getChat()->getId(), 'Welcome to Main Menu');
        $api->sendMessage($update->getMessage()->getChat()->getId(), "Available commands:\n");
        $api->sendMessage($update->getMessage()->getChat()->getId(), $this->createCommandList($availableCommands));
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return '/help';
    }

    public function getDescription()
    {
        return 'Main menu help plz';
    }
}