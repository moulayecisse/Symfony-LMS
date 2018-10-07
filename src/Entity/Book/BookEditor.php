<?php

namespace App\Entity\Book;

use Cisse\Traits\Entity\IdTrait;
use Cisse\Traits\Entity\NameTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookEditorRepository")
 */
class BookEditor
{
    use IdTrait;
    use NameTrait;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $address;

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }
}
