<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle\Telegram\Command;

trait CommandListTrait
{
    /**
     * @param PublicCommandInterface[] $commands
     * @return string
     */
    public function createCommandList(array $commands): string
    {
        $result = '';
        foreach ($commands as $command) {
            $result .= sprintf("%s - %s\n", $command->getName(), $command->getDescription());
        }

        return $result;
    }
}