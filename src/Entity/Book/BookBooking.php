<?php

namespace App\Entity\Book;

use App\Entity\Book\Book;
use App\Entity\User\MemberUser;
use Cisse\Traits\Entity\IdTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookReservationRepository")
 */
class BookBooking
{
    use IdTrait;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Book\Book", inversedBy="bookBookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $book;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User\MemberUser", inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $memberUser;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): self
    {
        $this->book = $book;

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
