<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\EBook;

use App\Entity\Book\Book;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Trait BookTrait
 *
 * @package App\Traits\Entity
 */
trait BookTrait
{
    /**
     * @var Book
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Book\BookModel", inversedBy="eBook")
     */
    private $book;

    /**
     * Get Model.
     *
     * @return Book
     */
    public function getBook() : Book
    {
        return $this->book;
    }

    /**
     * Set Model.
     *
     * @param Book $book
     *
     * @return self
     */
    public function setBook(Book $book): self
    {
        $this->book = $book;

        return $this;
    }
}
