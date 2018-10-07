<?php

namespace App\Entity\User\Member;

use Cisse\Traits\Entity\DurationTrait;
use Cisse\Traits\Entity\IdTrait;
use Cisse\Traits\Entity\NameTrait;
use Cisse\Traits\Entity\PriceTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MemberSubscriptionTypeRepository")
 */
class MemberUserSubscriptionType
{
    use IdTrait;
    use NameTrait;
    use DurationTrait;
    use PriceTrait;
}
