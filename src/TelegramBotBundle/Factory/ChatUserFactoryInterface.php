<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle\Factory;

use ConfigOne\TelegramBotBundle\Model\ChatUserInterface;

interface ChatUserFactoryInterface
{
    public function createNew(): ChatUserInterface;
}