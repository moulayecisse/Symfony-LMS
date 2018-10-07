<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\BookCategory;

use App\Entity\Book\BookCategory;
use App\Entity\Book\BookLocation;
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
     * @var BookLocation
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Book\BookLocation", inversedBy="categories")
     */
    private $bookLocation;

    /**
     * Get BookLocation.
     *
     * @return BookLocation
     */
    public function getBookLocation() : BookLocation
    {
        return $this->bookLocation;
    }

    /**
     * Set BookLocation.
     *
     * @param BookLocation $bookLocation Content
     *
     * @return self
     */
    public function setBookLocation(BookLocation $bookLocation): self
    {
        $this->bookLocation = $bookLocation;

        return $this;
    }
}
