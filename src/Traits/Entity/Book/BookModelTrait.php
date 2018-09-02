<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\Book;

use App\Entity\BookCategory;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @var BookCategory
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\BookModel", inversedBy="books")
     */
    private $model;

    /**
     * Get Model.
     *
     * @return BookCategory
     */
    public function getModel() : BookCategory
    {
        return $this->model;
    }

    /**
     * Set Model.
     *
     * @param BookCategory $model Content
     *
     * @return self
     */
    public function setModel(BookCategory $model): self
    {
        $this->model = $model;

        return $this;
    }
}
