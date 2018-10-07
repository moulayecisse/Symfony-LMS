<?php

namespace App\Entity\File;

use App\Entity\File\File;
use App\Traits\Entity\ImageFile\BookTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass()
 * @ORM\Entity(repositoryClass="App\Repository\ImageFileRepository")
 */
class ImageFile extends File
{
    use BookTrait;
}
