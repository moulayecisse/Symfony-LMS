<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\EBook;

use App\Entity\Book\BookRent;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

trait MemberEBooksTrait
{
    /**
     * Name.
     *
     * @ORM\OneToMany(targetEntity="App\Entity\User\Member\MemberUserEBook", mappedBy="eBook")
     * @ORM\JoinColumn(nullable=false)
     */
    private $memberEBooks;

    /**
     * MemberEBooksTrait constructor.
     */
    public function __construct()
    {
        $this->memberEBooks = new ArrayCollection();
    }

    /**
     * Get MemberEBooks.
     *
     * @return Collection|\App\Entity\Book\BookRent[]
     */
    public function getMemberEBooks() : Collection
    {
        return $this->memberEBooks;
    }

    /**
     * Set MemberEBooks.
     *
     * @param Collection|\App\Entity\Book\BookRent[] $memberEBooks Content
     *
     * @return self
     */
    public function setMemberEBooks(Collection $memberEBooks): self
    {
        $this->memberEBooks = $memberEBooks;

        return $this;
    }

    /**
     * Add a BookRent to MemberEBooks.
     *
     * @param \App\Entity\Book\BookRent $bookRent new BookRent
     *
     * @return self
     */
    public function addBookRent(BookRent $bookRent): self
    {
        if (!$this->memberEBooks->contains($bookRent)) {
            $this->memberEBooks[] = $bookRent;
            $bookRent->setBook($this);
        }

        return $this;
    }

    /**
     * Remove a BookRent to MemberEBooks.
     *
     * @param \App\Entity\Book\BookRent $bookRent BookRent to remove
     *
     * @return self
     */
    public function removeBookRent(BookRent $bookRent): self
    {
        if ($this->memberEBooks->contains($bookRent)) {
            $this->memberEBooks->removeElement($bookRent);
            if ($bookRent->getBook() === $this) {
                $bookRent->setBook(null);
            }
        }

        return $this;
    }
}
