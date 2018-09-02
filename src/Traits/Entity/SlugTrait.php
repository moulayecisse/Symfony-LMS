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


Trait SlugTrait
{
    /**
     * Slug
     *
     * @var string
     * @ORM\Column(type="string")
     * @Assert\Type(type="string")
     * @Assert\NotNull()
     */
    private $slug;

    /**
     * Set slug
     *
     * @param  string $slug
     * @return self
     */
    public function setSlug(string $slug) : self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug() : string
    {
        return $this->slug;
    }
}