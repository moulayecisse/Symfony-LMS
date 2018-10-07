<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\MemberUser;

use App\Entity\User\Member\MemberUserTestimonial;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait MemberUserTestimonialsTrait
{
    /**
     * Name.
     *
     * @Groups(
     *     "member"
     * )
     *
     * @var Collection|MemberUserTestimonial[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\User\Member\MemberUserTestimonial", mappedBy="member")
     */
    private $memberUserTestimonials;

    /**
     * MemberUserTestimonialsTrait constructor.
     */
    public function __construct()
    {
        $this->memberUserTestimonials = new ArrayCollection();
    }

    /**
     * Get MemberUserTestimonials.
     *
     * @return Collection|MemberUserTestimonial[]
     */
    public function getMemberUserTestimonials() : Collection
    {
        return $this->memberUserTestimonials;
    }

    /**
     * Set MemberUserTestimonials.
     *
     * @param Collection|MemberUserTestimonial[] $memberUserTestimonials Content
     *
     * @return self
     */
    public function setMemberUserTestimonials(Collection $memberUserTestimonials): self
    {
        $this->memberUserTestimonials = $memberUserTestimonials;

        return $this;
    }

    /**
     * Add a MemberUserTestimonial to MemberUserTestimonials.
     *
     * @param MemberUserTestimonial $memberUserTestimonial new MemberUserTestimonial
     *
     * @return self
     */
    public function addMemberUserTestimonial(MemberUserTestimonial $memberUserTestimonial): self
    {
        if (!$this->memberUserTestimonials->contains($memberUserTestimonial)) {
            $this->memberUserTestimonials[] = $memberUserTestimonial;
            $memberUserTestimonial->setMemberUser($this);
        }

        return $this;
    }

    /**
     * Remove a MemberUserTestimonial to MemberUserTestimonials.
     *
     * @param MemberUserTestimonial $memberUserTestimonial MemberUserTestimonial to remove
     *
     * @return self
     */
    public function removeMemberUserTestimonial(MemberUserTestimonial $memberUserTestimonial): self
    {
        if ($this->memberUserTestimonials->contains($memberUserTestimonial)) {
            $this->memberUserTestimonials->removeElement($memberUserTestimonial);
            if ($memberUserTestimonial->getMemberUser() === $this) {
                $memberUserTestimonial->setMemberUser(null);
            }
        }

        return $this;
    }
}
