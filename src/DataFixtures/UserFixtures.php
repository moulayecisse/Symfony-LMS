<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50
 */

namespace App\DataFixtures;

use App\Entity\User\AdminUser;
use App\Entity\User\LibrarianUser;
use App\Entity\User\MemberUser;
use App\Entity\User\SuperAdminUser;
use App\Entity\User\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements OrderedFixtureInterface
{
    public const USER_REFERENCE = 'user';
    public const MEMBER_REFERENCE = 'member';
    public const LIBRARIAN_REFERENCE = 'librarian';
    public const ADMIN_REFERENCE = 'admin';
    public const SUPER_ADMIN_REFERENCE = 'super_admin';

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->setFirstName('Moulaye');
        $user->setLastName('Cissé');
        $user->setEmail('moulaye.c@gmail.com');
        $user->setRoles([User::ROLE_SUPER_ADMIN, User::ROLE_ADMIN, User::ROLE_LIBRARIAN, User::ROLE_MEMBER]);
        $encoded = $this->encoder->encodePassword($user, '123456789');
        $user->setPassword($encoded);

        $manager->persist($user);

        $this->addReference(self::USER_REFERENCE, $user);

        $superAdmin = new SuperAdminUser();

        $superAdmin->setFirstName('SuperAdminUser');
        $superAdmin->setLastName('SuperAdminUser');
        $superAdmin->setEmail('superadmin@superadmin.com');
        $encoded = $this->encoder->encodePassword($superAdmin, '123456789');
        $superAdmin->setPassword($encoded);

        $manager->persist($superAdmin);

        $this->addReference(self::SUPER_ADMIN_REFERENCE, $superAdmin);

        $admin = new AdminUser();

        $admin->setFirstName('AdminUser');
        $admin->setLastName('AdminUser');
        $admin->setEmail('admin@admin.com');
        $encoded = $this->encoder->encodePassword($admin, '123456789');
        $admin->setPassword($encoded);

        $manager->persist($admin);

        $this->addReference(self::ADMIN_REFERENCE, $admin);

        $i = 0;
        $libraries = [];
        while ($this->hasReference(LibraryFixtures::LIBRARIES_REFERENCE . $i)) {
            if ($this->hasReference(LibraryFixtures::LIBRARIES_REFERENCE . $i)) {
                $libraries[] = $this->getReference(LibraryFixtures::LIBRARIES_REFERENCE . $i++);
            }
        }

        $librarian = new LibrarianUser();

        $librarian->setFirstName('LibrarianUser');
        $librarian->setLastName('LibrarianUser');
        $librarian->setEmail('librarian@librarian.com');
        $encoded = $this->encoder->encodePassword($librarian, '123456789');
        $librarian->setLibrary($libraries[rand(0, count($libraries) - 1) ]);
        $librarian->setPassword($encoded);

        $manager->persist($librarian);

        $this->addReference(self::LIBRARIAN_REFERENCE, $librarian);

        $member = new MemberUser();

        $member->setFirstName('Member');
        $member->setLastName('Member');
        $member->setEmail('member@member.com');
        $encoded = $this->encoder->encodePassword($member, '123456789');
        $member->setPassword($encoded);
        $member->setMemberType($this->getReference(MemberTypeFixtures::MEMBERS_REFERENCE . rand(0, MemberTypeFixtures::MEMBERS_COUNT_REFERENCE - 1)));

        $manager->persist($member);

        $this->addReference(self::MEMBER_REFERENCE, $member);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 4;
    }
}
