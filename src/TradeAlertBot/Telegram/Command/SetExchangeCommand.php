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
    /**
     * @var SetCurrencyPairCommand
     */
    private $nextCommand;

    public function __construct(SetCurrencyPairCommand $nextCommand)
    {
        $this->nextCommand = $nextCommand;
    }

    public function getName()
    {
        return '/set_exchange';
    }

    public function execute(BotApi $api, Update $update): ?CommandInterface
    {

        $api->sendMessage($update->getMessage()->getChat()->getId(), get_class($this));
        return $this->nextCommand;
    }

    public function getDescription()
    {
        // TODO: Implement getDescription() method.
    }

}