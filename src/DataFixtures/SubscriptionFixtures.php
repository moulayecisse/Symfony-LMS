<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50
 */

namespace App\DataFixtures;

use App\Entity\User\Member\MemberUserSubscriptionType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class SubscriptionFixtures extends Fixture implements OrderedFixtureInterface
{
    public const SUBSCRIPTIONS_REFERENCE = 'subscriptions';

    private const SUBSCRIPTIONS = [
        [
            "name" => "Annuel",
            "duration" => 365,
            "price" => 75,
        ],
        [
            "name" => "Mensuel",
            "duration" => 30,
            "price" => 5,
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

        foreach (self::SUBSCRIPTIONS as $SUBSCRIPTION) {
            $subscription = new MemberUserSubscriptionType();

            $subscription->setName($SUBSCRIPTION['name']);
            $subscription->setDuration($SUBSCRIPTION['duration']);
            $subscription->setPrice($SUBSCRIPTION['price']);

            $manager->persist($subscription);

            $this->setReference(self::SUBSCRIPTIONS_REFERENCE . $i++, $subscription);
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
        return -2;
    }
}
