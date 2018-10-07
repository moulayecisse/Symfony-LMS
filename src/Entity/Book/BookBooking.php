<?php

namespace App\Entity\Book;

use App\Traits\Entity\BookBooking\BookTrait;
use App\Traits\Entity\BookBooking\MemberUserTrait;
use Cisse\Traits\Entity\DateTrait;
use Cisse\Traits\Entity\IdTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookReservationRepository")
 */
class BookBooking
{
    use IdTrait;
    use DateTrait;

    use BookTrait;
    use MemberUserTrait;
}
