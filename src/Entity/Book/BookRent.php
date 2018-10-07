<?php

namespace App\Entity\Book;

use App\Entity\Book\Book;
use App\Entity\Member;
use App\Entity\User\MemberUser;
use App\Traits\Entity\BookBooking\MemberUserTrait;
use App\Traits\Entity\BookRent\BookTrait;
use Cisse\Traits\Entity\EndDateTrait;
use Cisse\Traits\Entity\IdTrait;
use Cisse\Traits\Entity\ReturnDateTrait;
use Cisse\Traits\Entity\StartDateTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRentRepository")
 */
class BookRent
{
    use IdTrait;
    use StartDateTrait;
    use EndDateTrait;
    use ReturnDateTrait;

    use BookTrait;
    use MemberUserTrait;
}
