<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle\EventSubscriber;

use ConfigOne\TelegramBotBundle\Model\ChatUserInterface;
use ConfigOne\TelegramBotBundle\Repository\ChatUserRepositoryInterface;
use ConfigOne\TelegramBotBundle\Telegram\StateMachine\StateMachineInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Workflow\Event\Event;
use Symfony\Component\Workflow\Event\GuardEvent;

class WorkflowSubscriber implements EventSubscriberInterface
{
    /**
     * @var ChatUserRepositoryInterface
     */
    private $repository;

    /**
     * @var StateMachineInterface
     */
    private $stateMachine;

    public function __construct(ChatUserRepositoryInterface $repository, StateMachineInterface $stateMachine)
    {
        $this->repository = $repository;
        $this->stateMachine = $stateMachine;
    }

    public function updateChatUser(Event $event)
    {
        $subject = $event->getSubject();
        if (!$subject instanceof ChatUserInterface) {
            return;
        }

        $this->repository->save($subject);
    }

    public function checkCommand(GuardEvent $event)
    {
        $subject = $event->getSubject();
        if (!$subject instanceof ChatUserInterface) {
            return;
        }

        $command = $this->stateMachine->getCommandByTransition($event->getTransition()->getName());

        if (FALSE === $command->canBeCalled()) {
            $event->setBlocked(true);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            'workflow.entered' => 'updateChatUser',
            'workflow.guard' => 'checkCommand',
        ];
    }
}