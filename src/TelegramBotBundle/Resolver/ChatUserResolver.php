<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle\Resolver;

use ConfigOne\TelegramBotBundle\Model\ChatUserInterface;
use ConfigOne\TelegramBotBundle\Factory\ChatUserFactoryInterface;
use ConfigOne\TelegramBotBundle\Repository\ChatUserRepositoryInterface;

class ChatUserResolver implements ChatUserResolverInterface
{
    /**
     * @var ChatUserRepositoryInterface
     */
    private $repository;

    /**
     * @var ChatUserFactoryInterface
     */
    private $factory;

    public function __construct(ChatUserRepositoryInterface $repository, ChatUserFactoryInterface $factory)
    {
        $this->repository = $repository;
        $this->factory = $factory;
    }

    public function resolve($id): ChatUserInterface
    {
        $chatUser = $this->repository->findByChatId($id);

        if (!$chatUser) {
            $chatUser = $this->factory->createNew();
            $chatUser->setChatId($id);
        }

        return $chatUser;
    }
}