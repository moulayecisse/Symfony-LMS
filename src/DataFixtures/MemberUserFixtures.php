<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50
 */

namespace App\DataFixtures;

use App\Entity\AdminUser;
use App\Entity\Author;
use App\Entity\LibrarianUser;
use App\Entity\MemberUser;
use App\Entity\MemberUserSubscription;
use App\Entity\MemberUserType;
use App\Entity\MemberUserSubscriptionType;
use App\Entity\SuperAdminUser;
use App\Entity\User;
use DateInterval;
use DatePeriod;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MemberUserFixtures extends Fixture implements OrderedFixtureInterface
{
    public const MEMBERS_REFERENCE = 'member';
    public const MEMBERS_COUNT_REFERENCE = 10;

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
        $fakerFactory = Factory::create('fr_FR');
//        $startDate = new DateTime( '2018-06-06' );
//        $todayDate = new DateTime('now');
//        $interval = DateInterval::createFromDateString('1 day');
//        $period = new DatePeriod($startDate, $interval, $todayDate);

        for ($i = 0; $i < self::MEMBERS_COUNT_REFERENCE; $i++) {
            $member = new MemberUser();

            $member->setFirstName($fakerFactory->firstName);
            $member->setLastName($fakerFactory->lastName);
            $member->setEmail($fakerFactory->email);
            $member->setMemberType($this->getReference(MemberTypeFixtures::MEMBERS_REFERENCE . rand(0, MemberTypeFixtures::MEMBERS_COUNT_REFERENCE - 1)));
            $encoded = $this->encoder->encodePassword($member, '123456789');
            $member->setPassword($encoded);

            $manager->persist($member);

            $this->addReference(self::MEMBERS_REFERENCE . $i, $member);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }
}
