<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle\Repository;

use ConfigOne\TelegramBotBundle\Model\ChatUserInterface;

interface ChatUserRepositoryInterface
{
    public function findByChatId($chatId): ?ChatUserInterface;
    public function save(ChatUserInterface $chatUser);
}