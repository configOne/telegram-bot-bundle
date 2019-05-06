<?php

declare(strict_types=1);

namespace ConfigOne\TradeAlertBot\Entity;

use ConfigOne\TelegramBotBundle\Model\ChatUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class ChatUser implements ChatUserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** @ORM\Column(name="chat_id", type="string", length=100, nullable=false) */
    private $chatId;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="ConfigOne\TradeAlertBot\Entity\Alert", mappedBy="user")
     */
    private $alerts;

    /** @ORM\Column(name="current_command", type="string", nullable=false) */
    private $currentCommand;

    public function __construct()
    {
        $this->currentCommand = 'main_menu';
        $this->alerts = new ArrayCollection();
    }

    public function getChatId()
    {
        return $this->chatId;
    }

    public function setChatId($chatId)
    {
        $this->chatId = $chatId;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getCurrentCommand()
    {
        return $this->currentCommand;
    }

    public function setCurrentCommand($currentCommand): void
    {
        $this->currentCommand = $currentCommand;
    }

    public function getAlerts()
    {
        return clone $this->alerts;
    }

    public function addAlert(Alert $alert)
    {
        if ($this->alerts->contains($alert)) {
            return;
        }

        $this->alerts->add($alert);
    }

    public function removeAlert(Alert $alert)
    {
        if (!$this->alerts->contains($alert)) {
            return;
        }

        $this->alerts->remove($alert);
    }

    public function getCurrentStateName(): ?string
    {
        return $this->getCurrentCommand();
    }
}