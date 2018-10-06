<?php

namespace App\Entity;

use App\Traits\Entity\Book\BookBookingsTrait;
use App\Traits\Entity\Book\BookModelTrait;
use App\Traits\Entity\Book\BookRentsTrait;
use App\Traits\Entity\Book\BookStatusTrait;
use App\Traits\Entity\Book\LibraryTrait;
use Cisse\Traits\Entity\IdTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    public const STATUS_INSIDE = 'inside';
    public const STATUS_OUTSIDE = 'outside';
    public const STATUS_RESERVED = 'reserved';
    public const STATUS_NOT_AVAILABLE = 'no_available';
    public const STATUS = ['inside', 'outside', 'reserved', 'not_available'];

    use IdTrait;
    use BookModelTrait;
    use BookStatusTrait { BookStatusTrait::__construct as private __bookStatusTraitConstruct; }
    use BookRentsTrait { BookRentsTrait::__construct as private __bookRentsTrait; }
    use BookBookingsTrait { BookBookingsTrait::__construct as private __bookBookingsTrait; }
    use LibraryTrait;

    public function __construct()
    {
        $this->__bookStatusTraitConstruct();
        $this->__bookRentsTrait();
        $this->__bookBookingsTrait();
    }
}
