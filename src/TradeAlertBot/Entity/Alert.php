<?php

declare(strict_types=1);

namespace ConfigOne\TradeAlertBot\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Alert
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** @ORM\Column(name="exchange_name", type="string", nullable=false) */
    private $exchangeName;

    /** @ORM\Column(name="currency_pair", type="string", nullable=false) */
    private $currencyPair;

    /** @ORM\Column(name="threshold", type="integer", nullable=false) */
    private $threshold;

    /**
     * @ORM\ManyToOne(targetEntity="ConfigOne\TradeAlertBot\Entity\ChatUser")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    public function getExchangeName()
    {
        return $this->exchangeName;
    }

    public function setExchangeName($exchangeName): void
    {
        $this->exchangeName = $exchangeName;
    }

    public function getCurrencyPair()
    {
        return $this->currencyPair;
    }

    public function setCurrencyPair($currencyPair): void
    {
        $this->currencyPair = $currencyPair;
    }

    public function getThreshold()
    {
        return $this->threshold;
    }

    public function setThreshold($threshold): void
    {
        $this->threshold = $threshold;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user): void
    {
        $this->user = $user;
    }

}