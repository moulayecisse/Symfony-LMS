<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50
 */

namespace App\DataFixtures;

use App\Entity\Book\BookCategory;
use App\Entity\Book\BookLocation;
use Behat\Transliterator\Transliterator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class BookCategoryFixtures extends Fixture implements OrderedFixtureInterface
{
    public const BOOK_CATEGORIES_REFERENCE = 'sub_categories';
    public const BOOK_CATEGORIES_COUNT_REFERENCE = 10;
    public const BOOK_CHILDREN_MIN_COUNT_REFERENCE = 0;
    public const BOOK_CHILDREN_MAX_COUNT_REFERENCE = 10;

    public const CATEGORIES = [
        "Romans et Littérature" => [
            "Littérature française",
            "Littérature classique",
            "Littérature anglophone",
            "Polars, thrillers",
            "SF, Fantasy",
            "Romance",
            "Récits de voyage",
            "Romans historiques",
            "Théâtre",
            "Poésie",
            "Anthologies",
            "Humour",
            "VO",
        ],
        "BD et Comics" => [
            "BD classiques",
            "BD indépendantes",
            "BD Jeunesse",
            "Classiques littéraires en BD",
            "Humour",
            "Polar et thriller",
            "Fantastique et SF",
            "Histoire",
            "Biographies en BD",
            "Comics",
            "Mangas, Manwha, Man Hua",
            "Shonen",
            "Seinen, Josei",
        ],
        "Jeunesse" => [
            "Albums illustrés",
            "Livres à écouter",
            "Tout-petits - Moins de 3 ans",
            "De 4 à 6 ans",
            "De 7 à 12 ans",
            "Mondes imaginaires",
            "Romans historiques",
            "Adolescents et jeunes adultes",
            "Documentaires",
            "Arts",
            "Nature et animaux",
            "Histoire",
            "Mythes et légendes",
        ],
        "Loisirs et Bien-être" => [
            "Cuisine",
            "Régimes",
            "Loisirs créatifs",
            "Jardinage",
            "Sport et jeux",
            "Développement personnel",
            "Méditation",
            "Médecines douces",
            "Yoga",
            "Idées de voyages",
            "Guides France",
            "Beaux Livres Monde",
            "Récits de voyage",
            "Randonnée",
        ],
        "Art, Musique et Cinéma" => [
            "Essais sur l'art",
            "Histoire de l'art",
            "Courants artistiques",
            "Art des grandes civilisations",
            "Photographie",
            "Essais sur le cinéma",
            "Histoire du cinéma",
            "Réalisateurs",
            "Acteurs",
            "Musique",
            "Danse",
            "Mode et textiles",
            "Design",
            "Architecture",
        ],
        "Savoir et Société" => [
            "Politique",
            "Histoire",
            "Géographie",
            "Religions",
            "Ésotérisme",
            "Sociologie",
            "Questions de société",
            "Économie",
            "Droit",
            "Philosophie",
            "Psychanalyse",
            "Psychologie",
            "Sciences",
            "Médecine",
        ],
        "Scolaire et Pédagogie" => [
            "École primaire",
            "Collège",
            "Lycée",
            "Technique et professionnel",
            "Exercices et révisions",
            "Littérature scolaire",
            "Pédagogie",
            "Concours",
            "Dictionnaires de français",
            "Méthodes d'anglais",
            "Linguistique",
            "Essais littéraires",
        ]
    ];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::BOOK_CATEGORIES_COUNT_REFERENCE; $i++) {
            $bookCategory = new BookCategory();

            $bookLocationId = rand(0, BookLocationFixtures::LOCATIONS_COUNT_REFERENCE - 1);
            /**
             * @var BookLocation $bookLocation
             */
            $bookLocation = $this->getReference(BookLocationFixtures::LOCATIONS_REFERENCE . $bookLocationId);
            $bookCategory->setBookLocation( $bookLocation );
            $bookCategory->setName('Category ' . $i);
            $bookCategory->setSlug(Transliterator::transliterate($bookCategory->getName()));

            $bookChildrenCount = rand(self::BOOK_CHILDREN_MIN_COUNT_REFERENCE, self::BOOK_CHILDREN_MAX_COUNT_REFERENCE);
            for ( $k = 0; $k < $bookChildrenCount; $k++ ){
                $bookCategoryChild = new BookCategory();

                $bookCategoryChildLocationId = rand(0, BookLocationFixtures::LOCATIONS_COUNT_REFERENCE - 1);
                /**
                 * @var BookLocation $bookCategoryChildLocation
                 */
                $bookCategoryChildLocation = $this->getReference(BookLocationFixtures::LOCATIONS_REFERENCE . $bookCategoryChildLocationId);
                $bookCategoryChild->setBookLocation( $bookCategoryChildLocation );
                $bookCategoryChild->setName('Category Child ' . $k);
                $bookCategoryChild->setSlug(Transliterator::transliterate($bookCategoryChild->getName()));

                $bookCategory->addChild($bookCategoryChild);
            }


            $manager->persist($bookCategory);

            $this->setReference(self::BOOK_CATEGORIES_REFERENCE . $i, $bookCategory);
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
        return 1;
    }
}
