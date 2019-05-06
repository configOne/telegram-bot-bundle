<?php

declare(strict_types=1);

namespace ConfigOne\TradeAlertBot\Telegram\Command;

use ConfigOne\TelegramBotBundle\Telegram\Command\AbstractCommand;
use ConfigOne\TelegramBotBundle\Telegram\Command\CommandInterface;
use ConfigOne\TelegramBotBundle\Telegram\Command\PublicCommandInterface;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Update;

class NewAlertCommand extends AbstractCommand implements PublicCommandInterface
{
    /**
     * @var SetExchangeCommand
     */
    private $nextCommand;

    public function __construct(SetExchangeCommand $nextCommand)
    {
        $this->nextCommand = $nextCommand;
    }

    public function getName()
    {
        return '/new_alert';
    }

    public function execute(BotApi $api, Update $update, array $availableCommands)
    {
        $api->sendMessage($update->getMessage()->getChat()->getId(), get_class($this));
        return $this->nextCommand;
    }

    public function getDescription()
    {
        return 'Create new alert.';
    }
}