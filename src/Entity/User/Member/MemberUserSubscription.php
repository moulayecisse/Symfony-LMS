<?php

namespace App\Entity\User\Member;

use App\Entity\User\MemberUser;
use App\Traits\Entity\MemberUserSubscription\MemberUserTrait;
use Cisse\Traits\Entity\EndDateTimeTrait;
use Cisse\Traits\Entity\IdTrait;
use Cisse\Traits\Entity\StartDateTimeTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MemberUserSubscriptionRepository")
 */
class MemberUserSubscription
{
    use IdTrait;
    use StartDateTimeTrait;
    use EndDateTimeTrait;

    use MemberUserTrait;
}
