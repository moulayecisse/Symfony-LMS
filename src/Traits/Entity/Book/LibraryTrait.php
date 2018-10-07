<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\Book;

use App\Entity\Library\Library;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait LibraryTrait
 *
 * @package App\Traits\Entity
 */
trait LibraryTrait
{
    /**
     * Name.
     *
     * @var Library
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Library", inversedBy="books")
     */
    private $library;

    /**
     * Get Library.
     *
     * @return Library
     */
    public function getLibrary() : Library
    {
        return $this->library;
    }

    /**
     * Set Library.
     *
     * @param Library $library Content
     *
     * @return self
     */
    public function setLibrary(Library $library): self
    {
        $this->library = $library;

        return $this;
    }
}
