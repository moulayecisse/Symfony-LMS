<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50.
 */

namespace App\DataFixtures;

use App\Entity\MemberTestimonial;
use App\Mailer\Mailer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class TestimonialFixtures.
 */
class TestimonialFixtures extends Fixture implements OrderedFixtureInterface
{
    public const TESTIMONIALS_REFERENCE = 'testimonial';
    public const TESTIMONIALS_COUNT_REFERENCE = 10;

    /**
     * TestimonialFixtures constructor.
     *
     * @param UserPasswordEncoderInterface $encoder
     * @param Mailer                       $mailer
     */
    public function __construct()
    {
    }

    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $fakerFactory = Factory::create('fr_FR');

        $i = 0;
        $members = [];
        while ($this->hasReference(MemberUserFixtures::MEMBERS_REFERENCE.$i)) {
            if ($this->hasReference(MemberUserFixtures::MEMBERS_REFERENCE.$i)) {
                $members[] = $this->getReference(MemberUserFixtures::MEMBERS_REFERENCE.$i++);
            }
        }

        for ($i = 0; $i < self::TESTIMONIALS_COUNT_REFERENCE; ++$i) {
            $testimonial = new MemberTestimonial();

            $testimonial->setMessage($fakerFactory->text(200));
            $testimonial->setMember($members[rand(0, count($members) - 1)]);

            $manager->persist($testimonial);

            $this->addReference(self::TESTIMONIALS_REFERENCE.$i, $testimonial);
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
        return 12;
    }
}
