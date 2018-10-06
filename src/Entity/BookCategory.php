<?php

namespace App\Entity;

use App\Traits\Entity\BookCategory\BookLocationTrait;
use App\Traits\Entity\BookCategory\BooksTrait;
use App\Traits\Entity\BookCategory\ChildrenTrait;
use App\Traits\Entity\BookCategory\ParentTrait;
use Cisse\Traits\Entity\IdTrait;
use Cisse\Traits\Entity\NameTrait;
use Cisse\Traits\Entity\SlugTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookCategoryRepository")
 */
class BookCategory
{
    use IdTrait;
    use NameTrait;
    use SlugTrait;
    use ParentTrait;
    use ChildrenTrait  { ChildrenTrait::__construct as private __childrenTrait; }
    use BooksTrait  { BooksTrait::__construct as private __booksTrait; }
    use BookLocationTrait;

    public function __construct()
    {
        $this->__booksTrait();
        $this->__childrenTrait();
    }
}
