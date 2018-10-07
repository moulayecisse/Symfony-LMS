<?php

namespace App\Entity\User\Member;

use App\Entity\Book\EBook;
use App\Entity\Member;
use App\Entity\User\MemberUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MemberUserEBookRepository")
 */
class MemberUserEBook
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MemberUser", inversedBy="memberEBooks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $memberUser;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EBook", inversedBy="memberEBooks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ebook;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    public function getId()
    {
        return $this->id;
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

    public function getMemberUser(): ?Member
    {
        return $this->memberUser;
    }

    public function setMemberUser(?MemberUser $memberUser): self
    {
        $this->memberUser = $memberUser;

        return $this;
    }

    public function getEBook(): ?EBook
    {
        return $this->ebook;
    }

    public function setEBook(?EBook $ebook): self
    {
        $this->ebook = $ebook;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }
}
