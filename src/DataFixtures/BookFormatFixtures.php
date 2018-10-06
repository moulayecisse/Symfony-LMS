<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50
 */

namespace App\DataFixtures;

use App\Entity\Book\BookFormat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class BookFormatFixtures extends Fixture implements OrderedFixtureInterface
{
    public const FORMATS_REFERENCE = 'formats';

    private const FORMATS = [
        "Livre",
        "Livre poche",
        "Livre broché",
        "Revue, journal",
        "beau-livre",
        "Livre + CD",
        "Livre + DVD",
        "Bande dessinée",
        "Luxe",
        "CD audio",
    ];

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
        $i = 0;

        foreach (self::FORMATS as $formatName) {
            $format = new BookFormat();

            $format->setName($formatName);

            $manager->persist($format);

            $this->addReference(self::FORMATS_REFERENCE . $i++, $format);
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
        return -1;
    }
}
