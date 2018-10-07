<?php

namespace App\Entity\User\Member;

use App\Entity\User\MemberUser;
use Cisse\Traits\Entity\IdTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MemberUserTestimonialRepository")
 */
class MemberUserTestimonial
{
    use IdTrait;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @var MemberUser
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User\MemberUser", inversedBy="memberUserTestimonials")
     */
    private $member;

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     * @return MemberUserTestimonial
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return MemberUser
     */
    public function getMember(): MemberUser
    {
        return $this->member;
    }

    /**
     * @param MemberUser $member
     * @return MemberUserTestimonial
     */
    public function setMember(MemberUser $member): MemberUserTestimonial
    {
        $this->member = $member;
        return $this;
    }
}
