<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\Book;

use App\Entity\Book\BookBooking;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait BookBookingsTrait
{
    /**
     * Name.
     *
     * @var Collection|\App\Entity\Book\BookBooking[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Book\BookBooking", mappedBy="book")
     */
    private $bookBookings;

    /**
     * BookBookingsTrait constructor.
     */
    public function __construct()
    {
        $this->bookBookings = new ArrayCollection();
    }

    /**
     * Get BookBookings.
     *
     * @return Collection|\App\Entity\Book\BookBooking[]
     */
    public function getBookBookings() : Collection
    {
        return $this->bookBookings;
    }

    /**
     * Set BookBookings.
     *
     * @param Collection|BookBooking[] $bookBookings Content
     *
     * @return self
     */
    public function setBookBookings(Collection $bookBookings): self
    {
        $this->bookBookings = $bookBookings;

        return $this;
    }

    /**
     * Add a BookBooking to BookBookings.
     *
     * @param \App\Entity\Book\BookBooking $bookBooking new BookBooking
     *
     * @return self
     */
    public function addBookBooking(BookBooking $bookBooking): self
    {
        if (!$this->bookBookings->contains($bookBooking)) {
            $this->bookBookings[] = $bookBooking;
            $bookBooking->setBook($this);
        }

        return $this;
    }

    /**
     * Remove a BookBooking to BookBookings.
     *
     * @param \App\Entity\Book\BookBooking $bookBooking BookBooking to remove
     *
     * @return self
     */
    public function removeBookBooking(BookBooking $bookBooking): self
    {
        if ($this->bookBookings->contains($bookBooking)) {
            $this->bookBookings->removeElement($bookBooking);
            if ($bookBooking->getBook() === $this) {
                $bookBooking->setBook(null);
            }
        }

        return $this;
    }
}
