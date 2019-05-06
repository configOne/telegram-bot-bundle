<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle\Model;

use ConfigOne\TelegramBotBundle\Telegram\StateMachine\StateMachineSubjectInterface;

interface ChatUserInterface extends StateMachineSubjectInterface
{
    public function getChatId();
}