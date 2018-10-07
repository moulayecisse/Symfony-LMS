<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\Library;

use App\Entity\User\LibrarianUser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait LibrariansTrait
 *
 * @package App\Traits\Entity
 */
trait LibrarianUsersTrait
{
    /**
     * Name.
     *
     * @var Collection|LibrarianUser[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\User\LibrarianUser", mappedBy="library")
     */
    private $librarians;

    /**
     * LibrariansTrait constructor.
     */
    public function __construct()
    {
        $this->librarians = new ArrayCollection();
    }

    /**
     * Get Librarians.
     *
     * @return Collection|\App\Entity\Librarian\Librarian[]
     */
    public function getLibrarians() : Collection
    {
        return $this->librarians;
    }

    /**
     * Set Librarians.
     *
     * @param Collection|\App\Entity\Librarian\Librarian[] $librarians
     *
     * @return self
     */
    public function setLibrarians(Collection $librarians): self
    {
        $this->librarians = $librarians;

        return $this;
    }

    /**
     * Add a Librarian to Librarians.
     *
     * @param \App\Entity\Librarian\Librarian $librarian add new Librarian
     *
     * @return self
     */
    public function addLibrarian(Librarian $librarian): self
    {
        if (!$this->librarians->contains($librarian)) {
            $this->librarians[] = $librarian;
            $librarian->setAuthor($this);
        }

        return $this;
    }

    /**
     * Remove a Librarian to Librarians.
     *
     * @param \App\Entity\Librarian\Librarian $librarian Librarian librarian to remove
     *
     * @return self
     */
    public function removeLibrarian(Librarian $librarian): self
    {
        if ($this->librarians->contains($librarian)) {
            $this->librarians->removeElement($librarian);
            if ($librarian->getAuthor() === $this) {
                $librarian->setAuthor(null);
            }
        }

        return $this;
    }
}
