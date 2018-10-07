<?php

namespace App\Entity\Library;

use App\Entity\Book\Book;
use Cisse\Traits\Entity\EmailTrait;
use Cisse\Traits\Entity\IdTrait;
use Cisse\Traits\Entity\NameTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LibraryRepository")
 */
class Library
{
    use IdTrait;
    use NameTrait;
    use EmailTrait;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="time")
     */
    private $openingDate;

    /**
     * @ORM\Column(type="time")
     */
    private $closingTime;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Book\Book", mappedBy="library", cascade={"remove"})
     */
    private $books;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User\LibrarianUser", mappedBy="library")
     */
    private $librarians;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getOpeningDate(): ?\DateTimeInterface
    {
        return $this->openingDate;
    }

    public function setOpeningDate(\DateTimeInterface $openingDate): self
    {
        $this->openingDate = $openingDate;

        return $this;
    }

    public function getClosingTime(): ?\DateTimeInterface
    {
        return $this->closingTime;
    }

    public function setClosingTime(\DateTimeInterface $closingTime): self
    {
        $this->closingTime = $closingTime;

        return $this;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addPBook(Book $pBook): self
    {
        if (!$this->books->contains($pBook)) {
            $this->books[] = $pBook;
            $pBook->setLibrary($this);
        }

        return $this;
    }

    public function removePBook(Book $pBook): self
    {
        if ($this->books->contains($pBook)) {
            $this->books->removeElement($pBook);
            // set the owning side to null (unless already changed)
            if ($pBook->getLibrary() === $this) {
                $pBook->setLibrary(null);
            }
        }

        return $this;
    }
}
