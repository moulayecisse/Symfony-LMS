<?php

namespace App\Entity\Book;

use App\Entity\Book\Book;
use App\Entity\Book\BookAuthor;
use App\Entity\File\ImageFile;
use Cisse\Traits\Entity\IdTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\MappedSuperclass
 * @ORM\InheritanceType("NONE")
 * @ORM\Entity(repositoryClass="App\Repository\BookModelRepository")
 */
class BookModel
{
    use IdTrait;

    /**
     * @Groups( { "details", "draft" } )
     *
     * @ORM\Column(type="string", length=255)
     */
    private $isbn;

    /**
     * @Groups( { "details", "draft" } )
     *
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @Groups( { "details", "draft" } )
     *
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @Groups( { "details", "draft" } )
     *
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $resume;

    /**
     * @Groups( { "details", "draft" } )
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pageNumber;

    /**
     * @MaxDepth(2)
     *
     * @Groups( { "details", "draft" } )
     *
     * @ORM\OneToOne(
     *     targetEntity="App\Entity\ImageFile",
     *     mappedBy="book",
     *     cascade={"persist", "remove"}
     *     )
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    private $image;

    /**
     * @Groups( { "details", "draft" } )
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\BookAuthor", inversedBy="books")
     */
    private $bookAuthor;

    /**
     * @MaxDepth(2)
     *
     * @Groups( { "details", "draft" } )
     *
     * @ORM\OneToOne(targetEntity="EBook", mappedBy="bookModel", cascade={"remove"})
     */
    private $eBook;

    /**
     * @MaxDepth(2)
     *
     * @Groups( { "details", "draft" } )
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\BookCategory", inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bookCategory;

    /**
     * @MaxDepth(2)
     *
     * @Groups( { "details", "draft" } )
     *
     * @ORM\OneToMany(targetEntity="Book", mappedBy="bookModel", cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $books;

    public function getId()
    {
        return $this->id;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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
     * @return Book
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(?string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getPageNumber(): ?int
    {
        return $this->pageNumber;
    }

    public function setPageNumber(?int $pageNumber): self
    {
        $this->pageNumber = $pageNumber;

        return $this;
    }

    /**
     * @return \App\Entity\File\ImageFile
     */
    public function getImage(): ImageFile
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getBookAuthor(): ?BookAuthor
    {
        return $this->bookAuthor;
    }

    public function setBookAuthor(?BookAuthor $bookAuthor): self
    {
        $this->bookAuthor = $bookAuthor;

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
     * @return Book
     */
    public function setBooks($books)
    {
        $this->books = $books;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEBook()
    {
        return $this->eBook;
    }

    /**
     * @param mixed $eBook
     *
     * @return Book
     */
    public function setEBook($eBook)
    {
        $this->eBook = $eBook;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBookCategory()
    {
        return $this->bookCategory;
    }

    /**
     * @param mixed $bookCategory
     *
     * @return Book
     */
    public function setBookCategory($bookCategory)
    {
        $this->bookCategory = $bookCategory;

        return $this;
    }
}
