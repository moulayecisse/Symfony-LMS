<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50
 */

namespace App\DataFixtures;

use App\Entity\Editor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class EditorFixtures extends Fixture implements OrderedFixtureInterface
{
    public const EDITORS_REFERENCE = 'editors';
    public const EDITORS_COUNT_REFERENCE = 3;

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
        $fakerFactory = Factory::create('fr_FR');
        $editors = [];

        for ($i = 0; $i < self::EDITORS_COUNT_REFERENCE; $i++) {
            $editor = new Editor();

            $editor->setName($fakerFactory->company);
            $editor->setAddress($fakerFactory->address);

            $manager->persist($editor);

            $editors[] = $editor;

            $this->addReference(self::EDITORS_REFERENCE . $i, $editor);
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
        return -4;
    }
}
