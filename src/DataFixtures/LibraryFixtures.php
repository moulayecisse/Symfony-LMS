<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50
 */

namespace App\DataFixtures;

use App\Entity\Library\Library;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class LibraryFixtures extends Fixture implements OrderedFixtureInterface
{
    public const LIBRARIES_REFERENCE = 'libraries';
    public const LIBRARIES_COUNT_REFERENCE = 5;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $fakerFactory = Factory::create('fr_FR');

        for ($i = 0; $i < self::LIBRARIES_COUNT_REFERENCE; $i++) {
            $library = new Library();

            $library->setName($fakerFactory->company);
            $library->setEmail($fakerFactory->email);
            $library->setAddress($fakerFactory->address);
            $library->setOpeningDate(DateTime::createFromFormat("H:i:s", "09:30:00"));
            $library->setClosingTime(DateTime::createFromFormat("H:i:s", "19:30:00"));
            $library->setPhone($fakerFactory->phoneNumber);

            $manager->persist($library);

            $this->addReference(self::LIBRARIES_REFERENCE . $i, $library);
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
        return 3;
    }
}
