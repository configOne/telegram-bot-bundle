<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle\Telegram\Command;

interface PublicCommandInterface extends CommandInterface
{
    /**
     * @return string
     */
    public function getName();
    /**
     * @return string
     */
    public function getDescription();
}