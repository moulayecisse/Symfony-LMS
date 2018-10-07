<?php

namespace App\Entity\Book;

use App\Entity\File\ImageFile;
use App\Traits\Entity\BookModel\BookAuthorTrait;
use App\Traits\Entity\BookModel\BookCategoryTrait;
use App\Traits\Entity\BookModel\BooksTrait;
use App\Traits\Entity\BookModel\EBookTrait;
use App\Traits\Entity\BookModel\ImageFileTrait;
use Cisse\Traits\Entity\IdTrait;
use Cisse\Traits\Entity\IsbnTrait;
use Cisse\Traits\Entity\PageNumberTrait;
use Cisse\Traits\Entity\ResumeTrait;
use Cisse\Traits\Entity\SlugTrait;
use Cisse\Traits\Entity\TitleTrait;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\MappedSuperclass
 * @ORM\InheritanceType("NONE")
 * @ORM\Entity(repositoryClass="App\Repository\BookModelRepository")
 */
class BookModel
{
    use IdTrait;
    use IsbnTrait;
    use TitleTrait;
    use SlugTrait;
    use ResumeTrait;
    use PageNumberTrait;

    use ImageFileTrait;
    use BookAuthorTrait;
    use EBookTrait;
    use BookCategoryTrait;

    use BooksTrait { BooksTrait::__construct as __constructBooks; }

    public function __construct()
    {
        $this->__constructBooks();
    }
}
