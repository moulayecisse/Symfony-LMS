<?php

namespace App\Entity;

use Cisse\Traits\Entity\BiographyTrait;
use Cisse\Traits\Entity\BirthdayTrait;
use Cisse\Traits\Entity\FirstNameTrait;
use Cisse\Traits\Entity\IdTrait;
use Cisse\Traits\Entity\LastNameTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Book Author Class.
 *
 * @author  Moulaye Cissé <moulaye.c@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @ORM\Entity(repositoryClass="App\Repository\BookAuthorRepository")
 */
class BookAuthor
{
    use IdTrait;
    use FirstNameTrait;
    use LastNameTrait;
    use BiographyTrait;
    use BirthdayTrait;

    /**
     * @var BookModel[]
     * @ORM\OneToMany(targetEntity="App\Entity\BookModel", mappedBy="author")
     */
    private $books;

//    /**
//     * @var Book[]
//     * @ORM\ManyToMany(targetEntity="App\Entity\Book", mappedBy="authors")
//     */
//    private $contributedBooks;

//    /**
//     * @return Book[]
//     */
//    public function getContributedBooks()
//    {
//        return $this->contributedBookscontributedBooks;
//    }
//
//    /**
//     * @param mixed $contributedBooks
//     *
//     * @return Author
//     */
//    public function setContributedBooks($contributedBooks)
//    {
//        $this->contributedBooks = $contributedBooks;
//
//        return $this;
//    }

    public function __construct()
    {
        $this->books = [];
        $this->contributedBooks = [];
    }

    /**
     * @return BookModel[]
     */
    public function getBooks(): array
    {
//        return $this->books;
        return [];
    }

    public function addBook(BookModel $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->setAuthor($this);
        }

        return $this;
    }

    public function removebook(Book $book): self
    {
        if ($this->books->contains($book)) {
            $this->books->removeElement($book);
            // set the owning side to null (unless already changed)
            if ($book->getAuthor() === $this) {
                $book->setAuthor(null);
            }
        }

        return $this;
    }
}
