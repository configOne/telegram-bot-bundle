<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle\Model;

class DefaultChatUser implements ChatUserInterface
{
    private $chatId;
    private $currentCommand;

    public function getChatId()
    {
        return $this->chatId;
    }

    public function getCurrentStateName(): ?string
    {
        return $this->currentCommand;
    }
}