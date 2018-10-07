<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 26/07/18
 * Time: 10:19.
 */

namespace App\Entity\Book;

use App\Entity\Book\Book;
use App\Entity\Book\BookModel;
use App\Entity\User\Member\MemberUserEBook;
use App\Traits\Entity\EBook\BookTrait;
use App\Traits\Entity\EBook\FileTrait;
use App\Traits\Entity\EBook\MemberEBooksTrait;
use Cisse\Traits\Entity\IdTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class EBook.
 *
 *
 * @ORM\Entity( repositoryClass="App\Repository\EBookRepository" )
 */
class EBook /*extends Book*/
{
    use IdTrait;

    use BookTrait;
    use FileTrait;

    use MemberEBooksTrait { MemberEBooksTrait::__construct as private __constructMemberEBook; }

    public function __construct()
    {
        $this->__constructMemberEBook();
    }
}
