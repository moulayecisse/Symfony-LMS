<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class BookBooking
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pBook;

    /**
     * @ORM\ManyToOne(targetEntity="MemberUser.php", inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $member;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    public function getId()
    {
        return $this->id;
    }

    public function getPBook(): ?Book
    {
        return $this->pBook;
    }

    public function setPBook(?Book $pBook): self
    {
        $this->pBook = $pBook;

        return $this;
    }

    public function getMember(): ?MemberUser
    {
        return $this->member;
    }

    public function setMember(?MemberUser $member): self
    {
        $this->member = $member;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
