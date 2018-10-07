<?php

namespace App\Entity\User;

use App\Entity\User\Member\MemberUserEBook;
use App\Entity\User\Member\MemberUserSubscription;
use App\Entity\User\Member\MemberUserTestimonial;
use App\Entity\User\Member\MemberUserType;
use App\Entity\User\User;
use App\Traits\Entity\MemberUser\BookRentsTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\MappedSuperclass()
 *
 * @ORM\Entity(repositoryClass="App\Repository\MemberUserRepository")
 */
class MemberUser extends User
{
    use BookRentsTrait;
//    use MemberUserEBooksTrait;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User\Member\MemberUserEBook", mappedBy="memberUser", orphanRemoval=true)
     */
    private $memberEBooks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User\Member\MemberUserSubscription", mappedBy="memberUser", orphanRemoval=true)
     */
    private $memberSubscriptions;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User\Member\MemberUserType", inversedBy="members")
     * @ORM\JoinColumn(nullable=true)
     */
    private $memberType;

    /**
     * @Groups(
     *     "member"
     * )
     *
     * @ORM\OneToMany(targetEntity="App\Entity\User\Member\MemberUserTestimonial", mappedBy="member")
     */
    private $memberUserTestimonials;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(min="10", max="10")
     */
    private $phone;

    public function __construct()
    {
        $this->setRoles([self::ROLE_MEMBER]);
        $this->memberEBooks = new ArrayCollection();
        $this->memberSubscriptions = new ArrayCollection();
        $this->memberUserTestimonials = new ArrayCollection();
    }

    /**
     * @return Collection|MemberUserEBook[]
     */
    public function getMemberEBooks(): Collection
    {
        return $this->memberEBooks;
    }

    public function addMemberEBook(MemberUserEBook $memberEBook): self
    {
        if (!$this->memberEBooks->contains($memberEBook)) {
            $this->memberEBooks[] = $memberEBook;
            $memberEBook->setMemberUser($this);
        }

        return $this;
    }

    public function removeMemberEBook(MemberUserEBook $memberEBook): self
    {
        if ($this->memberEBooks->contains($memberEBook)) {
            $this->memberEBooks->removeElement($memberEBook);
            // set the owning side to null (unless already changed)
            if ($memberEBook->getMemberUser() === $this) {
                $memberEBook->setMemberUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|\App\Entity\User\Member\MemberUserSubscription[]
     */
    public function getMemberSubscriptions(): Collection
    {
        return $this->memberSubscriptions;
    }

    public function addMemberSubscription(MemberUserSubscription $memberSubscription): self
    {
        if (!$this->memberSubscriptions->contains($memberSubscription)) {
            $this->memberSubscriptions[] = $memberSubscription;
            $memberSubscription->setMemberUser($this);
        }

        return $this;
    }

    public function removeMemberSubscription(MemberUserSubscription $memberSubscription): self
    {
        if ($this->memberSubscriptions->contains($memberSubscription)) {
            $this->memberSubscriptions->removeElement($memberSubscription);
            // set the owning side to null (unless already changed)
            if ($memberSubscription->getMemberUser() === $this) {
                $memberSubscription->setMemberUser(null);
            }
        }

        return $this;
    }

    public function getMemberType(): ?MemberUserType
    {
        return $this->memberType;
    }

    public function setMemberType(?MemberUserType $memberType): self
    {
        $this->memberType = $memberType;

        return $this;
    }

    /**
     * @return Collection|MemberUserTestimonial[]
     */
    public function getMemberUserTestimonials(): Collection
    {
        return $this->memberUserTestimonials;
    }

    public function addTestimonial(MemberUserTestimonial $testimonial): self
    {
        if (!$this->memberUserTestimonials->contains($testimonial)) {
            $this->memberUserTestimonials[] = $testimonial;
            $testimonial->setMember($this);
        }

        return $this;
    }

    public function removeTestimonial(MemberUserTestimonial $testimonial): self
    {
        if ($this->memberUserTestimonials->contains($testimonial)) {
            $this->memberUserTestimonials->removeElement($testimonial);
            // set the owning side to null (unless already changed)
            if ($testimonial->getMember() === $this) {
                $testimonial->setMember(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     *
     * @return MemberUser
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }
}
