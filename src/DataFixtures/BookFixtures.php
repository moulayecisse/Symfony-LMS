<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50.
 */

namespace App\DataFixtures;

use App\Entity\Book\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class BookFixtures extends Fixture implements OrderedFixtureInterface
{
    public const PBOOKS_REFERENCE = 'pbooks';

    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $status = Book::STATUS;

        $j = 0;
        for ($i = 0; $i < BookModelFixtures::BOOK_MODELS_COUNT_REFERENCE; ++$i) {
            for ($k = 0; $k < LibraryFixtures::LIBRARIES_COUNT_REFERENCE; ++$k) {
                if (2 !== rand(0, 5)) {
                    $pBookCount = mt_rand(0, 5);

                    for ($m = 0; $m < $pBookCount; ++$m) {
                        $pBook = new Book();

                        $pBook->setBookModel($this->getReference(BookModelFixtures::BOOK_MODELS_REFERENCE.$i));
                        $pBook->setLibrary($this->getReference(LibraryFixtures::LIBRARIES_REFERENCE.$k));
//                        $pBook->setStatus([Book::STATUS_INSIDE => 1]);

                        $manager->persist($pBook);

                        $this->addReference(self::PBOOKS_REFERENCE.$j++, $pBook);
                    }
                }
            }
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
        return 8;
    }
}
