<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\BookModel;

use App\Entity\File\ImageFile;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * Trait ImageFileTrait
 *
 * @package App\Traits\Entity
 */
trait ImageFileTrait
{
    /**
     * @MaxDepth(2)
     *
     * @Groups( { "details", "draft" } )
     *
     * @ORM\OneToOne(
     *     targetEntity="App\Entity\File\ImageFile",
     *     mappedBy="book",
     *     cascade={"persist", "remove"}
     *     )
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    private $imageFile;

    /**
     * Get Model.
     *
     * @return ImageFile
     */
    public function getImageFile() : ImageFile
    {
        return $this->imageFile;
    }

    /**
     * Set Model.
     *
     * @param ImageFile $imageFile
     *
     * @return self
     */
    public function setImageFile(ImageFile $imageFile): self
    {
        $this->imageFile = $imageFile;

        return $this;
    }
}
