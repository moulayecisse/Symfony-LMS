<?php

namespace App\Entity\User;

use App\Entity\User\User;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\MappedSuperclass()
 * @ORM\Entity(repositoryClass="App\Repository\LibrarianUserRepository")
 */
class LibrarianUser extends User
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Library\Library", inversedBy="librarians")
     * @ORM\JoinColumn(nullable=true)
     */
    private $library;

    public function __construct()
    {
        $this->setRoles([self::ROLE_LIBRARIAN]);
    }

    /**
     * @return mixed
     */
    public function getLibrary()
    {
        return $this->library;
    }

    /**
     * @param mixed $library
     *
     * @return LibrarianUser
     */
    public function setLibrary($library)
    {
        $this->library = $library;
        return $this;
    }
}
