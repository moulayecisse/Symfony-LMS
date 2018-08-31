<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass()
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class ImageFile extends File
{
    /**
     * @ORM\OneToOne(targetEntity="BookModel.php", inversedBy="image")
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
