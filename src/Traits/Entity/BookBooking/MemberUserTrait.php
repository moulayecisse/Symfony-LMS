<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\BookBooking;

use App\Entity\Book\Book;
use App\Entity\User\MemberUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait BookTrait
 *
 * @package App\Traits\Entity
 */
trait MemberUserTrait
{
    /**
     * Name.
     *
     * @var MemberUser
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User\MemberUser", inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $memberUser;

    /**
     * Get Model.
     *
     * @return Null|MemberUser
     */
    public function getMemberUser() : ?MemberUser
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
