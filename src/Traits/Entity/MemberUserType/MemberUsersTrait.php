<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\MemberUserType;

use App\Entity\User\MemberUser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait MembersTrait
 *
 * @package App\Traits\Entity
 */
trait MemberUsersTrait
{
    /**
     * Name.
     *
     * @var Collection|MemberUser[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\User\MemberUser", mappedBy="memberType")
     */
    private $members;

    /**
     * MembersTrait constructor.
     */
    public function __construct()
    {
        $this->members = new ArrayCollection();
    }

    /**
     * Get Members.
     *
     * @return Collection|\App\Entity\Member\Member[]
     */
    public function getMembers() : Collection
    {
        return $this->members;
    }

    /**
     * Set Members.
     *
     * @param Collection|\App\Entity\Member\Member[] $members
     *
     * @return self
     */
    public function setMembers(Collection $members): self
    {
        $this->members = $members;

        return $this;
    }

    /**
     * Add a Member to Members.
     *
     * @param \App\Entity\Member\Member $member add new Member
     *
     * @return self
     */
    public function addMember(Member $member): self
    {
        if (!$this->members->contains($member)) {
            $this->members[] = $member;
            $member->setAuthor($this);
        }

        return $this;
    }

    /**
     * Remove a Member to Members.
     *
     * @param \App\Entity\Member\Member $member Member member to remove
     *
     * @return self
     */
    public function removeMember(Member $member): self
    {
        if ($this->members->contains($member)) {
            $this->members->removeElement($member);
            if ($member->getAuthor() === $this) {
                $member->setAuthor(null);
            }
        }

        return $this;
    }
}
