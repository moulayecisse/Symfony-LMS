<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 26/08/2018
 * Time: 20:55
 */

namespace App\Entity;

use App\Traits\Entity\EmailTrait;
use App\Traits\Entity\FirstNameTrait;
use App\Traits\Entity\IdTrait;
use App\Traits\Entity\LastNameTrait;
use App\Traits\Entity\PasswordTrait;
use App\Traits\Entity\RolesTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 *
 * @package App\Entity
 *
 * @ORM\MappedSuperclass()
 * @ORM\Entity( repositoryClass="App\Repository\UserRepository" )
 * @ORM\DiscriminatorColumn(name="user_type", type="string")
 * @ORM\DiscriminatorColumn(name="user_type", type="string")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorMap(
 *     {
 *          "user" = "User",
 *          "member" = "MemberUser",
 *          "liberian" = "LibrarianUser",
 *          "admin" = "AdminUser",
 *          "super_admin" = "SuperAdminUser",
 *      }
 * )
 *
 */
class User implements UserInterface
{
    const ROLE_MEMBER = 'ROLE_MEMBER';
    const ROLE_LIBRARIAN = 'ROLE_LIBRARIAN';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';

    use IdTrait;
    use FirstNameTrait;
    use LastNameTrait;
    use EmailTrait;
    use PasswordTrait;
    use RolesTrait { RolesTrait::__construct as private __constructRoles; }

    public function __construct()
    {
        $this->__constructRoles();
    }

    /**
     * @return null|string
     */
    public function getSalt()
    {
        return null;
    }

    public function getType()
    {
        return 'user';
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername() : string
    {
        return $this->email;
    }
}