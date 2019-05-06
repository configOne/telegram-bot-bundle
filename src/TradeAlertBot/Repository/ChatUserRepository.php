<?php

declare(strict_types=1);

namespace ConfigOne\TradeAlertBot\Repository;

use ConfigOne\TelegramBotBundle\Model\ChatUserInterface;
use ConfigOne\TelegramBotBundle\Repository\ChatUserRepositoryInterface;
use ConfigOne\TradeAlertBot\Entity\ChatUser;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;

class ChatUserRepository implements ChatUserRepositoryInterface
{
    /** @var ObjectManager */
    private $entityManager;

    /** @var EntityRepository */
    private $repository;

    public function __construct(ObjectManager $entityManager)
    {
        $this->repository = $entityManager->getRepository(ChatUser::class);
        $this->entityManager = $entityManager;
    }

    public function findByChatId($chatId): ?ChatUserInterface
    {
        return $this->repository->findOneBy(['chatId' => $chatId]);
    }

    public function save(ChatUserInterface $chatUser)
    {
        $this->entityManager->persist($chatUser);
        $this->entityManager->flush();
    }
}