<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\MemberUser;

use App\Entity\User\Member\MemberUserEBook;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

trait MemberUserEBooksTrait
{
    /**
     * Name.
     *
     * @var Collection|MemberUserEBook[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\User\Member\MemberUserEBook", mappedBy="memberUser", orphanRemoval=true)
     */
    private $memberUserEBooks;

    /**
     * MemberUserEBooksTrait constructor.
     */
    public function __construct()
    {
        $this->memberUserEBooks = new ArrayCollection();
    }

    /**
     * Get MemberUserEBooks.
     *
     * @return Collection|MemberUserEBook[]
     */
    public function getMemberUserEBooks() : Collection
    {
        return $this->memberUserEBooks;
    }

    /**
     * Set MemberUserEBooks.
     *
     * @param Collection|MemberUserEBook[] $memberUserEBooks Content
     *
     * @return self
     */
    public function setMemberUserEBooks(Collection $memberUserEBooks): self
    {
        $this->memberUserEBooks = $memberUserEBooks;

        return $this;
    }

    /**
     * Add a MemberUserEBook to MemberUserEBooks.
     *
     * @param MemberUserEBook $memberUserEBook new MemberUserEBook
     *
     * @return self
     */
    public function addMemberUserEBook(MemberUserEBook $memberUserEBook): self
    {
        if (!$this->memberUserEBooks->contains($memberUserEBook)) {
            $this->memberUserEBooks[] = $memberUserEBook;
            $memberUserEBook->setMemberUser($this);
        }

        return $this;
    }

    /**
     * Remove a MemberUserEBook to MemberUserEBooks.
     *
     * @param MemberUserEBook $memberUserEBook MemberUserEBook to remove
     *
     * @return self
     */
    public function removeMemberUserEBook(MemberUserEBook $memberUserEBook): self
    {
        if ($this->memberUserEBooks->contains($memberUserEBook)) {
            $this->memberUserEBooks->removeElement($memberUserEBook);
            if ($memberUserEBook->getMemberUser() === $this) {
                $memberUserEBook->setMemberUser(null);
            }
        }

        return $this;
    }
}
