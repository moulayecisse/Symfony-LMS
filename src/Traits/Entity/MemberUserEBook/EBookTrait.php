<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity\MemberUserEBook;

use App\Entity\Book\EBook;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait BookTrait
 *
 * @package App\Traits\Entity
 */
trait EBookTrait
{
    /**
     * Name.
     *
     * @var EBook
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Book\EBook", inversedBy="memberEBooks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $eBook;

    /**
     * Get Model.
     *
     * @return Null|EBook
     */
    public function getEBook() : ?EBook
    {
        return $this->eBook;
    }

    /**
     * Set Model.
     *
     * @param EBook $eBook
     *
     * @return self
     */
    public function setEBook(EBook $eBook): self
    {
        $this->eBook = $eBook;

        return $this;
    }
}
