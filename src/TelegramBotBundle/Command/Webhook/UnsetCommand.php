<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle\Command\Webhook;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use TelegramBot\Api\BotApi;

class UnsetCommand extends Command
{
    /**
     * @var BotApi
     */
    private $api;
    /**
     * @inheritDoc
     */
    public function __construct(BotApi $api)
    {
        parent::__construct(null);
        $this->api = $api;
    }
    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this
            ->setName('telegram:webhook:unset')
            ->setDescription('Unset webhook')
        ;
    }
    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $this->api->setWebhook();
        $io->success('Webhook has been unset');
    }
}