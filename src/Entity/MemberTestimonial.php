<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestimonialRepository")
 */
class MemberTestimonial
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @var MemberUser
     *
     * @ORM\ManyToOne(targetEntity="MemberUser.php", inversedBy="testimonials")
     */
    private $member;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     * @return MemberTestimonial
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
     * @return MemberTestimonial
     */
    public function setMember(MemberUser $member): MemberTestimonial
    {
        $this->member = $member;
        return $this;
    }
}
