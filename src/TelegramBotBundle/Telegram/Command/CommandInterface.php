<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle\Telegram\Command;

use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Update;

interface CommandInterface
{
    /**
     * @param BotApi $api
     * @param Update $update
     * @return null|CommandInterface next command to execute
     */
    public function execute(BotApi $api, Update $update): ?CommandInterface;

    /**
     * @param Update $update
     * @return bool
     */
    public function supports(Update $update);

    /**
     * Prevents the user from executing the command if set to FALSE
     * @return bool
     */
    public function canBeCalled(): bool;
}