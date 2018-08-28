<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50.
 */

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Image;
use App\Service\Source\Firebase\Firebase;
use Behat\Transliterator\Transliterator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class BookFixtures extends Fixture implements OrderedFixtureInterface
{
    public const BOOKS_REFERENCE = 'books';
    public const BOOKS_COUNT_REFERENCE = 100;

    /**
     * @var Firebase
     */
    private $firebase;

    public function __construct(Firebase $firebase)
    {
        $this->firebase = $firebase;
    }

    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $fakerFactory = Factory::create('fr_FR');
        $authors = [];
        $firebaseBooks = $this->firebase->getBooks();

        $offset = mt_rand(0, count($firebaseBooks) - self::BOOKS_COUNT_REFERENCE);

        for ($i = $offset; $i < AuthorFixtures::AUTHORS_COUNT_REFERENCE; ++$i) {
            $authors[] = $this->getReference(AuthorFixtures::AUTHORS_REFERENCE.$i);
        }

        for ($i = 0; $i < self::BOOKS_COUNT_REFERENCE && $authors >= 3; ++$i) {
            $book = new Book();
            $image = new Image();

            /**
             * @var \App\Service\Source\Entity\Book
             */
            $firebaseBook = $firebaseBooks[$i];

            $image->setPath($firebaseBook->getImage());
            $image->setIsLocal(false);

            /*
             * @var Author
             */
            $book->setAuthor($this->getReference(AuthorFixtures::AUTHORS_REFERENCE.rand(0, AuthorFixtures::AUTHORS_COUNT_REFERENCE - 1)));
            $authorCounts = rand(0, 3);
//            $book->addAuthor($this->getReference(AuthorFixtures::AUTHORS_REFERENCE.rand(0, AuthorFixtures::AUTHORS_COUNT_REFERENCE - 1)));
//            $book->setAuthors($this->pickAuthors($authors));
            $book->setSubCategory($this->getReference(SubCategoryFixtures::SUB_CATEGORIES_REFERENCE.rand(0, SubCategoryFixtures::SUB_CATEGORIES_COUNT_REFERENCE - 1)));
            $book->setIsbn($firebaseBook->getIsbn());
            $book->setPageNumber(rand(100, 200));
            $book->setResume($fakerFactory->text($maxNbChars = 200));
            $book->setTitle($firebaseBook->getTitle());
            $book->setSlug(Transliterator::transliterate($book->getTitle()));
            $book->setImage($image);

            $manager->persist($book);

            $this->addReference(self::BOOKS_REFERENCE.$i, $book);
        }

        $manager->flush();
    }

//    private function pickAuthors($authors = [], $number = 3)
//    {
//        $pickedAuthors = [];
//        for ($i = 0; $i < count($authors); ++$i) {
//            $index = mt_rand(0, count($authors));
//            $pickedAuthors[] = $authors[$index];
//
//            $authors = array_slice($authors, $index, 0);
//        }
//
//        return $pickedAuthors;
//    }

    /**
     * Get the order of this fixture.
     *
     * @return int
     */
    public function getOrder()
    {
        return 5;
    }
}
