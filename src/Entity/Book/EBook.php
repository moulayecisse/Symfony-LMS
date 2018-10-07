<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 26/07/18
 * Time: 10:19.
 */

namespace App\Entity\Book;

use App\Entity\Book\Book;
use App\Entity\Book\BookModel;
use App\Entity\User\Member\MemberUserEBook;
use App\Traits\Entity\EBook\BookTrait;
use App\Traits\Entity\EBook\FileTrait;
use Cisse\Traits\Entity\IdTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class EBook.
 *
 *
 * @ORM\Entity( repositoryClass="App\Repository\EBookRepository" )
 */
class EBook /*extends Book*/
{
    use IdTrait;

    use BookTrait;
    use FileTrait;

    /**
     * @var Book
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Book\BookModel")
     */
    private $file;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User\Member\MemberUserEBook", mappedBy="ebook")
     * @ORM\JoinColumn(nullable=false)
     */
    private $memberEBooks;

    public function __construct()
    {
        $this->memberEBooks = new ArrayCollection();
    }

    /**
     * @return Collection|\App\Entity\User\Member\MemberUserEBook[]
     */
    public function getMemberEBooks(): Collection
    {
        return $this->memberEBooks;
    }

    public function addMemberEBook(MemberUserEBook $memberEBook): self
    {
        if (!$this->memberEBooks->contains($memberEBook)) {
            $this->memberEBooks[] = $memberEBook;
            $memberEBook->setEBook($this);
        }

        return $this;
    }

    public function removeMemberEBook(MemberUserEBook $memberEBook): self
    {
        if ($this->memberEBooks->contains($memberEBook)) {
            $this->memberEBooks->removeElement($memberEBook);
            // set the owning side to null (unless already changed)
            if ($memberEBook->getEBook() === $this) {
                $memberEBook->setEBook(null);
            }
        }

        return $this;
    }
}
