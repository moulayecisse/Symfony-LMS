<?php

namespace App\Entity\User\Member;

use App\Traits\Entity\MemberUserEBook\EBookTrait;
use App\Traits\Entity\MemberUserEBook\MemberUserTrait;
use Cisse\Traits\Entity\DateTrait;
use Cisse\Traits\Entity\IdTrait;
use Cisse\Traits\Entity\PriceTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MemberUserEBookRepository")
 */
class MemberUserEBook
{
   use IdTrait;
   use DateTrait;
   use PriceTrait;

   use MemberUserTrait;
   use EBookTrait;
}
