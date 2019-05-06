<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle\Telegram\Command;

use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Update;

class HelpCommand extends AbstractCommand implements PublicCommandInterface
{
    /**
     * @var CommandRegistry
     */
    private $commandRegistry;

    /**
     * @var string
     */
    private $description;

    /**
     * @var array
     */
    private $aliases;

    public function __construct(CommandRegistry $commandRegistry, $description = 'Help', $aliases = [])
    {
        $this->commandRegistry = $commandRegistry;
        $this->description = $description;
        $this->aliases = $aliases;
    }

    public function execute(BotApi $api, Update $update): ?CommandInterface
    {
        $commands = $this->commandRegistry->getAllCommands();
        $reply = '';
        foreach ($commands as $command) {

            if (!$command instanceof PublicCommandInterface) {
                continue;
            }

            $reply .= sprintf("%s - %s\n", $command->getName(), $command->getDescription());
        }
        $api->sendMessage($update->getMessage()->getChat()->getId(), $reply);

        return null;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return '/help';
    }

    /**
     * @inheritDoc
     */
    public function getAliases()
    {
        return $this->aliases;
    }

    /**
     * @inheritDoc
     */
    public function getDescription()
    {
        return $this->description;
    }
}