<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\BookModel;

use App\Entity\Book\EBook;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * Trait EBookTrait
 *
 * @package App\Traits\Entity
 */
trait EBookTrait
{
    /**
     * @MaxDepth(2)
     *
     * @Groups( { "details", "draft" } )
     *
     * @ORM\OneToOne(targetEntity="EBook", mappedBy="bookModel", cascade={"remove"})
     */
    private $eBook;

    /**
     * Get Model.
     *
     * @return EBook
     */
    public function getEBook() : EBook
    {
        return $this->eBook;
    }

    /**
     * Set Model.
     *
     * @param EBook $eBook
     *
     * @return self
     */
    public function setEBook(EBook $eBook): self
    {
        $this->eBook = $eBook;

        return $this;
    }
}
