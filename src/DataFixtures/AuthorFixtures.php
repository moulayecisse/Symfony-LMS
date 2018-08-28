<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50.
 */

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AuthorFixtures extends Fixture implements OrderedFixtureInterface
{
    public const AUTHORS_REFERENCE = 'authors';
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
            $author = new Author();

            $author->setFirstName($fakerFactory->firstName);
            $author->setLastName($fakerFactory->lastName);
            $author->setBiography($fakerFactory->text($maxNbChars = 200));

            $manager->persist($author);

            $this->addReference(self::AUTHORS_REFERENCE.$i, $author);
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
