<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle\Action;

use ConfigOne\TelegramBotBundle\Telegram\TelegramUpdatesProcessor;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Update;

class WebhookAction
{
    /**
     * @var TelegramUpdatesProcessor
     */
    private $telegramUpdatesProcessor;

    public function __construct(TelegramUpdatesProcessor $telegramUpdatesProcessor)
    {
        $this->telegramUpdatesProcessor = $telegramUpdatesProcessor;
    }

    public function __invoke(Request $request)
    {
        $data = BotApi::jsonValidate($request->getContent(), true);
        $this->telegramUpdatesProcessor->processUpdate(Update::fromResponse($data));

        return new Response();
    }
}