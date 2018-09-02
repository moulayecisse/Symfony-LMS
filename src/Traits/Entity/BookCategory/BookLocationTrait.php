<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\BookCategory;

use App\Entity\BookCategory;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait BookLocationTrait
 *
 * @package App\Traits\Entity
 */
trait BookLocationTrait
{
    /**
     * Name.
     *
     * @var BookCategory
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\BookLocation", inversedBy="categories")
     */
    private $location;

    /**
     * Get BookLocation.
     *
     * @return BookCategory
     */
    public function getLocation() : BookCategory
    {
        return $this->location;
    }

    /**
     * Set BookLocation.
     *
     * @param BookCategory $location Content
     *
     * @return self
     */
    public function setLocation(BookCategory $location): self
    {
        $this->location = $location;

        return $this;
    }
}
