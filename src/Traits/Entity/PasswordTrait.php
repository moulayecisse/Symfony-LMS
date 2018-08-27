<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03
 */

namespace App\Traits\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


Trait PasswordTrait
{
    /**
     * Name
     *
     * @var string
     *
     * @ORM\Column(type="string", length=254, unique=true)
     *
     * @Assert\NotBlank()
     * @Assert\Password()
     */
    private $password;

    /**
     * Set password
     *
     * @param  string $password
     * @return self
     */
    public function setPassword(string $password) : self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword() : string
    {
        return $this->password;
    }
}