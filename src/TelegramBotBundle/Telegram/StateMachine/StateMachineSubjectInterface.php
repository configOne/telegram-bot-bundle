<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle\Telegram\StateMachine;

interface StateMachineSubjectInterface
{
    public function getCurrentStateName(): ?string;
}