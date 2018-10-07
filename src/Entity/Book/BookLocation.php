<?php

namespace App\Entity\Book;

use App\Entity\Book\BookCategory;
use App\Traits\Entity\BookLocation\BookCategoriesTrait;
use Cisse\Traits\Entity\FloorTrait;
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
    use FloorTrait;

    use BookCategoriesTrait { BookCategoriesTrait::__construct as private __constructBookCategories; }

    /**
     * BookLocation constructor.
     */
    public function __construct()
    {
        $this->__constructBookCategories();
    }
}
