<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50
 */

namespace App\DataFixtures;

use App\Entity\EBook;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class EBookFixtures extends Fixture implements OrderedFixtureInterface
{
    public const EBOOKS_REFERENCE = 'ebooks';

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
        $k = 0;
        for ($i = 0; $i < BookFixtures::BOOKS_COUNT_REFERENCE; $i++) {
            if (2 !== rand(0, 5)) {
                $ebook = new EBook();

                $ebook->setBook($this->getReference(BookFixtures::BOOKS_REFERENCE . $i));

                $manager->persist($ebook);

                $this->addReference(self::EBOOKS_REFERENCE . $k++, $ebook);
            }
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
        return 6;
    }
}
