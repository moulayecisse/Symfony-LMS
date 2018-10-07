<?php

namespace App\Entity\User\Member;

use App\Entity\Book\EBook;
use App\Entity\Member;
use App\Entity\User\MemberUser;
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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User\MemberUser", inversedBy="memberEBooks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $memberUser;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Book\EBook", inversedBy="memberEBooks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $eBook;
}
