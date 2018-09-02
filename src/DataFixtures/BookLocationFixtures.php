<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50
 */

namespace App\DataFixtures;

use App\Entity\BookLocation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class BookLocationFixtures extends Fixture implements OrderedFixtureInterface
{
    public const LOCATIONS_REFERENCE = 'locations';
    public const LOCATIONS_COUNT_REFERENCE = 10;

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
        $fakerFactory = Factory::create('fr_FR');
        $locations = [];

        for ($i = 0; $i < self::LOCATIONS_COUNT_REFERENCE; $i++) {
            $location = new BookLocation();

            $location->setName($fakerFactory->name);
            $location->setFloor(rand(1, 3));

            $manager->persist($location);

            $locations[] = $location;

            $this->addReference(self::LOCATIONS_REFERENCE . $i, $location);
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
        return -6;
    }
}
