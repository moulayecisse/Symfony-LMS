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


Trait FirstNameTrait
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
    private $firstName;

    /**
     * Set firstName
     *
     * @param  string $firstName
     *
     * @return self
     */
    public function setFirstName(string $firstName) : self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName() : string
    {
        return $this->firstName;
    }
}