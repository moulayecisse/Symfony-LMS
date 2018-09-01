<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 */
class BookRent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pBook;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MemberUser", inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $memberUser;

    /**
     * @ORM\Column(type="date")
     */
    private $startDate;

    /**
     * @ORM\Column(type="date")
     */
    private $endDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $returnDate;

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

    public function getMemberUser(): ?Member
    {
        return $this->memberUser;
    }

    public function setMemberUser(?MemberUser $memberUser): self
    {
        $this->memberUser = $memberUser;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getReturnDate(): ?\DateTimeInterface
    {
        return $this->returnDate;
    }

    public function setReturnDate(?\DateTimeInterface $returnDate): self
    {
        $this->returnDate = $returnDate;

        return $this;
    }
}
