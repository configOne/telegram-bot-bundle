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
    public function __construct()
    {

    }

    public function getName()
    {
        return '/new_alert';
    }

    public function execute(BotApi $api, Update $update): ?CommandInterface
    {

        $api->sendMessage($update->getMessage()->getChat()->getId(), 'TEST');
        return null;
    }

    public function getDescription()
    {
        return 'Create new alert.';
    }
}