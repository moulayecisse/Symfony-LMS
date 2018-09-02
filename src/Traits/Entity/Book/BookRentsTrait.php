<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\Book;

use App\Entity\BookRent;
use App\Entity\Book;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait BookRentsTrait
{
    /**
     * Name.
     *
     * @var Collection|BookRent[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\BookRent", mappedBy="book")
     */
    private $bookRents;

    /**
     * BookRentsTrait constructor.
     */
    public function __construct()
    {
        $this->bookRents = new ArrayCollection();
    }

    /**
     * Get BookRents.
     *
     * @return Collection|BookRent[]
     */
    public function getBookRents() : Collection
    {
        return $this->bookRents;
    }

    /**
     * Set BookRents.
     *
     * @param Collection|BookRent[] $bookRents Content
     *
     * @return self
     */
    public function setBookRents(Collection $bookRents): self
    {
        $this->bookRents = $bookRents;

        return $this;
    }

    /**
     * Add a BookRent to BookRents.
     *
     * @param BookRent $bookRent new BookRent
     *
     * @return self
     */
    public function addBookRent(BookRent $bookRent): self
    {
        if (!$this->bookRents->contains($bookRent)) {
            $this->bookRents[] = $bookRent;
            $bookRent->setBook($this);
        }

        return $this;
    }

    /**
     * Remove a BookRent to BookRents.
     *
     * @param BookRent $bookRent BookRent to remove
     *
     * @return self
     */
    public function removeBookRent(BookRent $bookRent): self
    {
        if ($this->bookRents->contains($bookRent)) {
            $this->bookRents->removeElement($bookRent);
            if ($bookRent->getBook() === $this) {
                $bookRent->setBook(null);
            }
        }

        return $this;
    }
}
