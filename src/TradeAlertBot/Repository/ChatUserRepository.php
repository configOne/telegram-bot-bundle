<?php

declare(strict_types=1);

namespace ConfigOne\TradeAlertBot\Repository;

use ConfigOne\TelegramBotBundle\Model\ChatUserInterface;
use ConfigOne\TelegramBotBundle\Repository\ChatUserRepositoryInterface;

class ChatUserRepository implements ChatUserRepositoryInterface
{
    public function find($id): ?ChatUserInterface
    {
        // TODO: Implement find() method.
    }

    public function save(ChatUserInterface $chatUser)
    {
        // TODO: Implement save() method.
    }
}