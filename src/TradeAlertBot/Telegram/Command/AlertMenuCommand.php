<?php

declare(strict_types=1);

namespace ConfigOne\TradeAlertBot\Telegram\Command;

use ConfigOne\TelegramBotBundle\Resolver\ChatUserResolverInterface;
use ConfigOne\TelegramBotBundle\Telegram\Command\AbstractCommand;
use ConfigOne\TelegramBotBundle\Telegram\Command\CommandListTrait;
use ConfigOne\TelegramBotBundle\Telegram\Command\PublicCommandInterface;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Update;

class AlertMenuCommand extends AbstractCommand implements PublicCommandInterface
{
    use CommandListTrait;

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

    public function execute(BotApi $api, Update $update, array $availableCommands)
    {
        $api->sendMessage($update->getMessage()->getChat()->getId(), "Alerts Menu\n");
        $api->sendMessage($update->getMessage()->getChat()->getId(), "Available commands:\n");
        $api->sendMessage($update->getMessage()->getChat()->getId(), $this->createCommandList($availableCommands));
    }

    public function getDescription()
    {
        return 'Alerts menu';
    }

}