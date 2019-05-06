<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle\Factory;

use ConfigOne\TelegramBotBundle\Model\ChatUserInterface;

class ChatUserFactory implements ChatUserFactoryInterface
{
    /**
     * @var string
     */
    private $className;

    public function __construct(string $className)
    {
        $this->className = $className;
    }

    public function createNew(): ChatUserInterface
    {
        return new $this->className;
    }
}