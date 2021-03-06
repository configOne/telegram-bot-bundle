<?php

declare(strict_types=1);

namespace ConfigOne\TradeAlertBot\Telegram\Command;

use ConfigOne\TelegramBotBundle\Telegram\Command\AbstractCommand;
use ConfigOne\TelegramBotBundle\Telegram\Command\PublicCommandInterface;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Update;

class SetCurrencyPairCommand extends AbstractCommand implements PublicCommandInterface
{
    /**
     * @var SetCurrencyPairValueCommand
     */
    private $nextCommand;

    public function __construct(SetCurrencyPairValueCommand $nextCommand)
    {
        $this->nextCommand = $nextCommand;
    }

    public function getName()
    {
        return '/set_currency_pair';
    }

    public function execute(BotApi $api, Update $update, array $availableCommands)
    {
        $userText = $update->getMessage()->getText();

        if ($userText == '123') {
            return $this->nextCommand;
        }


        $api->sendMessage($update->getMessage()->getChat()->getId(), get_class($this));

        return null;
    }

    public function getDescription()
    {
        // TODO: Implement getDescription() method.
    }

}