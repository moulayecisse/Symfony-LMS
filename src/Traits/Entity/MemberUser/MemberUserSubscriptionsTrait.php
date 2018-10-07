<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\MemberUser;

use App\Entity\User\Member\MemberUserSubscription;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

trait MemberUserSubscriptionsTrait
{
    /**
     * Name.
     *
     * @var Collection|MemberUserSubscription[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\User\Member\MemberUserSubscription", mappedBy="memberUser", orphanRemoval=true)
     */
    private $memberUserSubscriptions;

    /**
     * MemberUserSubscriptionsTrait constructor.
     */
    public function __construct()
    {
        $this->memberUserSubscriptions = new ArrayCollection();
    }

    /**
     * Get MemberUserSubscriptions.
     *
     * @return Collection|MemberUserSubscription[]
     */
    public function getMemberUserSubscriptions() : Collection
    {
        return $this->memberUserSubscriptions;
    }

    /**
     * Set MemberUserSubscriptions.
     *
     * @param Collection|MemberUserSubscription[] $memberUserSubscriptions Content
     *
     * @return self
     */
    public function setMemberUserSubscriptions(Collection $memberUserSubscriptions): self
    {
        $this->memberUserSubscriptions = $memberUserSubscriptions;

        return $this;
    }

    /**
     * Add a MemberUserSubscription to MemberUserSubscriptions.
     *
     * @param MemberUserSubscription $memberUserSubscription new MemberUserSubscription
     *
     * @return self
     */
    public function addMemberUserSubscription(MemberUserSubscription $memberUserSubscription): self
    {
        if (!$this->memberUserSubscriptions->contains($memberUserSubscription)) {
            $this->memberUserSubscriptions[] = $memberUserSubscription;
            $memberUserSubscription->setMemberUser($this);
        }

        return $this;
    }

    /**
     * Remove a MemberUserSubscription to MemberUserSubscriptions.
     *
     * @param MemberUserSubscription $memberUserSubscription MemberUserSubscription to remove
     *
     * @return self
     */
    public function removeMemberUserSubscription(MemberUserSubscription $memberUserSubscription): self
    {
        if ($this->memberUserSubscriptions->contains($memberUserSubscription)) {
            $this->memberUserSubscriptions->removeElement($memberUserSubscription);
            if ($memberUserSubscription->getMemberUser() === $this) {
                $memberUserSubscription->setMemberUser(null);
            }
        }

        return $this;
    }
}
