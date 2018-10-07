<?php

namespace App\Entity\Book;

use App\Entity\Book\Book;
use App\Entity\Book\BookModel;
use App\Traits\Entity\BookAuthor\BooksTrait;
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
    use BooksTrait { BooksTrait::__construct as private __constructBooks; }

//    /**
//     * @var Book[]
//     * @ORM\ManyToMany(targetEntity="App\Entity\Book\Book", mappedBy="authors")
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
        $this->__constructBooks();
//        $this->contributedBooks = [];
    }
}
