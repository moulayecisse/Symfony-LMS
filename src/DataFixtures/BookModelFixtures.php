<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50.
 */

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\BookModel;
use App\Entity\ImageFile;
use Behat\Transliterator\Transliterator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class BookModelFixtures extends Fixture implements OrderedFixtureInterface
{
    public const BOOK_MODELS_REFERENCE = 'book_models';
    public const BOOK_MODELS_COUNT_REFERENCE = 100;

    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $fakerFactory = Factory::create('fr_FR');

        for ($i = 0; $i < self::BOOK_MODELS_COUNT_REFERENCE; ++$i) {
            $bookModel = new BookModel();
            $image = new ImageFile();

            $image->setPath('https://via.placeholder.com/350x150');
            $image->setIsLocal(false);

            /*
             * @var Author
             */
            $bookModel->setBookAuthor($this->getReference(BookAuthorFixtures::AUTHORS_REFERENCE.rand(0, BookAuthorFixtures::AUTHORS_COUNT_REFERENCE - 1)));
            $authorCounts = rand(0, 3);
//            $bookModel->addAuthor($this->getReference(BookAuthorFixtures::AUTHORS_REFERENCE.rand(0, BookAuthorFixtures::AUTHORS_COUNT_REFERENCE - 1)));
//            $bookModel->setAuthors($this->pickAuthors($authors));
            $bookModel->setBookCategory($this->getReference(BookCategoryFixtures::BOOK_CATEGORIES_REFERENCE.rand(0, BookCategoryFixtures::BOOK_CATEGORIES_COUNT_REFERENCE - 1)));
            $bookModel->setIsbn($fakerFactory->isbn13);
            $bookModel->setPageNumber(rand(100, 200));
            $bookModel->setResume($fakerFactory->text($maxNbChars = 200));
            $bookModel->setTitle('Book ' . $i);
            $bookModel->setSlug(Transliterator::transliterate($bookModel->getTitle()));
            $bookModel->setImage($image);

            $manager->persist($bookModel);

            $this->addReference(self::BOOK_MODELS_REFERENCE.$i, $bookModel);
        }

        $manager->flush();
    }

    private function pickAuthors($authors = [], $number = 3)
    {
        $pickedAuthors = [];
        for ($i = 0; $i < count($authors); ++$i) {
            $index = mt_rand(0, count($authors));
            $pickedAuthors[] = $authors[$index];

            $authors = array_slice($authors, $index, 0);
        }

        return $pickedAuthors;
    }

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
