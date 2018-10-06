<?php

namespace App\Entity\Book;

use App\Entity\Book\BookCategory;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookLocationRepository")
 */
class BookLocation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $floor;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BookCategory", mappedBy="bookLocation")
     */
    private $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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
