<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\BookLocation;

use App\Entity\Book\BookBooking;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait BookCategoriesTrait
{
    /**
     * Name.
     *
     * @var Collection|BookBooking[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Book\BookCategory", mappedBy="bookLocation")
     */
    private $bookCategories;

    /**
     * BookCategoriesTrait constructor.
     */
    public function __construct()
    {
        $this->bookCategories = new ArrayCollection();
    }

    /**
     * Get BookCategories.
     *
     * @return Collection|\App\Entity\Book\BookBooking[]
     */
    public function getBookCategories() : Collection
    {
        return $this->bookCategories;
    }

    /**
     * Set BookCategories.
     *
     * @param Collection|BookBooking[] $bookCategories Content
     *
     * @return self
     */
    public function setBookCategories(Collection $bookCategories): self
    {
        $this->bookCategories = $bookCategories;

        return $this;
    }

    /**
     * Add a BookBooking to BookCategories.
     *
     * @param \App\Entity\Book\BookBooking $bookBooking new BookBooking
     *
     * @return self
     */
    public function addBookBooking(BookBooking $bookBooking): self
    {
        if (!$this->bookCategories->contains($bookBooking)) {
            $this->bookCategories[] = $bookBooking;
            $bookBooking->setBook($this);
        }

        return $this;
    }

    /**
     * Remove a BookBooking to BookCategories.
     *
     * @param \App\Entity\Book\BookBooking $bookBooking BookBooking to remove
     *
     * @return self
     */
    public function removeBookBooking(BookBooking $bookBooking): self
    {
        if ($this->bookCategories->contains($bookBooking)) {
            $this->bookCategories->removeElement($bookBooking);
            if ($bookBooking->getBook() === $this) {
                $bookBooking->setBook(null);
            }
        }

        return $this;
    }
}
