<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50.
 */

namespace App\DataFixtures;

use App\Entity\BookAuthor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class BookAuthorFixtures extends Fixture implements OrderedFixtureInterface
{
    public const AUTHORS_REFERENCE = 'book_authors';
    public const AUTHORS_COUNT_REFERENCE = 50;

    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $fakerFactory = Factory::create('fr_FR');

        for ($i = 0; $i < self::AUTHORS_COUNT_REFERENCE; ++$i) {
            $bookAuthor = new BookAuthor();

            $bookAuthor->setFirstName($fakerFactory->firstName);
            $bookAuthor->setLastName($fakerFactory->lastName);
            $bookAuthor->setBiography($fakerFactory->text($maxNbChars = 200));

            $manager->persist($bookAuthor);

            $this->addReference(self::AUTHORS_REFERENCE.$i, $bookAuthor);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture.
     *
     * @return int
     */
    public function getOrder()
    {
        return -5;
    }
}
