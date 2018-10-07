<?php

namespace App\Entity\Library;

use App\Traits\Entity\Library\BooksTrait;
use App\Traits\Entity\Library\LibrarianUsersTrait;
use Cisse\Traits\Entity\AddressTrait;
use Cisse\Traits\Entity\ClosingTimeTrait;
use Cisse\Traits\Entity\EmailTrait;
use Cisse\Traits\Entity\IdTrait;
use Cisse\Traits\Entity\NameTrait;
use Cisse\Traits\Entity\OpeningTimeTrait;
use Cisse\Traits\Entity\PhoneTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LibraryRepository")
 */
class Library
{
    use IdTrait;
    use NameTrait;
    use EmailTrait;
    use AddressTrait;
    use PhoneTrait;
    use OpeningTimeTrait;
    use ClosingTimeTrait;

    use BooksTrait { BooksTrait::__construct as private __constructBooks; }
    use LibrarianUsersTrait { LibrarianUsersTrait::__construct as private __constructLibrarianUsers; }

    public function __construct()
    {
        $this->__constructBooks();
        $this->__constructLibrarianUsers();
    }
}
