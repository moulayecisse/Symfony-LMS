<?php

namespace App\Entity\User\Member;

use App\Traits\Entity\MemberUserType\MemberUsersTrait;
use Cisse\Traits\Entity\IdTrait;
use Cisse\Traits\Entity\NameTrait;
use Cisse\Traits\Entity\RateTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MemberUserTypeRepository")
 */
class MemberUserType
{
   use IdTrait;
   use NameTrait;
   use RateTrait;

   use MemberUsersTrait { MemberUsersTrait::__construct as private __constructMemberUsers; }

    public function __construct()
    {
        $this->__constructMemberUsers();
    }
}
