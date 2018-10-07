<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\Book;

use App\Entity\Book\BookModel;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait BookModelTrait
 *
 * @package App\Traits\Entity
 */
trait BookModelTrait
{
    /**
     * Name.
     *
     * @var \App\Entity\Book\BookModel
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Book\BookModel", inversedBy="books")
     */
    private $bookModel;

    /**
     * Get Model.
     *
     * @return BookModel
     */
    public function getBookModel() : BookModel
    {
        return $this->bookModel;
    }

    /**
     * Set Model.
     *
     * @param \App\Entity\Book\BookModel $bookModel Content
     *
     * @return self
     */
    public function setBookModel(BookModel $bookModel): self
    {
        $this->bookModel = $bookModel;

        return $this;
    }
}
