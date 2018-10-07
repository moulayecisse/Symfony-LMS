<?php

namespace App\Entity\Book;

use App\Entity\Book\BookCategory;
use Cisse\Traits\Entity\IdTrait;
use Cisse\Traits\Entity\NameTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookLocationRepository")
 */
class BookLocation
{
    use IdTrait;
    use NameTrait;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $floor;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Book\BookCategory", mappedBy="bookLocation")
     */
    private $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    public function setFloor(?int $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    /**
     * @return Collection|BookCategory[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addSubCategory(BookCategory $subCategory): self
    {
        if (!$this->categories->contains($subCategory)) {
            $this->categories[] = $subCategory;
            $subCategory->setBookLocation($this);
        }

        return $this;
    }

    public function removeSubCategory(BookCategory $subCategory): self
    {
        if ($this->categories->contains($subCategory)) {
            $this->categories->removeElement($subCategory);
            // set the owning side to null (unless already changed)
            if ($subCategory->getBookLocation() === $this) {
                $subCategory->setBookLocation(null);
            }
        }

        return $this;
    }
}
