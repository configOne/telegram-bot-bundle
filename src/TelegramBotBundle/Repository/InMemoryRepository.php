<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle\Repository;

use ConfigOne\TelegramBotBundle\Model\ChatUserInterface;

class InMemoryRepository implements ChatUserRepositoryInterface
{
    /**
     * @var ChatUserInterface[]
     */
    private $users;

    public function findByChatId($chatId): ?ChatUserInterface
    {
        return (!empty($this->users[$chatId])) ? $this->users[$chatId] : NULL;
    }

    public function save(ChatUserInterface $chatUser): void
    {
        $this->users[$chatUser->getChatId()] = $chatUser;
    }
}