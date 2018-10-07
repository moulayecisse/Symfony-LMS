<?php

namespace App\Entity\User;

use App\Entity\User\User;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\MappedSuperclass()
 *
 * @ORM\Entity(repositoryClass="App\Repository\SuperAdminUserRepository")
 */
class SuperAdminUser extends User
{
    public function __construct()
    {
        parent::__construct();

        $this->setRoles([self::ROLE_SUPER_ADMIN]);
    }
}
