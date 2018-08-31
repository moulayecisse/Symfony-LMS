<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50
 */

namespace App\DataFixtures;

use App\Entity\BookBooking;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ReservationFixtures extends Fixture implements OrderedFixtureInterface
{
    public const RESERVATIONS_REFERENCE = 'reservations';
    public const RESERVATIONS_COUNT_REFERENCE = 10;

    public function __construct()
    {
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $start = new DateTime('2017-01-01');
//        $todayDate = new DateTime('now');
        $end = new DateTime('2018-01-01');
//        $interval = DateInterval::createFromDateString('1 day');
//        $period = new DatePeriod($startDate, $interval, $todayDate);

        $i = 0;
        $pbooks = [];
        while ($this->hasReference(PBookFixtures::PBOOKS_REFERENCE . $i)) {
            if ($this->hasReference(PBookFixtures::PBOOKS_REFERENCE . $i)) {
                $pbooks[] = $this->getReference(PBookFixtures::PBOOKS_REFERENCE . $i++);
            }
        }

        for ($i = 0; $i < self::RESERVATIONS_COUNT_REFERENCE; $i++) {
            $reservation = new BookBooking();
            $date = $this->randomDate($start, $end);
//            $date = $date;

            $reservation->setPBook($pbooks[rand(0, count($pbooks) - 1) ]);
            $reservation->setMember($this->getReference(MemberFixtures::MEMBERS_REFERENCE . rand(0, MemberFixtures::MEMBERS_COUNT_REFERENCE - 1)));
            $reservation->setDate($date);

            $manager->persist($reservation);

            $this->addReference(self::RESERVATIONS_REFERENCE . $i, $reservation);
        }

        $manager->flush();
    }

    /**
     * Method to generate random date between two dates
     *
     * @param DateTime $startDate
     * @param DateTime $endDate
     *
     * @return DateTime
     */
    public function randomDate($startDate, $endDate)
    {
        $timestamp = mt_rand($startDate->getTimestamp(), $endDate->getTimestamp());

        $randomDate = new DateTime();
        $randomDate->setTimestamp($timestamp);

        return $randomDate;
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 9;
    }
}
