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


Trait RolesTrait
{
    /**
     * Name
     *
     * @var array
     *
     * @ORM\Column(type="json_array")
     */
    protected $roles;

    function __construct()
    {
        $this->roles = [];
    }

    /**
     * Set roles
     *
     * @param  array $roles
     * @return self
     */
    public function setRoles(array $roles) : self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return String[]
     */
    public function getRoles() : array
    {
        return $this->roles ?? [];
    }
}