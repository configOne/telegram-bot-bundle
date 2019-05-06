<?php

declare(strict_types=1);

namespace ConfigOne\TradeAlertBot\Telegram\Command;

use ConfigOne\TelegramBotBundle\Resolver\ChatUserResolverInterface;
use ConfigOne\TelegramBotBundle\Telegram\Command\AbstractCommand;
use ConfigOne\TelegramBotBundle\Telegram\Command\CommandInterface;
use ConfigOne\TelegramBotBundle\Telegram\Command\PublicCommandInterface;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Update;

class AlertMenuCommand extends AbstractCommand implements PublicCommandInterface
{
    /**
     * @var ChatUserResolverInterface
     */
    private $chatUserResolver;

    public function __construct(ChatUserResolverInterface $chatUserResolver)
    {
        $this->chatUserResolver = $chatUserResolver;
    }

    public function getName()
    {
        return '/alerts';
    }

    public function execute(BotApi $api, Update $update): ?CommandInterface
    {
        $reply = "Alerts Menu.\n Type /new_alert to create one.\n Or type /help to get back to main menu.";

        $api->sendMessage($update->getMessage()->getChat()->getId(), $reply);
        return null;
    }

    public function getDescription()
    {
        return 'Alerts menu';
    }

}