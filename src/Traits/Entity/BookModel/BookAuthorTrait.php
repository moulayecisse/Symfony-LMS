<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\BookModel;

use App\Entity\Book\BookAuthor;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Trait BookAuthorTrait
 *
 * @package App\Traits\Entity
 */
trait BookAuthorTrait
{
    /**
     * @Groups( { "details", "draft" } )
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Book\BookAuthor", inversedBy="books")
     */
    private $bookAuthor;

    /**
     * Get Model.
     *
     * @return BookAuthor
     */
    public function getBookAuthor() : BookAuthor
    {
        return $this->bookAuthor;
    }

    /**
     * Set Model.
     *
     * @param BookAuthor $bookAuthor
     *
     * @return self
     */
    public function setBookAuthor(BookAuthor $bookAuthor): self
    {
        $this->bookAuthor = $bookAuthor;

        return $this;
    }
}
