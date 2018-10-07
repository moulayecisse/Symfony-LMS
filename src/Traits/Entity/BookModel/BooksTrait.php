<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\BookModel;

use App\Entity\Book\Book;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * Trait BooksTrait
 *
 * @package App\Traits\Entity
 */
trait BooksTrait
{
    /**
     * Books
     *
     * @MaxDepth(2)
     *
     * @Groups( { "details", "draft" } )
     *
     * @ORM\OneToMany(targetEntity="Book", mappedBy="bookModel", cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $books;

    /**
     * BooksTrait constructor.
     */
    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    /**
     * Get Books.
     *
     * @return Collection|\App\Entity\Book\Book[]
     */
    public function getBooks() : Collection
    {
        return $this->books;
    }

    /**
     * Set Books.
     *
     * @param Collection|\App\Entity\Book\Book[] $books
     *
     * @return self
     */
    public function setBooks(Collection $books): self
    {
        $this->books = $books;

        return $this;
    }

    /**
     * Add a Book to Books.
     *
     * @param \App\Entity\Book\Book $book add new Book
     *
     * @return self
     */
    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->setAuthor($this);
        }

        return $this;
    }

    /**
     * Remove a Book to Books.
     *
     * @param \App\Entity\Book\Book $book Book book to remove
     *
     * @return self
     */
    public function removeBook(Book $book): self
    {
        if ($this->books->contains($book)) {
            $this->books->removeElement($book);
            if ($book->getAuthor() === $this) {
                $book->setAuthor(null);
            }
        }

        return $this;
    }
}
