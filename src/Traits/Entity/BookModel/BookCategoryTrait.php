<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\BookModel;

use App\Entity\Book\BookCategory;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * Trait BookCategoryTrait
 *
 * @package App\Traits\Entity
 */
trait BookCategoryTrait
{
    /**
     * @MaxDepth(2)
     *
     * @Groups( { "details", "draft" } )
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Book\BookCategory", inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bookCategory;

    /**
     * Get Model.
     *
     * @return BookCategory
     */
    public function getBookCategory() : BookCategory
    {
        return $this->bookCategory;
    }

    /**
     * Set Model.
     *
     * @param BookCategory $bookCategory
     *
     * @return self
     */
    public function setBookCategory(BookCategory $bookCategory): self
    {
        $this->bookCategory = $bookCategory;

        return $this;
    }
}
