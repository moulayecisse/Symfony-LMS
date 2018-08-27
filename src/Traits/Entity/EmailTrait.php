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


Trait EmailTrait
{
    /**
     * Name
     *
     * @var string
     *
     * @ORM\Column(type="string", length=254, unique=true)
     *
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * Set email
     *
     * @param  string $email
     * @return self
     */
    public function setEmail(string $email) : self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }
}