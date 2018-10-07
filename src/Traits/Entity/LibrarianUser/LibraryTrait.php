<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\LibrarianUser;

use App\Entity\Library\Library;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait BookTrait
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Library\Library", inversedBy="librarians")
     * @ORM\JoinColumn(nullable=true)
     */
    private $library;

    /**
     * Get Model.
     *
     * @return Null|Library
     */
    public function getLibrary() : ?Library
    {
        return $this->library;
    }

    /**
     * Set Model.
     *
     * @param Library $library
     *
     * @return self
     */
    public function setLibrary(Library $library): self
    {
        $this->library = $library;

        return $this;
    }
}
