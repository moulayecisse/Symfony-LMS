<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 21/08/18
 * Time: 19:19.
 */

namespace App\Service;

use App\Entity\Member;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class APIMemberManagement.
 */
class APIMemberManager
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * APIMemberManager constructor.
     *
     * @param EntityManagerInterface       $manager Entity manager
     * @param UserPasswordEncoderInterface $encoder User password encoder interface
     */
    public function __construct(
        EntityManagerInterface $manager,
        UserPasswordEncoderInterface $encoder
    ) {
        $this->manager = $manager;
        $this->encoder = $encoder;
    }

    /**
     * Subscribe a member from request et return a valid token.
     *
     * @param Request $request http request
     *
     * @return Member
     */
    public function subscribe(
        Request $request
    ): ? Member {
        $object = json_decode($request->getContent(), false);

        $member = null;

        $phone = $object->phone;
        $email = $object->email;
        $firstName = $object->firstName;
        $lastName = $object->lastName;
        $password = $object->password;

        if ($phone && $email && $firstName && $lastName && $password) {
            $member = new Member();

            $member->setFirstName($firstName);
            $member->setLastName($lastName);
            $member->setEmail($email);
            $member->setPhone($phone);
            $encoded = $this->encoder->encodePassword($member, $password);
            $member->setPassword($encoded);

            $this->manager->persist($member);

            $this->manager->flush();
        }

        return $member;
    }
}
