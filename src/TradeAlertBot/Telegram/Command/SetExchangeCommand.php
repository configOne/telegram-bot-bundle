<?php

declare(strict_types=1);

namespace ConfigOne\TradeAlertBot\Telegram\Command;

use ConfigOne\TelegramBotBundle\Telegram\Command\AbstractCommand;
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
        // TODO: Implement getName() method.
    }

    public function execute(BotApi $api, Update $update)
    {
        // TODO: Implement execute() method.
    }

    public function getDescription()
    {
        // TODO: Implement getDescription() method.
    }

}