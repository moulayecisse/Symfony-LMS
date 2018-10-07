<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50
 */

namespace App\DataFixtures;

use App\Entity\User\LibrarianUser;
use App\Mailer\Mailer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LibrarianUserFixtures extends Fixture implements OrderedFixtureInterface
{
    public const LIBRARIANS_REFERENCE = 'librarian';
    public const LIBRARIANS_COUNT_REFERENCE = 10;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;
    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * LibrarianUserFixtures constructor.
     *
     * @param UserPasswordEncoderInterface $encoder
     * @param Mailer                       $mailer
     */
    public function __construct(UserPasswordEncoderInterface $encoder, Mailer $mailer)
    {
        $this->encoder = $encoder;
        $this->mailer = $mailer;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $fakerFactory = Factory::create('fr_FR');

        $i = 0;
        $libraries = [];
        while ($this->hasReference(LibraryFixtures::LIBRARIES_REFERENCE . $i)) {
            if ($this->hasReference(LibraryFixtures::LIBRARIES_REFERENCE . $i)) {
                $libraries[] = $this->getReference(LibraryFixtures::LIBRARIES_REFERENCE . $i++);
            }
        }

        for ($i = 0; $i < self::LIBRARIANS_COUNT_REFERENCE; $i++) {
            $librarian = new LibrarianUser();

            $librarian->setFirstName($fakerFactory->firstName);
            $librarian->setLastName($fakerFactory->lastName);
            $librarian->setEmail($fakerFactory->email);
            $encoded = $this->encoder->encodePassword($librarian, '123456789');
            $librarian->setPassword($encoded);
            $librarian->setLibrary($libraries[rand(0, count($libraries) - 1) ]);

            $manager->persist($librarian);

//            $this->mailer->sendConfirmationEmail($librarian);

            $this->addReference(self::LIBRARIANS_REFERENCE . $i, $librarian);
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
        return 11;
    }
}
