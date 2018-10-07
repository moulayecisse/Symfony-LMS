<?php

namespace App\Entity\Book;

use Cisse\Traits\Entity\AddressTrait;
use Cisse\Traits\Entity\IdTrait;
use Cisse\Traits\Entity\NameTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookEditorRepository")
 */
class BookEditor
{
    use IdTrait;
    use NameTrait;
    use AddressTrait;
}
