<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle\Resolver;

use ConfigOne\TelegramBotBundle\Model\ChatUserInterface;

interface ChatUserResolverInterface
{
    public function resolve($id): ChatUserInterface;
}