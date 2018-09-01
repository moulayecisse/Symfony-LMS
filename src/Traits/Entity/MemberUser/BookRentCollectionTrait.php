<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity;

use App\Entity\BookRent;
use App\Entity\MemberUser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait BookRentCollectionTrait
{
    /**
     * Name.
     *
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\BookRent", mappedBy="memberUser")
     */
    private $bookRentCollection;

    /**
     * BookRentCollectionTrait constructor.
     */
    public function __construct()
    {
        $this->bookRentCollection = new ArrayCollection();
    }

    /**
     * Get BookRentCollection.
     *
     * @return Collection|BookRent[]
     */
    public function getBookRentCollection() : Collection
    {
        return $this->bookRentCollection;
    }

    /**
     * Set BookRentCollection.
     *
     * @param Collection|BookRent[] $bookRentCollection Content
     *
     * @return self
     */
    public function setBookRentCollection(Collection $bookRentCollection): self
    {
        $this->bookRentCollection = $bookRentCollection;

        return $this;
    }

    /**
     * Add a BookRent to BookRentCollection.
     *
     * @param BookRent $bookRent new BookRent
     *
     * @return self
     */
    public function addBookRent(BookRent $bookRent): self
    {
        if (!$this->bookRentCollection->contains($bookRent)) {
            $this->bookRentCollection[] = $bookRent;
            $bookRent->setMemberUser($this);
        }

        return $this;
    }

    /**
     * Remove a BookRent to BookRentCollection.
     *
     * @param BookRent $bookRent BookRent to remove
     *
     * @return self
     */
    public function removeBookRent(BookRent $bookRent): self
    {
        if ($this->bookRentCollection->contains($bookRent)) {
            $this->bookRentCollection->removeElement($bookRent);
            if ($bookRent->getMemberUser() === $this) {
                $bookRent->setMemberUser(null);
            }
        }

        return $this;
    }
}
