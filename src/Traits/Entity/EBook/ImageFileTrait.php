<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\EBook;

use App\Entity\File\File;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait FileTrait
 *
 * @package App\Traits\Entity
 */
trait FileTrait
{
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Book\BookModel")
     */
    private $File;

    /**
     * Get Model.
     *
     * @return File
     */
    public function getFile() : File
    {
        return $this->File;
    }

    /**
     * Set Model.
     *
     * @param File $File
     *
     * @return self
     */
    public function setFile(File $File): self
    {
        $this->File = $File;

        return $this;
    }
}
