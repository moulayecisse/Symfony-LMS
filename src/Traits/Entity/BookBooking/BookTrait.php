<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\BookBooking;

use App\Entity\Book\Book;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait BookTrait
 *
 * @package App\Traits\Entity
 */
trait BookTrait
{
    /**
     * Name.
     *
     * @var \App\Entity\Book\Book
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Book\Book", inversedBy="bookBookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $book;

    /**
     * Get Model.
     *
     * @return Null|Book
     */
    public function getBook() : ?Book
    {
        return $this->book;
    }

    /**
     * Set Model.
     *
     * @param Book $book Content
     *
     * @return self
     */
    public function setBook(Book $book): self
    {
        $this->book = $book;

        return $this;
    }
}
