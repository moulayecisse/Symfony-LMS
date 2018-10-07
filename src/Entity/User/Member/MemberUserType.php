<?php

namespace App\Entity\User\Member;

use App\Entity\User\MemberUser;
use Cisse\Traits\Entity\IdTrait;
use Cisse\Traits\Entity\NameTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MemberUserTypeRepository")
 */
class MemberUserType
{
   use IdTrait;
   use NameTrait;

    /**
     * @ORM\Column(type="float")
     */
    private $rate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User\MemberUser", mappedBy="memberType")
     */
    private $members;

    public function __construct()
    {
        $this->members = new ArrayCollection();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(float $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * @return Collection|MemberUser[]
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(MemberUser $member): self
    {
        if (!$this->members->contains($member)) {
            $this->members[] = $member;
            $member->setMemberType($this);
        }

        return $this;
    }

    public function removeMember(MemberUser $member): self
    {
        if ($this->members->contains($member)) {
            $this->members->removeElement($member);
            // set the owning side to null (unless already changed)
            if ($member->getMemberType() === $this) {
                $member->setMemberType(null);
            }
        }

        return $this;
    }
}
