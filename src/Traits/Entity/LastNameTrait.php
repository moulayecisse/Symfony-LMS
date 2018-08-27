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


Trait LastNameTrait
{
    /**
     * Name
     *
     * @var string
     *
     * @ORM\Column(type="string", length=50)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=4, max=50)
     *
     */
    private $lastName;

    /**
     * Set lastName
     *
     * @param  string $lastName
     * @return self
     */
    public function setLastName(string $lastName) : self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName() : string
    {
        return $this->lastName;
    }
}