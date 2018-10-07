<?php

namespace App\Entity\User\Member;

use App\Entity\User\MemberUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MemberUserSubscriptionRepository")
 */
class MemberUserSubscription
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $start;

    /**
     * @ORM\Column(type="datetime")
     */
    private $end;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User\MemberUser", inversedBy="memberSubscriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $memberUser;

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getMemberUser(): ?MemberUser
    {
        return $this->memberUser;
    }

    public function setMemberUser(?MemberUser $memberUser): self
    {
        $this->memberUser = $memberUser;

        return $this;
    }
}
