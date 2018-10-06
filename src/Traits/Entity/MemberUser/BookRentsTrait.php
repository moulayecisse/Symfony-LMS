<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\MemberUser;

use App\Entity\Book\BookRent;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

trait BookRentsTrait
{
    /**
     * Name.
     *
     * @var Collection|\App\Entity\Book\BookRent[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\BookRent", mappedBy="memberUser")
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
     * @return Collection|\App\Entity\Book\BookRent[]
     */
    public function getBookRents() : Collection
    {
        return $this->bookRents;
    }

    /**
     * Set BookRents.
     *
     * @param Collection|\App\Entity\Book\BookRent[] $bookRents Content
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
     * @param \App\Entity\Book\BookRent $bookRent new BookRent
     *
     * @return self
     */
    public function addBookRent(BookRent $bookRent): self
    {
        if (!$this->bookRents->contains($bookRent)) {
            $this->bookRents[] = $bookRent;
            $bookRent->setMemberUser($this);
        }

        return $this;
    }

    /**
     * Remove a BookRent to BookRents.
     *
     * @param \App\Entity\Book\BookRent $bookRent BookRent to remove
     *
     * @return self
     */
    public function removeBookRent(BookRent $bookRent): self
    {
        if ($this->bookRents->contains($bookRent)) {
            $this->bookRents->removeElement($bookRent);
            if ($bookRent->getMemberUser() === $this) {
                $bookRent->setMemberUser(null);
            }
        }

        return $this;
    }
}
