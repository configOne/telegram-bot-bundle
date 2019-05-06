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

    public function find($id): ?ChatUserInterface
    {
        return (!empty($this->users[$id])) ? $this->users[$id] : NULL;
    }

    public function save(ChatUserInterface $chatUser): void
    {
        $this->users[$chatUser->getId()] = $chatUser;
    }
}