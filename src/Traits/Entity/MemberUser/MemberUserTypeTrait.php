<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\MemberUser;

use App\Entity\User\Member\MemberUserType;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait MemberUserTypeTrait
 *
 * @package App\Traits\Entity
 */
trait MemberUserTypeTrait
{
    /**
     * Name.
     *
     * @var MemberUserType
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User\Member\MemberUserType", inversedBy="members")
     * @ORM\JoinColumn(nullable=true)
     */
    private $memberUserType;

    /**
     * Get Model.
     *
     * @return MemberUserType
     */
    public function getMemberUserType() : MemberUserType
    {
        return $this->memberUserType;
    }

    /**
     * Set Model.
     *
     * @param MemberUserType $memberUserType Content
     *
     * @return self
     */
    public function setMemberUserType(MemberUserType $memberUserType): self
    {
        $this->memberUserType = $memberUserType;

        return $this;
    }
}
