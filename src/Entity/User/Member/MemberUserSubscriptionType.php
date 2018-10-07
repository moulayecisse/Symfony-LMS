<?php

namespace App\Entity\User\Member;

use Cisse\Traits\Entity\IdTrait;
use Cisse\Traits\Entity\NameTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MemberSubscriptionTypeRepository")
 */
class MemberUserSubscriptionType
{
    use IdTrait;
    use NameTrait;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
