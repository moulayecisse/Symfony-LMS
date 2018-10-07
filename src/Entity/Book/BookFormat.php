<?php

namespace App\Entity\Book;

use Cisse\Traits\Entity\IdTrait;
use Cisse\Traits\Entity\NameTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookFormatRepository")
 */
class BookFormat
{
    use IdTrait;
    use NameTrait;
}
