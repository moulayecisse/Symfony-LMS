<?php

namespace App\Entity\File;

use App\Entity\File\File;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass()
 * @ORM\Entity(repositoryClass="App\Repository\ImageFileRepository")
 */
class ImageFile extends File
{
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Book\BookModel", inversedBy="image")
     * @ORM\Column(nullable=true)
     */
    private $book;

    /**
     * @return mixed
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * @param mixed $book
     *
     * @return ImageFile
     */
    public function setBook($book)
    {
        $this->book = $book;

        return $this;
    }
}
