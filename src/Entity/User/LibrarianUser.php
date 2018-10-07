<?php

namespace App\Entity\User;

use App\Entity\User\User;
use App\Traits\Entity\LibrarianUser\LibraryTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\MappedSuperclass()
 * @ORM\Entity(repositoryClass="App\Repository\LibrarianUserRepository")
 */
class LibrarianUser extends User
{
    use LibraryTrait;

    public function __construct()
    {
        parent::__construct();

        $this->setRoles([self::ROLE_LIBRARIAN]);
    }
}
