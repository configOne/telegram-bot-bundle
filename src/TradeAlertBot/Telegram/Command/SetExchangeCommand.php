<?php

declare(strict_types=1);

namespace ConfigOne\TradeAlertBot\Telegram\Command;

use ConfigOne\TelegramBotBundle\Telegram\Command\AbstractCommand;
use ConfigOne\TelegramBotBundle\Telegram\Command\CommandInterface;
use ConfigOne\TelegramBotBundle\Telegram\Command\PublicCommandInterface;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Update;

class SetExchangeCommand extends AbstractCommand implements PublicCommandInterface
{
    public function __construct()
    {

    }

    public function getName()
    {
        return '/set_exchange';
    }

    public function execute(BotApi $api, Update $update): ?CommandInterface
    {


        return null;
    }

    public function getDescription()
    {
        // TODO: Implement getDescription() method.
    }

}