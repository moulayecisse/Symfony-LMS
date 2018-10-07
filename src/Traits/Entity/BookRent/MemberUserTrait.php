<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\MemberUserRent;

use App\Entity\User\MemberUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait MemberUserTrait
 *
 * @package App\Traits\Entity
 */
trait MemberUserTrait
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User\MemberUser", inversedBy="bookRents")
     */
    private $memberUser;

    /**
     * Get Model.
     *
     * @return MemberUser
     */
    public function getMemberUser() : MemberUser
    {
        return $this->memberUser;
    }

    /**
     * Set Model.
     *
     * @param MemberUser $memberUser
     *
     * @return self
     */
    public function setMemberUser(MemberUser $memberUser): self
    {
        $this->memberUser = $memberUser;

        return $this;
    }
}
