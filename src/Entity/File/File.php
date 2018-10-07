<?php

namespace App\Entity\File;

use Cisse\Traits\Entity\ExtensionTrait;
use Cisse\Traits\Entity\IdTrait;
use Cisse\Traits\Entity\IsLocalTrait;
use Cisse\Traits\Entity\NameTrait;
use Cisse\Traits\Entity\PathTrait;
use Doctrine\ORM\Mapping as ORM;

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
    use ExtensionTrait;
    use IsLocalTrait;
    use PathTrait;
}
