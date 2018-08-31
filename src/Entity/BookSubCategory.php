<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubCategoryRepository")
 */
class BookSubCategory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups( { "category", "draft" } )
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Groups( { "category" } )
     *
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="BookCategory.php", inversedBy="subCategories")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="BookModel.php", mappedBy="subCategory")
     */
    private $books;

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

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     *
     * @return BookSubCategory
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCategory(): ?BookCategory
    {
        return $this->category;
    }

    public function setCategory(?BookCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location", inversedBy="subCategories")
     */
    private $location;

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBooks()
    {
        return $this->books;
    }

    /**
     * @param mixed $books
     *
     * @return BookSubCategory
     */
    public function setBooks($books)
    {
        $this->books = $books;

        return $this;
    }
}
