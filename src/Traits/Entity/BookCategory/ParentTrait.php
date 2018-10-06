<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\BookCategory;

use App\Entity\Book\BookCategory;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait ParentTrait
 *
 * @package App\Traits\Entity
 */
trait ParentTrait
{
    /**
     * Name.
     *
     * @var \App\Entity\Book\BookCategory
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\BookCategory", inversedBy="children")
     */
    private $parent;

    /**
     * Get Parent.
     *
     * @return BookCategory
     */
    public function getParent() : BookCategory
    {
        return $this->parent;
    }

    /**
     * Set Parent.
     *
     * @param BookCategory $parent Content
     *
     * @return self
     */
    public function setParent(BookCategory $parent): self
    {
        $this->parent = $parent;

        return $this;
    }
}
