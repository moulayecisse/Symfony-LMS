<?php

namespace App\Entity\User;

use App\Traits\Entity\MemberUser\BookRentsTrait;
use App\Traits\Entity\MemberUser\MemberUserEBooksTrait;
use App\Traits\Entity\MemberUser\MemberUserSubscriptionsTrait;
use App\Traits\Entity\MemberUser\MemberUserTestimonialsTrait;
use App\Traits\Entity\MemberUser\MemberUserTypeTrait;
use Cisse\Traits\Entity\PhoneTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass()
 *
 * @ORM\Entity(repositoryClass="App\Repository\MemberUserRepository")
 */
class MemberUser extends User
{
    use PhoneTrait;
    
    use MemberUserTypeTrait;

    use BookRentsTrait { BookRentsTrait::__construct as private __constructBookRentsTrait; }
    use MemberUserEBooksTrait { MemberUserEBooksTrait::__construct as private __constructMemberUserEBooks; }
    use MemberUserSubscriptionsTrait { MemberUserSubscriptionsTrait::__construct as private __constructMemberUserSubscriptions; }
    use MemberUserTestimonialsTrait { MemberUserTestimonialsTrait::__construct as private __constructMemberUserTestimonials; }

    public function __construct()
    {
        parent::__construct();

        $this->setRoles([self::ROLE_MEMBER]);

        $this->__constructBookRentsTrait();
        $this->__constructMemberUserEBooks();
        $this->__constructMemberUserSubscriptions();
        $this->__constructMemberUserTestimonials();
    }
}
