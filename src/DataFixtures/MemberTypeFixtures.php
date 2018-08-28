<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50
 */

namespace App\DataFixtures;

use App\Entity\MemberType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class MemberTypeFixtures extends Fixture implements OrderedFixtureInterface
{
    public const MEMBERS_REFERENCE = 'member_types';
    public const MEMBERS_COUNT_REFERENCE = 3;

    public const MEMBER_TYPES = [
        [
            "name" => "Enfant",
            "rate" => 0.25,
        ],
        [
            "name" => "Etudiant",
            "rate" => 0.75,
        ],
        [
            "name" => "Adulte",
            "rate" => 1,
        ]
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
        foreach (self::MEMBER_TYPES as $MEMBER_TYPE) {
            $memberType = new MemberType();

            $memberType->setName($MEMBER_TYPE['name']);
            $memberType->setRate($MEMBER_TYPE['rate']);

            $manager->persist($memberType);

            $this->addReference(self::MEMBERS_REFERENCE . $i++, $memberType);
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
        return -3;
    }
}
