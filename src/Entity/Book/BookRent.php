<?php

namespace App\Entity\Book;

use App\Entity\Book\Book;
use App\Entity\Member;
use App\Entity\User\MemberUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRentRepository")
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
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="bookRents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $book;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MemberUser", inversedBy="bookRents")
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

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): self
    {
        $this->book = $book;

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
