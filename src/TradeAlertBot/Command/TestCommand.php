<?php

declare(strict_types=1);

namespace ConfigOne\TradeAlertBot\Command;

use ConfigOne\TelegramBotBundle\Telegram\TelegramUpdatesProcessor;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Style\SymfonyStyle;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Update;

class TestCommand extends Command
{
    /**
     * @var TelegramUpdatesProcessor
     */
    private $processor;

    /**
     * @inheritDoc
     */
    public function __construct(TelegramUpdatesProcessor $processor)
    {
        parent::__construct(null);

        $this->processor = $processor;
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this
            ->setName('telegram:test')
            ->setDescription('Set webhook')
        ;
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $raw = '{
	"update_id": 831365989,
	"message": {
		"message_id": 7,
		"from": {
			"id": 88676156,
			"is_bot": false,
			"first_name": "Oleg",
			"last_name": "Krasavin",
			"username": "okwinza",
			"language_code": "ru"
		},
		"chat": {
			"id": 88676156,
			"first_name": "Oleg",
			"last_name": "Krasavin",
			"username": "okwinza",
			"type": "private"
		},
		"date": 1557128618,
		"text": "/help",
		"entities": [
			{
				"offset": 0,
				"length": 6,
				"type": "bot_command"
			}
		]
	}
}';

        $data = BotApi::jsonValidate($raw, true);
        $this->processor->processUpdate(Update::fromResponse($data));
    }
}