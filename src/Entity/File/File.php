<?php

namespace App\Entity\File;

use Cisse\Traits\Entity\IdTrait;
use Cisse\Traits\Entity\NameTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FileRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="file_type", type="string")
 * @ORM\DiscriminatorMap({"file" = "File", "image" = "ImageFile"})
 */
class File
{
    use IdTrait;
    use NameTrait;

    /**
     * @Groups( "details" )
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $extension;

    /**
     * @Groups( { "details", "draft" } )
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isLocal;

    /**
     * @Groups( { "details", "draft" } )
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): self
    {
        $this->extension = $extension;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getisLocal()
    {
        return $this->isLocal;
    }

    /**
     * @param mixed $isLocal
     *
     * @return File
     */
    public function setIsLocal($isLocal)
    {
        $this->isLocal = $isLocal;

        return $this;
    }
}
