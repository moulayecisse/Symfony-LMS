<?php

namespace App\Entity\User\Member;

use App\Entity\User\MemberUser;
use App\Traits\Entity\MemberUserTestimonial\MemberUserTrait;
use Cisse\Traits\Entity\IdTrait;
use Cisse\Traits\Entity\MessageTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MemberUserTestimonialRepository")
 */
class MemberUserTestimonial
{
    use IdTrait;
    use MessageTrait;

    use MemberUserTrait;
}
