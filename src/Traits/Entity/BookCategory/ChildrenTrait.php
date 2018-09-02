<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\BookCategory;

use App\Entity\BookCategory;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait ChildrenTrait
 *
 * @package App\Traits\Entity
 */
trait ChildrenTrait
{
    /**
     * Name.
     *
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\BookCategory", mappedBy="parent")
     */
    private $children;

    /**
     * ChildrenTrait constructor.
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    /**
     * Get Children.
     *
     * @return Collection|BookCategory[]
     */
    public function getChildren() : Collection
    {
        return $this->children;
    }

    /**
     * Set Children.
     *
     * @param Collection|BookCategory[] $Children Content
     *
     * @return self
     */
    public function setChildren(Collection $Children): self
    {
        $this->children = $Children;

        return $this;
    }

    /**
     * Add a BookCategory to Children.
     *
     * @param BookCategory $child new BookCategory child
     *
     * @return self
     */
    public function addChild(BookCategory $child): self
    {
        if (!$this->children->contains($child)) {
            $this->children[] = $child;
            $child->setParent($this);
        }

        return $this;
    }

    /**
     * Remove a BookCategory to Children.
     *
     * @param BookCategory $child BookCategory child to remove
     *
     * @return self
     */
    public function removeChild(BookCategory $child): self
    {
        if ($this->children->contains($child)) {
            $this->children->removeElement($child);
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }

        return $this;
    }
}
