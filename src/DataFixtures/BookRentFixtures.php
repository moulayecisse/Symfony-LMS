<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50
 */

namespace App\DataFixtures;

use App\Entity\BookRent;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class BookRentFixtures extends Fixture implements OrderedFixtureInterface
{
    public const BOOK_RENTS_REFERENCE = 'bookings';
    public const BOOK_RENTS_COUNT_REFERENCE = 10;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::BOOK_RENTS_COUNT_REFERENCE; $i++) {
            $booking = new BookRent();

            $booking->setMemberUser($this->getReference(MemberUserFixtures::MEMBERS_REFERENCE . $i));
            $booking->setBook($this->getReference(BookFixtures::PBOOKS_REFERENCE . $i));
            $booking->setReturnDate(new DateTime());
            $booking->setStartDate(new DateTime());
            $booking->setEndDate(new DateTime());

            $manager->persist($booking);
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
        return 10;
    }
}
